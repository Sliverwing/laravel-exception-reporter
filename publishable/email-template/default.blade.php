{{ $message_error }}

{{ $code }}

{{ $file }}

{{ $trace }}

@if(config('exception-reporter.mail.include.request'))
    Full Url: {{ $request->fullUrl }}
    Method: {{ $request->method }}
    Query: {{ $request->query }}
    User-Agent: {{ $request->userAgent }}
@endif
