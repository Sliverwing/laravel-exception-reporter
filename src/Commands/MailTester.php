<?php

namespace Sliverwing\ExceptionReporter\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Sliverwing\ExceptionReporter\ExceptionReporter\ExceptionMailReporter;
use Sliverwing\ExceptionReporter\Http\Request;

class MailTester extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exp-reporter:mail:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exception Reporter Build-in Command, Test out where you can receive report via email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $mailTo = config('exception-reporter.mail.to', []);
        $request = new Request(\request());
        foreach ($mailTo as $to)
        {
            Mail::to($to)->send(new ExceptionMailReporter(
                __DIR__,
                0,
                'Test Message from exp-reporter:mail:test',
                '0# Every thing works fine!',
                $request
            ));
        }
    }
}
