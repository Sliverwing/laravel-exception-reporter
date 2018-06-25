<?php

namespace Sliverwing\ExceptionReporter\Listeners;

use Illuminate\Log\Events\MessageLogged;

class MessageLoggedListener {

    public function handle(MessageLogged $event)
    {
        app('exception-reporter-logger')->addLog($event->level, $event->message, $event->context);
    }

}
