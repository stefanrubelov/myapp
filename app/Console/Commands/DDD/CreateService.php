<?php

declare(strict_types=1);

namespace App\Console\Commands\DDD;

use App\Console\Commands\DDD\Generators\ServiceGenerator;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

use function Laravel\Prompts\text;

class CreateService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:make:service {name : The name of the service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class for an entity';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = Str::replaceLast('Service', '', Str::ucfirst($this->argument('name') ?? text(
            label: 'Enter the service name (e.g., Foo/Bar)',
            required: true
        )));

        $basePath = domain_path();

        $generator = new ServiceGenerator($basePath, $name);

        try {
            $generator->generate();
            $this->info("Service [$name] created successfully.");
        } catch (\Exception $e) {
            $this->error("Failed to create service: {$e->getMessage()}");
        }
    }
}
