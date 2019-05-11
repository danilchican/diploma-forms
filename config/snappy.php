<?php

return [
    'pdf'   => [
        'enabled' => true,
        'binary'  => base_path('vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltopdf'),
        'timeout' => false,
        'options' => [],
        'env'     => [],
    ],
    'image' => [
        'enabled' => true,
        'binary'  => '/usr/local/bin/wkhtmltoimage',
        'timeout' => false,
        'options' => [],
        'env'     => [],
    ],


];
