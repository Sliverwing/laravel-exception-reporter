<?php

namespace Sliverwing\ExceptionReporter;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Mail;
use Sliverwing\ExceptionReporter\ExceptionReporter\ExceptionDingTalkBotReporter;
use \Sliverwing\ExceptionReporter\ExceptionReporter\ExceptionMailReporter;
use Illuminate\Foundation\Exceptions\Handler;
use Sliverwing\ExceptionReporter\Http\Request;


class ExceptionHandler extends Handler{
    
    use DispatchesJobs;

    public function report(\Exception $exception)
    {
        if ($this->shouldntReport($exception)) {
            return;
        }

        $request = new Request(\request());

        if (config('exception-reporter.mail.enable', false))
        {
            $mailTo = config('exception-reporter.mail.to', []);
            foreach ($mailTo as $to)
            {
                Mail::to($to)->queue(new ExceptionMailReporter(
                    $exception->getFile(),
                    $exception->getCode(),
                    $exception->getMessage(),
                    $exception->getTraceAsString(),
                    $request
                ));
            }
        }
        if (config('exception-reporter.dingtalk-bot.enable', false))
        {
            $this->dispatch(new ExceptionDingTalkBotReporter(
                $exception->getFile(),
                $exception->getCode(),
                $exception->getMessage(),
                $exception->getTraceAsString(),
                $request
            ));
        }
        parent::report($exception);
    }

}