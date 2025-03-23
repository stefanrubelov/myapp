<?php

declare(strict_types=1);

namespace App\Console\Commands\DDD\Generators;

use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ModelGenerator extends BaseGenerator
{
    /**
     * @throws FileNotFoundException
     */
    public function generate(): void
    {
        $this->ensureDomainDirectoryExists('Models');

        $this->createFileFromStub(
            "$this->domainName/Models/{$this->className}.php",
            stub_path('ddd/model.stub'),
            [
                'namespace' => $this->getNamespace(),
                'entity' => $this->className,
            ]
        );
    }
}
