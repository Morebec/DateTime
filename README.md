# Datetime
[![Build Status](https://travis-ci.com/Morebec/Datetime.svg?branch=master)](https://travis-ci.com/Morebec/Collections)

The DateTime component provides classes and functionality for dates and times.
It serves as an ACL wrapper around CackePHP/Chronos for Orkestra.
It also provides a settable SystemClock to allow changing the dates for tests.
All classes are immutable and do not provide any mutable implementation.

## Installation
```bash
composer require morebec/datetime
```

## Running Tests
```bash
php vendor/bin/phpunit --bootstrap vendor/autoload.php tests
```

## Contributing
Thank you for your interest :)  
To contribute, please read the `CONTRIBUTING.md` guidelines.

## Getting help
To get help, open a new issue on this repository.  
For Morebec team members, please use the appropriate internal channels.
