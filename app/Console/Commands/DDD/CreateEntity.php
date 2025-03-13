<?php

declare(strict_types=1);

namespace App\Console\Commands\DDD;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

use function Laravel\Prompts\text;

class CreateEntity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:make:entity';

    protected $description = 'Create a new entity in the Domains directory with its structure';

    /**
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        $directories = [
            'Models',
            'Services',
            'Repositories',
            'Filters',
            'Routes',
            'Helpers',
            'Forms',
            'Infolists',
        ];

        $name = text(
            label: 'Enter the entity name (e.g., Foo/Bar)',
            required: true,
            transform: fn (string $value) => Str::ucfirst($value)
        );

        $basePath = domain_path('/'.$name);

        $filesystem = new Filesystem;

        foreach ($directories as $dir) {
            $filesystem->ensureDirectoryExists("$basePath/$dir");
        }

        $this->createModelFile($basePath, $name, $filesystem);

        $this->createFilterFile($basePath, $name, $filesystem);

        $this->createRepositoryFile($basePath, $name, $filesystem);

        $this->createRouteFiles($basePath, $filesystem);

        $this->createServiceFile($basePath, $name, $filesystem);

        $this->info("Entity structure created at Domains/$name");
    }

    private function createRouteFiles($basePath, Filesystem $filesystem): void
    {
        $webRoutePath = "$basePath/Routes/web.php";
        $apiRoutePath = "$basePath/Routes/api.php";

        if (! $filesystem->exists($webRoutePath)) {
            $filesystem->put($webRoutePath, "<?php\n\nuse Illuminate\\Support\\Facades\\Route;\n\n// Web routes for this entity\n");
        }

        if (! $filesystem->exists($apiRoutePath)) {
            $filesystem->put($apiRoutePath, "<?php\n\nuse Illuminate\\Support\\Facades\\Route;\n\n// API routes for this entity\n");
        }
    }

    /**
     * @throws FileNotFoundException
     */
    private function createModelFile(string $basePath, string $entityName, Filesystem $filesystem): void
    {
        $modelPath = "$basePath/Models/".class_basename($entityName).'.php';

        if (! $filesystem->exists($modelPath)) {
            $stubPath = stub_path('ddd/model.stub');

            if (! $filesystem->exists($stubPath)) {
                $this->error('Stub file not found: stubs/model.stub');

                return;
            }

            $stub = $filesystem->get($stubPath);
            $namespace = str_replace('/', '\\', $entityName);
            $entityClass = class_basename($entityName);

            $stub = str_replace(['{{ namespace }}', '{{ entity }}'], [$namespace, $entityClass], $stub);

            $filesystem->put($modelPath, $stub);
        }
    }

    /**
     * @throws FileNotFoundException
     */
    private function createRepositoryFile(string $basePath, string $entityName, Filesystem $filesystem): void
    {
        $repositoryPath = "$basePath/Repositories/".class_basename($entityName).'Repository.php';

        if (! $filesystem->exists($repositoryPath)) {
            $stubPath = stub_path('ddd/repository.stub');

            if (! $filesystem->exists($stubPath)) {
                $this->error('Stub file not found: stubs/repository.stub');

                return;
            }

            $stub = $filesystem->get($stubPath);
            $namespace = str_replace('/', '\\', $entityName);
            $entityClass = class_basename($entityName);

            $stub = str_replace(['{{ namespace }}', '{{ entity }}'], [$namespace, $entityClass], $stub);

            $filesystem->put($repositoryPath, $stub);
        }
    }

    /**
     * @throws FileNotFoundException
     */
    private function createFilterFile(string $basePath, string $entityName, Filesystem $filesystem): void
    {
        $filterName = class_basename($entityName).'Filter';
        $filterPath = "$basePath/Filters/$filterName.php";

        if (! $filesystem->exists($filterPath)) {
            $stubPath = stub_path('ddd/filter.stub');

            if (! $filesystem->exists($stubPath)) {
                $this->error('Stub file not found: stubs/filter.stub');

                return;
            }

            $stub = $filesystem->get($stubPath);
            $namespace = str_replace('/', '\\', $entityName);

            $stub = str_replace(
                ['{{ namespace }}', '{{ entity }}'],
                [$namespace, $filterName],
                $stub
            );

            $filesystem->put($filterPath, $stub);
        }
    }

    /**
     * @throws FileNotFoundException
     */
    private function createServiceFile(string $basePath, string $entityName, Filesystem $filesystem): void
    {
        $serviceName = class_basename($entityName).'Service';
        $servicePath = "$basePath/Services/$serviceName.php";

        if (! $filesystem->exists($servicePath)) {
            $stubPath = stub_path('ddd/service.stub');

            if (! $filesystem->exists($stubPath)) {
                $this->error('Stub file not found: stubs/service.stub');

                return;
            }

            $stub = $filesystem->get($stubPath);
            $namespace = str_replace('/', '\\', $entityName);
            $entityClass = class_basename($entityName);
            $repositoryClass = $entityClass.'Repository';

            $stub = str_replace(
                ['{{ namespace }}', '{{ entity }}', '{{ repository }}'],
                [$namespace, $entityClass, $repositoryClass],
                $stub
            );

            $filesystem->put($servicePath, $stub);
        }
    }
}
