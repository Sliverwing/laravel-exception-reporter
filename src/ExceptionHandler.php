<?php

namespace Sliverwing\ExceptionReporter;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Mail;
use \Sliverwing\ExceptionReporter\ExceptionReporter\ExcpetionMailReporter;
use Illuminate\Foundation\Exceptions\Handler;


class ExceptionHandler extends Handler{
    
    use DispatchesJobs;

    public function report(\Exception $exception)
    {
        if (config('exception-reporter.mail.enable', false))
        {
            $mailTo = config('exception-reporter.mail.to', []);
            foreach ($mailTo as $to)
            {
                Mail::to($to)->queue(new ExcpetionMailReporter(
                    $exception->getFile(),
                    $exception->getCode(),
                    $exception->getMessage(),
                    $exception->getTraceAsString()
                ));
            }
        }
        parent::report($exception);
    }

}