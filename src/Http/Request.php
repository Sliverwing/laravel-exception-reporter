<?php

namespace Sliverwing\ExceptionReporter\Http;

use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request as BaseRequest;

class Request
{
    use SerializesModels;

    public $query;
    public $ip;
    public $fullUrl;
    public $userAgent;
    public $method;

    public function __construct(BaseRequest $request)
    {
        $this->query = $request->getQueryString();
        $this->ip = $request->ip();
        $this->fullUrl = $request->fullUrl();
        $this->userAgent = $request->userAgent();
        $this->method = $request->method();
    }
}
