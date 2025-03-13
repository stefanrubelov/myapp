<?php

declare(strict_types=1);

namespace App\Console\Commands\DDD\Generators;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;

class FactoryGenerator extends BaseGenerator
{
    /**
     * @throws FileNotFoundException
     */
    public function generate(): void
    {
        $this->ensureDomainDirectoryExists('Factories');

        $this->createFileFromStub(
            "$this->domainName/Factories/{$this->className}Factory.php",
            stub_path('ddd/factory.stub'),
            [
                'namespace' => $this->getNamespace(),
                'entity' => $this->className,
                'entityLower' => Str::lower($this->className),
            ]
        );
    }
}
