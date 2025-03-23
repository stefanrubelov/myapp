<?php

declare(strict_types=1);

namespace App\Listeners;

use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Support\Facades\Artisan;

class MigrationsEndedListener
{
    /**
     * Handle the event.
     */
    public function handle(MigrationsEnded $event): void
    {
        Artisan::call('db:seed');
    }
}
