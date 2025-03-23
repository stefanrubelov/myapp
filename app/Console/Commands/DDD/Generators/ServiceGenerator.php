<?php

declare(strict_types=1);

namespace App\Console\Commands\DDD\Generators;

use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ServiceGenerator extends BaseGenerator
{
    /**
     * @throws FileNotFoundException
     */
    public function generate(): void
    {
        $this->ensureDomainDirectoryExists('Services');

        $this->createFileFromStub(
            "{$this->domainName}/Services/{$this->className}Service.php",
            stub_path('ddd/service.stub'),
            [
                'namespace' => $this->getNamespace(),
                'entity' => $this->className,
                'repository' => $this->className.'Repository',
            ]
        );
    }
}
