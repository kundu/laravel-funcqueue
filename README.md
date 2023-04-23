## **FuncQueue**

**FuncQueue is a Laravel package that allows you to easily run functions as queued jobs. This package provides a simple and flexible functions for dispatching queued jobs that run the specified function in the specified class.**

## **Installation**

You can install the package using Composer:

```plaintext
composer require kundu/laravel-funcqueue:dev-main
```

The package will automatically register its service provider.

  
**Usage**

To use FuncQueue, you can call the **run** method on the **LaravelFuncQueue** class, passing the name of the class that contains the function, the name of the function, and an array of parameters to be passed to the function.

Here's an example of how you can use the **run** method:

```php
use kundu\LaravelFuncQueue\LaravelFuncQueue;

// Dispatch a job to run the MyClass, myMethod() function
LaravelFuncQueue::run(MyClass::class, 'myMethod', ['param1', 'param2']);
```

In this example, the **MyClass::class** string is passed as the first parameter of the **run** method, along with the method name and parameters.

You can also pass an array of constructor parameters to be used when instantiating the class. To do this, you can call the **withConstructor** method on the **LaravelFuncQueue** class before calling the **run** method:

```php
use kundu\LaravelFuncQueue\LaravelFuncQueue;

// Set the constructor parameters for the MyClass class
LaravelFuncQueue::withConstructor(['param1'])->run(MyClass::class, 'myMethod', ['param2']);
```

In this example, the **withConstructor** method is called to set the constructor parameter for the **MyClass** class to **'param1'**. The **run** method is then called with the class name, method name, and an array of method parameters.

## **Configuration**

You can configure the default queue name for queued jobs by publishing the **laravel-funcqueue** configuration file:

```php
php artisan vendor:publish --provider="kundu\LaravelFuncQueue\LaravelFuncQueueServiceProvider" --tag="config"
```

This will publish a **laravel-funcqueue.php** configuration file to your **config** directory, where you can set the default queue name for queued jobs.

## **License**

KunduMagicFunctionJob is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).



> If a function has a return value, it may not be ideal to use this package, as the function will be executed as a job and it may be difficult to obtain the return value from the job. It's generally recommended to use this package for functions that perform asynchronous or background tasks, rather than functions that return values or have side effects.
> 
> If you need to obtain a return value from a function, you may want to consider using a different approach, such as calling the function directly or using a synchronous job.
