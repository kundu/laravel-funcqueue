<?php

namespace kundu\LaravelFuncQueue;

/**
 * The LaravelFuncQueue class provides a simple interface for dispatching functions as jobs in Laravel.
 */
class LaravelFuncQueue
{
    /**
     * The constructor parameters that should be passed to the function being dispatched.
     *
     * @var array
     */
    protected static $constructorParams = [];

    /**
     * Set the constructor parameters that should be passed to the function being dispatched.
     *
     * @param  array  $params
     * @return static
     */
    public static function withConstructor(array $params)
    {
        static::$constructorParams = $params;

        return new static;
    }

    /**
     * Run the specified method of the specified class as a queued job.
     *
     * @param  string  $class The name of the class that contains the method to be run.
     *                        This can be either a fully qualified class name in the format `MyClass::class`,
     *                        or a string containing just the class name if the class is in the global namespace.
     * @param  string  $method The name of the method to be run.
     * @param  array  $params The parameters to be passed to the method.
     * @return void
     */
    public static function run(string $class, string $method, array $params = [])
    {
        $queue = config('laravel-funcqueue.queue', 'default');
        KunduFunctionJob::dispatch(self::getFullClassName($class), $method, $params, static::$constructorParams)->onQueue($queue);
    }

    /**
     * Get the fully qualified class name for the specified class.
     *
     * @param  string  $class The name of the class. This can be either a fully qualified class name
     *                        in the format `MyClass::class`, or a string containing just the class name
     *                        if the class is in the global namespace.
     * @return string The fully qualified class name with namespace.
     */
    private function getFullClassName(string $class): string
    {
        $className = class_basename($class);
        $namespace = rtrim(str_replace('\\' . $className, '', $class), '\\');

        return $namespace . '\\' . $className;
    }

}
