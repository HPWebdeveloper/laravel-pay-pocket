<?php

// config for HPWebdeveloper/LaravelPayPocket
return [
    'log_reference_length' => 12,
    'log_reference_prefix' => null,
    /**
     * The log reference generator should be static
     * The third array item should contain optional parameters to pass to the generator
     */
    'log_reference_generator' => [\Illuminate\Support\Str::class, 'random', [15]],
];
