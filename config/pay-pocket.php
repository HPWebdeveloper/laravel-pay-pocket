<?php

// config for HPWebdeveloper/LaravelPayPocket
return [
    'log_reference_length' => 12,
    'log_reference_prefix' => null,
    /**
     * The log reference generator should be a numeric array with 3 indexes
     * First item should be a static class
     * Second item sould be method availble in the static class
     * third item should be an array of optional parameters to pass to the method
     * The default generator looks like this: [\Illuminate\Support\Str::class, 'random', [12]]
     */
    'log_reference_generator' => null,
];
