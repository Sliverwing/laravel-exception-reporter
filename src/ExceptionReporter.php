<?php

namespace Sliverwing\ExceptionReporter;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use GuzzleHttp\Client;

class ExceptionReporter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    protected $code;
    protected $message;
    protected $trace;


    /**
     * ExceptionReporter constructor.
     * @param $file
     * @param $code
     * @param $message
     * @param $trace
     */
    public function __construct($file, $code, $message, $trace)
    {
        $this->file = $file;
        $this->code = $code;
        $this->message = $message;
        $this->trace  = $trace;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client();
        $resp = $client->post(config('exception-reporter.url') . 'api/v1/' .config('exception-reporter.token') . '/report', [
            'form_params' => [
                'file' => $this->file,
                'code' => $this->code,
                'message' => $this->message,
                'trace' => $this->trace,
            ]
        ]);
//        TODO: Add response handler
    }
}
