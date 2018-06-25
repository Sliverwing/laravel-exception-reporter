<?php

namespace Sliverwing\ExceptionReporter;

use DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Sliverwing\ExceptionReporter\Listeners\MessageLoggedListener;
use Sliverwing\ExceptionReporter\Logger\Logger;


class ExceptionReporterServiceProvider extends ServiceProvider
{

    protected $listen = [
        'Illuminate\Log\Events\MessageLogged' => [
            MessageLoggedListener::class,
        ],
    ];

    public function boot()
    {
        $basePath = dirname(__DIR__);
        $this->publishes([
            $basePath . '/publishable/config/exception-reporter.php' => config_path('exception-reporter.php'),
        ]);
        $this->publishes([
            $basePath . '/publishable/email-template/' => resource_path('/views/mail/html/exception-reporter'),
        ]);
        if ($this->app->runningInConsole())
        {
            $this->commands([
                Commands\MailTester::class,
                Commands\DingTalkBotTester::class,
            ]);
        }

        if (config('exception-reporter.mail.include.sql') || config('exception-reporter.dingtalk-bot.include.sql'))
        {
            DB::connection()->enableQueryLog();
        }

        parent::boot();
    }

    public function register() :void
    {
        $this->app->singleton('exception-reporter-logger', function () {
            return (new Logger());
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [
            'exception-reporter-logger',
        ];
    }}