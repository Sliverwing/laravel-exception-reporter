<?php

namespace Sliverwing\ExceptionReporter\Http;

use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request as BaseRequest;

class Request
{
    use SerializesModels;

    public $query;
    public $fullUrl;
    public $userAgent;

    public function __construct(BaseRequest $request)
    {
        $this->query = $request->getQueryString();
        $this->fullUrl = $request->fullUrl();
        $this->userAgent = $request->userAgent();
    }
}
