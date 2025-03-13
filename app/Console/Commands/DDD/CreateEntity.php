<?php

declare(strict_types=1);

namespace App\Console\Commands\DDD;

use App\Console\Commands\DDD\Generators\FactoryGenerator;
use App\Console\Commands\DDD\Generators\FilterGenerator;
use App\Console\Commands\DDD\Generators\ModelGenerator;
use App\Console\Commands\DDD\Generators\RepositoryGenerator;
use App\Console\Commands\DDD\Generators\ServiceGenerator;
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
    protected $signature = 'ddd:make:entity {name : The name or the path of the entity}';

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
            'Factories',
        ];

        $name = Str::ucfirst($this->argument('name') ?? text(
            label: 'Enter the entity name (e.g., Foo/Bar)',
            required: true
        ));

        $basePath = domain_path();
        $entityPath = $name;

        $filesystem = new Filesystem;
        $fullPath = "$basePath/$entityPath";

        foreach ($directories as $dir) {
            $filesystem->ensureDirectoryExists("$fullPath/$dir");
        }

        $this->createRouteFiles($fullPath, $filesystem);

        $parts = explode('/', $entityPath);
        $entityName = end($parts);

        $generatorEntityPath = "$entityPath/Models/$entityName";

        new FactoryGenerator($basePath, $generatorEntityPath)->generate();
        new FilterGenerator($basePath, $generatorEntityPath)->generate();
        new ModelGenerator($basePath, $generatorEntityPath)->generate();
        new RepositoryGenerator($basePath, $generatorEntityPath)->generate();
        new ServiceGenerator($basePath, $generatorEntityPath)->generate();

        $this->info("Entity structure created at Domains/$entityPath");
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
}
