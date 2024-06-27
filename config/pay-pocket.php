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
    | - [array]         log_reference_params: The parameters to pass to the log reference generator.
    | - [string]        log_reference_prefix: The prefix for the generated reference string.
    | - [class-string]  log_reference_generator_class: The fully qualified name of the class containing static methods for generation.
    | - [string]        log_reference_generator_method: The name of the static method available in the generator class.
    |
    | This is how it works by default in the code:
    | Illuminate\Support\Str::random(12)
    |
    */

    'log_reference_params' => [12],
    'log_reference_prefix' => '',
    'log_reference_generator_class' => Illuminate\Support\Str::class,
    'log_reference_generator_method' => 'random',
];
