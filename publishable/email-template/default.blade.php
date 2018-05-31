{{ $message_error }}

{{ $code }}

{{ $file }}

{{ $trace }}

@if(config('exception-reporter.mail.include.request'))
    Full Url: {{ $request->fullUrl }}
    User-Agent: {{ $request->userAgent }}
@endif
