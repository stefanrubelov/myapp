<?php

declare(strict_types=1);

namespace App\Console\Commands\DDD;

use App\Console\Commands\DDD\Generators\RepositoryGenerator;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

use function Laravel\Prompts\text;

class CreateRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:make:repository {name : The name of the repository}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class for an entity';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = Str::replaceLast('Repository', '', Str::ucfirst($this->argument('name') ?? text(
            label: 'Enter the repository name (e.g., Foo/Bar)',
            required: true
        )));

        $basePath = domain_path();

        $generator = new RepositoryGenerator($basePath, $name);

        try {
            $generator->generate();
            $this->info("Repository [$name] created successfully.");
        } catch (\Exception $e) {
            $this->error("Failed to create repository: {$e->getMessage()}");
        }

    }
}
