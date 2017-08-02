## About

This is a really simple and lightweight php package for developing event based software

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

### Entity ( Model ) Observer

Binding an observer for a specific event on a model.

```php

BaseEntityDriver::addObserver('before_update', function($driver){

});
```

Firing an Event on a model object.

Active Record Pattern

```php
class User
{
    use \mhndev\event\ObservableTrait;
    
    
    function update(array $data)
    {
        $user = $this;
        
        $this->fireEvent('before_update', $this);

        $updatedUser = $this->update($array);

        $driver->fireEvent('after_update', $user, $updatedUser);
    }
}


```

Data Mapper Pattern


```php

class User
{
    use \mhndev\event\ObservableTrait;
}


class UserRepository
{


    function update($user_identifier, array $data)
    {
        $user = $this->findByIdentifier($user_identifier);

        $user->buildByOptions($data);

        $user->fireEvent('before_update', $user);

        $updatedUser = $this->update($user);

        $driver->fireEvent('after_update', $user, $updatedUser);

        return $updatedUser;
    }
}


```

## Todos

-implement tests
