<?php

namespace Sliverwing\ExceptionReporter\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Sliverwing\ExceptionReporter\ExceptionReporter\ExceptionDingTalkBotReporter;

class DingTalkBotTester extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exp-reporter:dingtalk-bot:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exception Reporter Build-in Command, Test out where you can receive report via Dingtalk Bot';

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
        dispatch(new ExceptionDingTalkBotReporter(
            __DIR__,
            0,
            'Test Message from exp-reporter:mail:test',
            '0# Every thing works fine!'
        ));
    }
}
