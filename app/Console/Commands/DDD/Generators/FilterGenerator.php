<?php

namespace App\Console\Commands\DDD\Generators;

use Illuminate\Contracts\Filesystem\FileNotFoundException;

class FilterGenerator extends BaseGenerator{
    /**
     * @throws FileNotFoundException
     */
    public function generate(): void
    {
        $this->ensureDomainDirectoryExists('Filters');

        $this->createFileFromStub(
            "$this->domainName/Filters/{$this->className}Filter.php",
            stub_path('ddd/filter.stub'),
            [
                'namespace' => $this->getNamespace(),
                'entity' => $this->className,
            ]
        );
    }
}
