<?php

namespace Sliverwing\ExceptionReporter\ExceptionReporter;

use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Sliverwing\ExceptionReporter\Http\Request;

trait ExceptionBaseReporter{
    
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $env;
    protected $file;
    protected $code;
    protected $message;
    protected $trace;
    protected $request;
    protected $queries;

    /**
     * ExceptionReporter constructor.
     * @param $env
     * @param $file
     * @param $code
     * @param $message
     * @param $trace
     * @param  \Sliverwing\ExceptionReporter\Http\Request $request
     */
    public function __construct($file, $code, $message, $trace, Request $request)
    {
        $this->env = app()->environment();
        $this->file = $file;
        $this->code = $code;
        $this->message = $message;
        $this->trace  = $trace;
        $this->request = $request;

        if (config('exception-reporter.mail.include.sql') || config('exception-reporter.dingtalk-bot.include.sql'))
        {
            try {
                $this->queries = DB::getQueryLog();
            }
            catch (\Exception $e)
            {
                $this->queries = [];
            }
        }
    }


    /**
     * formatQueryLog
     *
     * modified via https://github.com/BKWLD/reporter/blob/master/src/Formatter.php#L111
     * @return string
     */
    public function formatQueryLog()
    {
        $text = "";
        foreach ($this->queries as $query)
        {
            $sql = $query['query'];

            foreach($query['bindings'] as $binding) {
                if ($binding instanceof \DateTime) $binding = $binding->format('Y-m-d H:i:s');
                elseif (is_object($binding) && !method_exists($binding, '__toString' )) $binding = 'COULD_NOT_CONVERT_TO_STRING';
                $sql = preg_replace('/\?/', "'".$binding."'", $sql, 1);
            }

            // Add log line
            $time = preg_replace('#[^\d.]#', '', $query['time']);
            $time = $time > 1000 ? number_format($time/1000, 2).' s' : number_format($time, 2).' ms';

            $text .= "{$sql}; Cost: {$time}\n";
        }
        return $text;
    }
}