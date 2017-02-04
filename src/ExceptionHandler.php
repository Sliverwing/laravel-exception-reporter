<?php

namespace Sliverwing\ExceptionReporter;

use Illuminate\Foundation\Bus\DispatchesJobs;

class ExceptionHandler extends \App\Exceptions\Handler {
    
    use DispatchesJobs;

    public function report(\Exception $exception)
    {
        $this->dispatch(new ExceptionReporter(
            $exception->getFile(),
            $exception->getCode(),
            $exception->getMessage(),
            $exception->getTraceAsString()
        ));
    }

}