Exception
=========

[![Build Status][]](https://travis-ci.org/phine/lib-observer)
[![Coverage Status][]](https://coveralls.io/r/phine/lib-observer)
[![Latest Stable Version][]](https://packagist.org/packages/phine/observer)
[![Total Downloads][]](https://packagist.org/packages/phine/observer)

An implementation of the observer design pattern.

Usage
-----

```php
use Phine\Observer\Subject;
use Phine\Observer\SubjectInterface;
use Phine\Observer\ObserverInterface;

class MySubject extends Subject
{
    private $state;

    public function __construct($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }
}

class MyObserver implements ObserverInterface
{
    public function receiveUpdate(SubjectInterface $subject)
    {
        echo 'Turned ', $subject->getState(), ".\n";
    }
}

$on = new MySubject('on');
$on->registerObserver(new MyObserver());
$on->notifyObservers();

/*
 * Echoes: "Turned on."
 */
```

Requirement
-----------

- PHP >= 5.3.3
- [Phine Exception][] >= 1.0.0

Installation
------------

Via [Composer][]:

    $ composer require "phine/observer=~1.0"

Documentation
-------------

You can find the documentation in the [`docs/`](docs/) directory.

License
-------

This library is available under the [MIT license](LICENSE).

[Build Status]: https://travis-ci.org/phine/lib-observer.png?branch=master
[Coverage Status]: https://coveralls.io/repos/phine/lib-observer/badge.png
[Latest Stable Version]: https://poser.pugx.org/phine/observer/v/stable.png
[Total Downloads]: https://poser.pugx.org/phine/observer/downloads.png
[Phine Exception]: https://github.com/phine/lib-exception
[Composer]: http://getcomposer.org/
