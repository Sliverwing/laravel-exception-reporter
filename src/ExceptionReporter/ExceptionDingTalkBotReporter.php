<?php

namespace Sliverwing\ExceptionReporter\ExceptionReporter;

use Illuminate\Contracts\Queue\ShouldQueue;
use GuzzleHttp;

class ExceptionDingTalkBotReporter implements ShouldQueue
{

    use ExceptionBaseReporter;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client =  new GuzzleHttp\Client(['base_uri' => config('exception-reporter.dingtalk-bot.webhook_url')]);
        $client->post(config('exception-reporter.dingtalk-bot.webhook_url'),
            [
                'headers'=>['Content-Type'=>'application/json'],
                'json'=>[
                    "msgtype" => "markdown",
                    "markdown" => [
                        "title" => $this->message,
                        "text" => "**{$this->message}**\n# File Location: {$this->file}\n```\n{$this->trace}\n```"
                    ]
                ]
            ]
        );
    }
}
