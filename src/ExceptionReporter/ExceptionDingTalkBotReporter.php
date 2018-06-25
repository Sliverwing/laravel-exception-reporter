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

        $text = "**Environment: {$this->env}**  \n**{$this->message}**\n# File Location: {$this->file}\n";

        if (config('exception-reporter.dingtalk-bot.include.request'))
        {
            $text .= "Request Url: {$this->request->fullUrl}   \nClient IP: {$this->request->ip}  \nMethod: {$this->request->method}  \nQuery: {$this->request->query}  \nUser-Agent: {$this->request->userAgent}   \n";
        }

        if (config('exception-reporter.dingtalk-bot.include.sql'))
        {
            $text .= "Sql: {$this->formatQueryLog()}  \n";
        }

        $text .= "```\n{$this->trace}\n```  \n";

        $client->post(config('exception-reporter.dingtalk-bot.webhook_url'),
            [
                'headers'=>['Content-Type'=>'application/json'],
                'json'=>[
                    "msgtype" => "markdown",
                    "markdown" => [
                        "title" => $this->message,
                        "text" => $text,
                    ]
                ]
            ]
        );
    }
}
