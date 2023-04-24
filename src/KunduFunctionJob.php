<?php

namespace kundu\LaravelFuncQueue;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

/**
 * The KunduFunctionJob class represents a job that can be dispatched to run a function.
 */
class KunduFunctionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The name of the class that contains the function to be run.
     *
     * @var string
     */
    protected $class;

    /**
     * The name of the function to be run.
     *
     * @var string
     */
    protected $method;

    /**
     * The parameters to be passed to the function.
     *
     * @var array
     */
    protected $params;

    /**
     * The constructor parameters to be passed to the class.
     *
     * @var array
     */
    protected $constructorParams;

    /**
     * Create a new job instance.
     *
     * @param  string  $class
     * @param  string  $method
     * @param  array  $params
     * @param  array  $constructorParams
     * @return void
     */
    public function __construct($class, $method, $params, $constructorParams = [])
    {
        $this->class = $class;
        $this->method = $method;
        $this->params = $params;
        $this->constructorParams = $constructorParams;
    }

    /**
     * Handle the job and run the specified function.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $instance = app()->makeWith($this->class, $this->constructorParams);
            call_user_func_array([$instance, $this->method], $this->params);
        }
        catch(Exception $exception){
            Log::error('Error running queued function: ' . $exception->getMessage(), ["Exception details" => $exception]);
        }


    }
}
