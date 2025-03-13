<?php

declare(strict_types=1);

namespace App\Console\Commands\DDD;

use App\Console\Commands\DDD\Generators\FilterGenerator;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

use function Laravel\Prompts\text;

class CreateFilter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:make:filter {name : The name of the filter}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new filter class for an entity';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = Str::replaceLast('Filter', '', Str::ucfirst($this->argument('name') ?? text(
            label: 'Enter the filter name (e.g., Foo/Bar)',
            required: true
        )));

        $basePath = domain_path();

        $generator = new FilterGenerator($basePath, $name);

        try {
            $generator->generate();
            $this->info("Filter [$name] created successfully.");
        } catch (\Exception $e) {
            $this->error("Failed to create filter: {$e->getMessage()}");
        }
    }
}
