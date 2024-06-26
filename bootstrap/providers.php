<?php

return [
    App\Providers\AppServiceProvider::class,
    'admin' => \App\Http\Middleware\AdminMiddleware::class,
];
