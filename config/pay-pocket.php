<?php

// config for HPWebdeveloper/LaravelPayPocket

/**
 * Configuration for generating log reference strings.
 *
 * @param  int  $log_reference_length  The length of the generated string.
 * @param  string  $log_reference_prefix  The prefix for the generated string.
 * @param  string  $log_reference_generator_class  The fully qualified name of the class containing static methods for generation.
 * @param  string  $log_reference_generator_method  The name of the static method available in the generator class.
 *
 * This is how it works in the code:
 * Illuminate\Support\Str::random(12)
 */
return [
    'log_reference_length' => 12,
    'log_reference_prefix' => '',
    'log_reference_generator_class' => Illuminate\Support\Str::class,
    'log_reference_generator_method' => 'random',
];
