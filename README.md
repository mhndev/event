## About

This is a really simple and lightweight php package for developing event based in php.

## Installation

```
composer require mhndev/event
```

## Sample Usage

### bind an callable to an event
```php

Event::bind('order.payed',function($order){
    //do some cool stuf here
});

```

### trigger an event

```php

// pass $order object as second argument
Event::trigger('order.payed', $order);

```
