## **FuncQueue**

**FuncQueue is a Laravel package that allows you to easily run functions as queued jobs. This package provides a simple and flexible functions for dispatching queued jobs that run the specified function in the specified class.**

## **Installation**

You can install the package using Composer:

```plaintext
composer require kundu/laravel-funcqueue
```

The package will automatically register its service provider.

## **Usage**

To use the Laravel FuncQueue package, you first need to import the **LaravelFuncQueue** class:

```php
use kundu\LaravelFuncQueue\LaravelFuncQueue;
```

### **Running a function as a job**

To run a function as a job, you can use the **LaravelFuncQueue::run()** method. This method takes the name of the class that contains the function, the name of the function, and an array of parameters to be passed to the function.

```php
LaravelFuncQueue::run(MyClass::class, 'myMethod', ['param1', 'param2']);
```

You can also pass constructor parameters to the class by using the **withConstructor()** method:

```php
LaravelFuncQueue::withConstructor(['param1'])->run(MyClass::class, 'myMethod', ['param2']);
```

### **Specifying the queue**

You can specify the name of the queue on which the job should be run using the **onQueue()** method. This method takes a single parameter, which is the name of the queue.

```php
LaravelFuncQueue::run(MyClass::class, 'myMethod', ['param1', 'param2'])->onQueue('default');
```

### **Handling exceptions**

To handle exceptions that occur while running a job, you can catch the exception and log it to the Laravel log using the **Log** facade:

## **License**

KunduMagicFunctionJob is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

**Limitations and Recommendations for Using LaravelFuncQueue Package**

> If a function has a return value, it may not be ideal to use this package, as the function will be executed as a job and it may be difficult to obtain the return value from the job. It's generally recommended to use this package for functions that perform asynchronous or background tasks, rather than functions that return values or have side effects.
> 
> If you need to obtain a return value from a function, you may want to consider using a different approach, such as calling the function directly or using a synchronous job.
