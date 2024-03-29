<?php

namespace Tests;

use App\Exceptions\Handler;
use Exception;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function disableExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, new class extends Handler
        {
            public function __construct() { }

            public function report(Exception $e) { }

            public function render($request, Exception $e) { throw $e; }
        });
    }
}
