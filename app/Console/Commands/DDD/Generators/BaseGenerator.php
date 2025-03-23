<?php

declare(strict_types=1);

namespace App\Console\Commands\DDD\Generators;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use InvalidArgumentException;
use RuntimeException;

abstract class BaseGenerator
{
    protected Filesystem $filesystem;

    protected string $basePath;

    protected string $entityName;

    protected string $domainName;

    protected string $className;

    public function __construct(string $basePath, string $entityName)
    {
        $this->filesystem = new Filesystem;
        $this->basePath = $basePath;
        $this->entityName = $entityName;

        $this->parseEntityName();
    }

    abstract public function generate(): void;

    /**
     * Parse and normalize the entity name into domain and class components
     */
    protected function parseEntityName(): void
    {
        $entityPath = $this->normalizePath($this->entityName);
        $parts = explode('/', $entityPath);

        if (in_array('Models', $parts)) {
            $modelIndex = array_search('Models', $parts);

            if (isset($parts[$modelIndex + 1])) {
                $this->className = $parts[$modelIndex + 1];
                unset($parts[$modelIndex + 1]);
                unset($parts[$modelIndex]);
                $this->domainName = implode('/', $parts);
            } else {
                throw new InvalidArgumentException("Invalid path structure after 'Models'");
            }
        } else {
            $this->className = array_pop($parts);
            $this->domainName = implode('/', $parts);

            if (empty($this->domainName)) {
                $this->domainName = $this->className;
            }
        }
    }

    /**
     * Ensure the required directories exist for a given module type
     */
    protected function ensureDomainDirectoryExists(string $moduleType): string
    {
        $domainPath = "$this->basePath/$this->domainName";

        if (! $this->filesystem->exists($domainPath)) {
            $this->filesystem->makeDirectory($domainPath, 0755, true);
        }

        $modulePath = "$domainPath/$moduleType";

        if (! $this->filesystem->exists($modulePath)) {
            $this->filesystem->makeDirectory($modulePath, 0755, true);
        }

        return $modulePath;
    }

    /**
     * Creates a file from a stub, ensuring all directories exist
     *
     * @throws FileNotFoundException
     */
    protected function createFileFromStub(string $targetPath, string $stubPath, array $replacements, bool $checkExists = true): void
    {
        $filePath = "$this->basePath/$targetPath";

        $this->filesystem->ensureDirectoryExists(dirname($filePath));

        if ($checkExists && $this->filesystem->exists($filePath)) {
            throw new RuntimeException("File already exists: $filePath");
        }

        if (! $this->filesystem->exists($stubPath)) {
            throw new FileNotFoundException("Stub file not found: $stubPath");
        }

        $stub = $this->filesystem->get($stubPath);

        foreach ($replacements as $key => $value) {
            $stub = str_replace("{{ $key }}", $value, $stub);
        }

        $this->filesystem->put($filePath, $stub);
    }

    /**
     * Get normalized namespace from domain
     */
    protected function getNamespace(): string
    {
        return str_replace('/', '\\', $this->domainName);
    }

    /**
     * Normalize a path for file system operations
     */
    protected function normalizePath(string $path): string
    {
        return str_replace('\\', '/', $path);
    }
}
