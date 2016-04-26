# *fizzbuzz*

## A PHP east-oriented implementation of FizzBuzz

FizzBuzz is a kata posted on [codingdojo.org](http://codingdojo.org/cgi-bin/index.pl?KataFizzBuzz).
According to this site, Michael Feathers and EmilyBache performed it at agile2008 when competing in "Programming with the stars" in [python](https://www.python.org), in 4 minutes.
It was using in Lyon, France, at [Norsys](http://www.norsys.fr) to illustrate [east-oriented programming](http://jamesladdcode.com/?p=12).

## How to use it?

Install *FizzBuzz* dependencies using [Composer](https://getcomposer.org):

```
$ composer install
```

After that, just do `php run.php` in the root directory.

## Code organization

All classes are in the `src` directory.
All unit tests are ine the `tests\units\src` directory.
Fizzbuzz use [PSR-4](http://www.php-fig.org/psr/psr-4/) autoloader, so if you want read the code of:

- `fizzbuzz\number` class, go in `src/number.php`;
- `fizzbuzz\analyzer\iterator\fifo` class, go in `src/analyzer/iterator/fifo.php`.

## What is an east-oriented implementation?

In the context of an east-oriented implementation, all public methods return `$this`.
Why? Because the rigorous application of this unique rule decreases coupling and the amount of code that needs to be written, while increasing the clarity, cohesion, flexibility, reuse and testability of that code.
In fact, using east-oriented principle force using *abstraction* and the lack of getter force using the *tell, don't ask* principle, *inversion of control* and *dependency injection*.

## Unit Tests

This kata was implemented using TDD, aka Test Driven Development.
To execute unit tests, install *FizzBuzz* using [Composer](https://getcomposer.org) with the `--dev` option:

```
$ composer install --dev
```

Run it using **atoum**:

```
$ vendor/bin/atoum
```

## FAQ

### Why there is a statement `return $this->value;` in `fizzbuzz\output\value::__toString()`?

[PHP](http://www.php.net) is not a true object oriented programming language: its primary types are not object.  
So you must use magic method like `__toString()` to simulate a string object.

### What is `fizzbuzz\nill`?

It's an implementation of the [null object pattern](https://en.wikipedia.org/wiki/Null_Object_pattern).

## License

This *FizzBuzz* implementation is released under the FreeBSD License, see the bundled `COPYING` file for details.

## Greetings

Thanks to:

- [Norsys](http://www.norsys.fr) for wifi and room;
- [Lyon Tech Hub](http://www.lyontechhub.org) for support and organization;
- Matteo Vaccari & Antonio Carpentieri for [The Open/Closed Principle Dojo](http://fr.slideshare.net/xpmatteo/20101125-ocpxpday).
