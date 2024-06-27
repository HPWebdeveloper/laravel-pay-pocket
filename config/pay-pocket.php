<?php

// config for HPWebdeveloper/LaravelPayPocket

return [

    /*
    |--------------------------------------------------------------------------
    | Reference Generator Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration allows you to customize the generation of log reference strings
    | within the LaravelPayPocket package.
    |
    | - [array]         log_reference_params: An array of parameters to pass to the log_reference_generator_method.
    | - [string]        log_reference_prefix: Prefix for the generated reference string.
    | - [class-string]  log_reference_generator_class: Fully qualified name of the class containing static methods for generation.
    | - [string]        log_reference_generator_method: Name of the static method available in the generator class.
    |
    | By default, the following generator is set up:
    | Illuminate\Support\Str::random(12)
    |
    */

    'log_reference_params' => [12],
    'log_reference_prefix' => '',
    'log_reference_generator_class' => Illuminate\Support\Str::class,
    'log_reference_generator_method' => 'random',
];
