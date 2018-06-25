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
        $data = [
            'env' => $this->env,
            'file' => $this->file,
            'code' => $this->code,
            'message_error' => $this->message,
            'trace' => $this->trace,
            'request' => $this->request,
        ];

        if (config('exception-reporter.mail.include.sql'))
        {
            $query = $this->formatQueryLog();
            $data['sql'] = $query;
        }

        return $this->view('mail.html.exception-reporter.default')->with($data);
    }
}
