<?php

namespace Sliverwing\ExceptionReporter\ExceptionReporter;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Sliverwing\ExceptionReporter\Http\Request;

trait ExceptionBaseReporter{
    
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    protected $code;
    protected $message;
    protected $trace;
    protected $request;


    /**
     * ExceptionReporter constructor.
     * @param $file
     * @param $code
     * @param $message
     * @param  \Sliverwing\ExceptionReporter\Http\Request  $request
     * @param $trace
     */
    public function __construct($file, $code, $message, $trace, Request $request)
    {
        $this->file = $file;
        $this->code = $code;
        $this->message = $message;
        $this->trace  = $trace;
        $this->request = $request;
    }
}