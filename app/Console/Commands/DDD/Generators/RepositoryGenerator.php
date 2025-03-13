<?php

declare(strict_types=1);

namespace App\Console\Commands\DDD\Generators;

use Illuminate\Contracts\Filesystem\FileNotFoundException;

class RepositoryGenerator extends BaseGenerator
{
    /**
     * @throws FileNotFoundException
     */
    public function generate(): void
    {
        $this->ensureDomainDirectoryExists('Repositories');

        $this->createFileFromStub(
            "$this->domainName/Repositories/{$this->className}Repository.php",
            stub_path('ddd/repository.stub'),
            [
                'namespace' => $this->getNamespace(),
                'entity' => $this->className,
            ]
        );
    }
}
