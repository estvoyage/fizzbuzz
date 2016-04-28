# *fizzbuzz*

## A PHP east-oriented implementation of FizzBuzz

FizzBuzz is a kata posted on [codingdojo.org](http://codingdojo.org/cgi-bin/index.pl?KataFizzBuzz).  
According to this site, Michael Feathers and EmilyBache performed it at agile2008 when competing in "Programming with the stars" in [python](https://www.python.org), in 4 minutes.  
It was using the 04-27-2016 in Lyon, France, at [Norsys](http://www.norsys.fr) to illustrate [east-oriented programming](http://jamesladdcode.com/?p=12).

## Requierements

PHP version used to develop *fizzbuzz* was PHP 5.6.18, but minimal version is PHP 5.5.  
And *fizzbuzz* use [composer](https://getcomposer.org) as dependencies manager.

## How to use it?

Install *FizzBuzz* dependencies using [Composer](https://getcomposer.org), just do from the root directory:

```
$ composer install
```

After that, just do `php run.php` from the root directory.

## Code organization

The main file is `run.php` in the root directory.  
All classes are in the `src` directory.  
All unit tests are ine the `tests\units\src` directory.  
Fizzbuzz use [PSR-4](http://www.php-fig.org/psr/psr-4/) autoloader, so if you want read the code of:

- `fizzbuzz\number` class, go in `src/number.php`;
- `fizzbuzz\analyzer\iterator\fifo` class, go in `src/analyzer/iterator/fifo.php`.

## What is an east-oriented implementation?

In context of an east-oriented implementation, all public methods return `$this`.  
Why? Because the rigorous application of this unique rule decreases coupling and the amount of code that needs to be written, remove code duplication while increasing the clarity, cohesion, flexibility, reuse and testability of that code.  
In fact, using east-oriented principle force using *abstraction* and the lack of getter force using the *tell, don't ask* principle, *inversion of control* and *dependency injection*.

> Procedural code gets information then makes decisions.
> Object-oriented code tells objects to do things.  
> – Alec Sharp

## Unit Tests

This kata was implemented using TDD, aka Test Driven Development.  
To execute unit tests, install *FizzBuzz* using [Composer](https://getcomposer.org) with the `--dev` option:

```
$ composer install --dev
```

Run unit tests using [*atoum*](http://docs.atoum.org):

```
$ vendor/bin/atoum
```

## FAQ

### What is the origin of the east-oriented programming concept?

A James Ladd's [blog post](http://jamesladdcode.com/?p=12) but messaging is an [Alan Kay's concept](http://userpage.fu-berlin.de/~ram/pub/pub_jf47ht81Ht/doc_kay_oop_en).

### Why name of your function is so strange?

PHP syntax for method declaration is not very convenient for east-oriented programming, unlike Smalltalk or Objective-C syntax which use interleaved declaration.
So, a method like `outputForNumberIteratorIs(number\iterator $iterator, output $output)` is strictly equivalent to interleaved declation  `outputForNumberIterator: number\iterator $iterator is: output $output`.

### Why there is a statement `return $this->value;` in `fizzbuzz\output\value::__toString()`?

Primary types of [PHP](http://www.php.net) are not object,   so you must use magic method like `__toString()` to simulate a string object.

### What is `fizzbuzz\nill`?

It's an implementation of the [null object pattern](https://en.wikipedia.org/wiki/Null_Object_pattern).  
This pattern is usefull to avoid `if` and decreasing code complexity.

### Have you got any resources about east-oriented programming?

There is no "silver bullet" to understand east-oriented programming, but there are some resources with very interesting or indirect informations about it:

- The [original blog post](http://jamesladdcode.com/?p=12) by James Ladd;
- [Enlightments](http://jamesladdcode.com/2007/02/14/east-a-technique/) about east-oriented programming and Java by James Ladd;
- [Object thinking](http://www.amazon.fr/dp/0735619654) by David West;
- [Growing Object-Oriented Software, Guided by Tests](http://www.amazon.fr/dp/0321503627);
- [Practical Object-Oriented Design in Ruby: An Agile Primer](http://www.amazon.fr/dp/0321721330) by Sandi Metz;
- [Eastward Ho! A Clear Path Through Ruby With OO](http://confreaks.tv/videos/rubyconf2014-eastward-ho-a-clear-path-through-ruby-with-oo) by Jim Gay;
- The blog post [Dazed and confuzzled](https://thesecretsquad.wordpress.com/2014/10/25/dazed-and-confuzzled/) by Peter Di Salvo;
- The blog post [Putting the kibosh on getters and setters](https://thesecretsquad.wordpress.com/2015/04/28/putting-the-kibosh-on-getters-and-setters/) by Peter Di Salvo;
- The blog post [Shower idea: keyboards and object-oriented design](https://thesecretsquad.wordpress.com/2015/03/22/752/) by Peter Di Salvo;
- [A discourse](https://github.com/TheSecretSquad/chess) about an east-oriented chess game between Peter Di Salvo and James Ladd;
- [The early history of Smalltalk](http://gagne.homedns.org/~tgagne/contrib/EarlyHistoryST.html);
- An Alan Kay's post on the Squeak's mailing-list about [messaging](http://c2.com/cgi/wiki?AlanKayOnMessaging);
- [The Deep Insights of Alan Kay](http://mythz.servicestack.net/blog/2013/02/27/the-deep-insights-of-alan-kay/) by mythz;
- The IRC channel `##east` (yes, two sharp, no typo here) on Freenode (essentialy cool french guys here);
- Some [gist](https://gist.github.com/mageekguy/);
- A french [blog post](http://blog.est.voyage/phpTour2015/) and the [associated talk](http://blog.est.voyage/phpTour2015/).

## License

This *FizzBuzz* implementation is released under the FreeBSD License, see the bundled `COPYING` file for details.

## Greetings

Thanks to:

- [Norsys](http://www.norsys.fr) for wifi and room;
- [Lyon Tech Hub](http://www.lyontechhub.org) for support and organization;
- Matteo Vaccari & Antonio Carpentieri for [The Open/Closed Principle Dojo](http://fr.slideshare.net/xpmatteo/20101125-ocpxpday).
