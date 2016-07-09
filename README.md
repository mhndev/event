## About

This is a really simple and lightweight php package for developing event based in php.

## Installation

```
composer require mhndev/event
```

## Sample Usage

### bind an closure to an event
```php

Event::bind('order.payed',function($order){
    //do some cool stuf here
});

```

### Another example
```php
class MyClass {
    public function __invoke($order) {
        //do something here
    }
}

$myObject = new MyClass;


Event::bind('order.payed', $myObject($order));


```

### trigger an event

```php

// pass $order object as second argument
Event::trigger('order.payed', $order);

```


## Todos

-implement tests
