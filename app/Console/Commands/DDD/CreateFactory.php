<?php

declare(strict_types=1);

namespace App\Console\Commands\DDD;

use App\Console\Commands\DDD\Generators\FactoryGenerator;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

use function Laravel\Prompts\text;

class CreateFactory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:make:factory {name : The name of the factory}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new factory class for an entity';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = Str::replaceLast('Factory', '', Str::ucfirst($this->argument('name') ?? text(
            label: 'Enter the factory name (e.g., Foo/Bar)',
            required: true
        )));

        $basePath = domain_path();

        $generator = new FactoryGenerator($basePath, $name);

        try {
            $generator->generate();
            $this->info("Factory [$name] created successfully.");
        } catch (\Exception $e) {
            $this->error("Failed to create factory: {$e->getMessage()}");
        }
    }
}
