{{ $env }}

{{ $message_error }}

{{ $code }}

{{ $file }}

{{ $trace }}

@if(config('exception-reporter.mail.include.request'))
    Full Url: {{ $request->fullUrl }}
    Client IP: {{ $request->ip }}
    Method: {{ $request->method }}
    Query: {{ $request->query }}
    User-Agent: {{ $request->userAgent }}
@endif
