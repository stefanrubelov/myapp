<?php

declare(strict_types=1);

if (! function_exists('domain_path')) {
    /**
     * Get the path to the Domains folder.
     */
    function domain_path(string $path = ''): string
    {
        return app()->path('Domains/'.$path);
    }
}

if (! function_exists('stub_path')) {
    /**
     * Get the path to the stubs' folder.
     */
    function stub_path(string $path = ''): string
    {
        return app()->basePath('stubs/'.$path);

    }
}
