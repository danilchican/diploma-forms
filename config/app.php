<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Опросник'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'Europe/Minsk',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'ru',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'ru_RU',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        Mavinoo\LaravelBatch\LaravelBatchServiceProvider::class,
        Barryvdh\Snappy\ServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App'          => Illuminate\Support\Facades\App::class,
        'Artisan'      => Illuminate\Support\Facades\Artisan::class,
        'Auth'         => Illuminate\Support\Facades\Auth::class,
        'Blade'        => Illuminate\Support\Facades\Blade::class,
        'Broadcast'    => Illuminate\Support\Facades\Broadcast::class,
        'Bus'          => Illuminate\Support\Facades\Bus::class,
        'Cache'        => Illuminate\Support\Facades\Cache::class,
        'Config'       => Illuminate\Support\Facades\Config::class,
        'Cookie'       => Illuminate\Support\Facades\Cookie::class,
        'Crypt'        => Illuminate\Support\Facades\Crypt::class,
        'DB'           => Illuminate\Support\Facades\DB::class,
        'Eloquent'     => Illuminate\Database\Eloquent\Model::class,
        'Event'        => Illuminate\Support\Facades\Event::class,
        'File'         => Illuminate\Support\Facades\File::class,
        'Gate'         => Illuminate\Support\Facades\Gate::class,
        'Hash'         => Illuminate\Support\Facades\Hash::class,
        'Lang'         => Illuminate\Support\Facades\Lang::class,
        'Log'          => Illuminate\Support\Facades\Log::class,
        'Mail'         => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password'     => Illuminate\Support\Facades\Password::class,
        'Queue'        => Illuminate\Support\Facades\Queue::class,
        'Redirect'     => Illuminate\Support\Facades\Redirect::class,
        'Redis'        => Illuminate\Support\Facades\Redis::class,
        'Request'      => Illuminate\Support\Facades\Request::class,
        'Response'     => Illuminate\Support\Facades\Response::class,
        'Route'        => Illuminate\Support\Facades\Route::class,
        'Schema'       => Illuminate\Support\Facades\Schema::class,
        'Session'      => Illuminate\Support\Facades\Session::class,
        'Storage'      => Illuminate\Support\Facades\Storage::class,
        'URL'          => Illuminate\Support\Facades\URL::class,
        'Validator'    => Illuminate\Support\Facades\Validator::class,
        'View'         => Illuminate\Support\Facades\View::class,
        'Batch'        => Mavinoo\LaravelBatch\LaravelBatchFacade::class,
        'PDF'          => Barryvdh\Snappy\Facades\SnappyPdf::class,
        'SnappyImage'  => Barryvdh\Snappy\Facades\SnappyImage::class,
    ],

    'admin' => [
        'name'     => env('GLOBAL_ADMIN_FIRSTNAME', 'Администратор'),
        'email'    => env('GLOBAL_ADMIN_EMAIL', 'admin@diploma.bsuir'),
        'password' => env('GLOBAL_ADMIN_PASSWORD', 'secret'),
    ],

    'roles' => [
        'admin' => 'Администратор',
    ],

    'answer_types' => [
        [
            'title'            => 'Один из списка',
            'type'             => 'radio',
            'answers_required' => true,
        ],
        [
            'title'            => 'Несколько из списка',
            'type'             => 'checkbox',
            'answers_required' => true,
        ],
        [
            'title'            => 'Выпадающий список',
            'type'             => 'select',
            'answers_required' => true,
        ],
        [
            'title'            => 'Текст (строка)',
            'type'             => 'text',
            'answers_required' => false,
        ],
        [
            'title'            => 'Текст (абзац)',
            'type'             => 'textarea',
            'answers_required' => false,
        ],
    ],

    'form_templates' => [
        [
            'title'       => 'Опрос выпускников кафедры',
            'description' => null,
            'questions'   => [
                [
                    'title'       => 'По какой специальности Вы обучались?',
                    'is_required' => true,
                    'answer_type' => 'text',
                ],
                [
                    'title'           => 'Какую квалификацию Вы получили?',
                    'is_required'     => true,
                    'answer_type'     => 'radio',
                    'answer_variants' => ['Бакалавр', 'Магистр'],
                ],
                [
                    'title'       => 'Сколько лет длилось Ваше обучение?',
                    'is_required' => true,
                    'answer_type' => 'text',
                ],
                [
                    'title'           => 'Насколько качественным было преподавание профилирующих предметов?',
                    'is_required'     => false,
                    'answer_type'     => 'radio',
                    'answer_variants' => [
                        'Очень качественное', 'Качественное', 'Скорее качественное',
                        'Скорее некачественное', 'Некачественное',
                    ],
                ],
                [
                    'title'           => 'Вы работали в период обучения? Если да, выберите один из ' .
                        'последующих вариантов:',
                    'is_required'     => true,
                    'answer_type'     => 'radio',
                    'answer_variants' => [
                        'Нет', 'Да, только подработки (до 19 часов в неделю)', 'Да, 20 - 40 часов в неделю',
                        'Да, более 40 часов в неделю, но на неполный рабочий день', 'Да, полный рабочий день',
                    ],
                ],
                [
                    'title'           => 'Собираетесь ли вы продолжать учиться?',
                    'is_required'     => true,
                    'answer_type'     => 'radio',
                    'answer_variants' => ['Да', 'Нет'],
                ],
                [
                    'title'           => 'Университет оказывал помощь вашему карьерному росту? Мотивационные ' .
                        'программы, стажировки и т.п.?',
                    'is_required'     => true,
                    'answer_type'     => 'radio',
                    'answer_variants' => ['Да', 'Нет'],
                ],
                [
                    'title'       => 'Ваши впечатления об обучении в университете:',
                    'is_required' => false,
                    'answer_type' => 'textarea',
                ],
            ],
        ],
        [
            'title'       => 'Оценка курса',
            'description' => 'Оставьте отзыв о пройденном курсе. Оцените его структуру и содержание, а также ' .
                'работу преподавателя',
            'questions'   => [
                [
                    'title'       => 'Название курса',
                    'is_required' => true,
                    'answer_type' => 'text',
                ],
                [
                    'title'       => 'ФИО преподавателя',
                    'is_required' => true,
                    'answer_type' => 'text',
                ],
                [
                    'title'       => 'Ваше мнение о пройденном курсе',
                    'is_required' => true,
                    'answer_type' => 'textarea',
                ],
                [
                    'title'       => 'Ваше мнение о работе преподавателя',
                    'is_required' => true,
                    'answer_type' => 'textarea',
                ],
                [
                    'title'       => 'Ваши предпочтения по улучшению курса:',
                    'is_required' => true,
                    'answer_type' => 'textarea',
                ],
                [
                    'title'       => 'Что в этом курсе было самым ценным и полезным?',
                    'is_required' => true,
                    'answer_type' => 'textarea',
                ],
                [
                    'title'           => 'Вы бы записались на другой предмет, преподаваемый тем же лектором?',
                    'is_required'     => true,
                    'answer_type'     => 'radio',
                    'answer_variants' => ['Да', 'Нет'],
                ],
            ],
        ],
        [
            'title'       => 'Контактная информация',
            'description' => null,
            'questions'   => [
                [
                    'title'       => 'Введите ФИО',
                    'is_required' => true,
                    'answer_type' => 'text',
                ],
                [
                    'title'       => 'Ваш номер группы?',
                    'is_required' => true,
                    'answer_type' => 'text',
                ],
                [
                    'title'       => 'Ваш номер телефона?',
                    'is_required' => true,
                    'answer_type' => 'text',
                ],
                [
                    'title'       => 'Ваш адрес проживания?',
                    'is_required' => false,
                    'answer_type' => 'text',
                ],
            ],
        ],
        [
            'title'       => 'Опрос о магистратуре',
            'description' => 'Просим Вас пройти опрос: планируете ли Вы поступать в магистратуру по специальности ' .
                '"Электронная экономика"? Если да, то, пожалуйста, заполните данную форму',
            'questions'   => [
                [
                    'title'       => 'Ваше ФИО',
                    'is_required' => true,
                    'answer_type' => 'text',
                ],
                [
                    'title'           => 'Вы бы хотели поступить на платную или бюджетную форму обучения?',
                    'is_required'     => true,
                    'answer_type'     => 'radio',
                    'answer_variants' => ['Бюджет', 'Платная'],
                ],
                [
                    'title'           => 'Вы планируете выбрать очную или заочную форму обучения?',
                    'is_required'     => true,
                    'answer_type'     => 'radio',
                    'answer_variants' => ['Очная', 'Заочная'],
                ],
                [
                    'title'       => 'Ваш контактный номер телефона:',
                    'is_required' => false,
                    'answer_type' => 'text',
                ],
                [
                    'title'       => 'Введите электронную почту, по которой с Вами можно связаться:',
                    'is_required' => false,
                    'answer_type' => 'text',
                ],
            ],
        ],
    ],
];
