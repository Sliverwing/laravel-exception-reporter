<?php

namespace Sliverwing\ExceptionReporter\Logger;

class Logger {

    public $bufferedLog = [];

    public function addLog($level, $message, $ctx)
    {
        array_push($this->bufferedLog, (object) [
            'level'   => $level,
            'message' => $message,
            'context' => $ctx,
        ]);
    }

    public function getAllLogs()
    {
        return $this->bufferedLog;
    }

    public function getPlainLog()
    {
        $text = "";
        if (count($this->getAllLogs()) != 0)
        {
            foreach ($this->getAllLogs() as $log)
            {
                $text .= "[{$log->level}]: {$log->message}";
                if (!empty($log->context)) {
                    $text .= (print_r($log->context, true));
                }
                $text .= "\n  ";
            }
        }
        return $text;
    }

}