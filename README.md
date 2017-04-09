#  Laravel Exception Reporter  
> Make exception Grate again 💪  

---
## Current Support:  
* Email
* DingTalk Bot  
## Usage:

* `composer require "sliverwing/laravel-exception-reporter"`
* add `Sliverwing\ExceptionReporter\ExceptionReporterServiceProvider::class` to app.php
* run `php artisan vendor:publish --provider=ExceptionReporterServiceProvider`
* edit `config/exception-reporter.php`
* run `php artisan exp-reporter:dingtalk-bot:test` or `php artisan exp-reporter:mail:test` to test out
* edit `app\Exceptions\Handler.php`
    ```php
    <?php

    namespace App\Exceptions;

    use Exception;
    use Illuminate\Auth\AuthenticationException;
    // use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
    use \Sliverwing\ExceptionReporter\ExceptionHandler;
    ```  
* run `php artisan queue:work --tries=1`




