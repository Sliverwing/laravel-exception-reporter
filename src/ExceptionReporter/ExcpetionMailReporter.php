<?php

namespace Sliverwing\ExceptionReporter\ExceptionReporter;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExcpetionMailReporter extends Mailable
{
    use Queueable, SerializesModels;

    protected $file;
    protected $code;
    protected $message;
    protected $trace;


    /**
     * ExceptionMailReporter constructor.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.html.exception-reporter.default')->with(
            [
                'file' => $this->file,
                'code' => $this->code,
                'message_error' => $this->message,
                'trace' => $this->trace
            ]
        );
    }
}
