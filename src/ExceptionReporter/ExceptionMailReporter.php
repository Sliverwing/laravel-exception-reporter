<?php

namespace Sliverwing\ExceptionReporter\ExceptionReporter;

use Illuminate\Mail\Mailable;

class ExceptionMailReporter extends Mailable
{

    use ExceptionBaseReporter;

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
