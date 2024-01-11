<?php

// config for HPWebdeveloper/LaravelPayPocket

/**
 * The 'log_reference_generator' should be a numeric array with three elements:
 * - The first element should be the fully qualified name of a class that contains static methods.
 *   This includes the namespace of the class.
 * - The second element should be the name of a static method available in the specified class.
 * - The third element should be an array of optional parameters to pass to the static method.
 * For example, the default generator is configured as follows:
 * [\Illuminate\Support\Str::class, 'random', [12]], which uses the 'random' static method
 * from the \Illuminate\Support\Str class with 12 as a parameter.
 */
return [
    'log_reference_length' => 12,
    'log_reference_prefix' => null,
    'log_reference_generator' => null,
];
