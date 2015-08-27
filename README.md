# kairet-cms [![Build Status](https://travis-ci.org/kairet/kairet-cms.svg?branch=master)](https://travis-ci.org/kairet/kairet-cms) [![Coverage Status](https://coveralls.io/repos/kairet/kairet-cms/badge.svg?branch=master&service=github)](https://coveralls.io/github/kairet/kairet-cms?branch=master) [![StyleCI](https://styleci.io/repos/39338894/shield)](https://styleci.io/repos/39338894)
This project is aiming to create a php based content management system backend. The general goal is to create a system
extensible with plugins that is only loosely connected to its frontend(s) using a tested and documented api.

### Used technologies

- [PHP 5.4](http://www.php.net/)
- [PHPUnit](https://github.com/sebastianbergmann/phpunit)
- [Composer](https://github.com/composer/composer)
- [Doctrine2](https://github.com/doctrine/doctrine2)

### Development

**This project is currently work-in-progress.**

[PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) is used as coding
style and [StyleCI](https://styleci.io/repos/39338894) enforces this on every push/pr.

Unittests are automatically executed on every build using [Travis-CI](https://travis-ci.org/kairet/kairet-cms). PHP
version 5.4, 5.5 and 5.6 are tested.

The database schema is managed "in code" using [Doctrine](https://github.com/doctrine/doctrine2) and can be set up or
updated in test/development/production environments.

Documentation is currently mostly done in the project's [wiki](https://github.com/kairet/kairet-cms/wiki) or in code
using PHPDoc.
