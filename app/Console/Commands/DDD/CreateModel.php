<?php

declare(strict_types=1);

namespace App\Console\Commands\DDD;

use App\Console\Commands\DDD\Generators\ModelGenerator;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

use function Laravel\Prompts\text;

class CreateModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:make:model {name : The name of the model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model class for an entity';

    public function handle(): void
    {
        $name = Str::replaceLast('Model', '', Str::ucfirst($this->argument('name') ?? text(
            label: 'Enter the entity name (e.g., Foo/Bar)',
            required: true
        )));

        $basePath = domain_path();

        $generator = new ModelGenerator($basePath, $name);

        try {
            $generator->generate();
            $this->info("Model [$name] created successfully.");
        } catch (\Exception $e) {
            $this->error("Failed to create model: {$e->getMessage()}");
        }
    }
}
