<?php

namespace Sliverwing\ExceptionReporter;

use Illuminate\Support\ServiceProvider;

class ExceptionReporterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $basePath = dirname(__DIR__);
        $this->publishes([
            $basePath . '/publishable/config/exception-reporter.php' => config_path('exception-reporter.php'),
        ]);
    }
}