# C# String.Format-ish String formatter

C# style string formatting (without optional format string)

## Usage

simple format

```php
use Youhey\StringFormatter\Formatter as F;

// output "はじめまして 世界!"
echo (new F("{hello} {world}!")->compile(["hello" => "はじめまして", "world" => "世界"]);

// output "hello world!"
echo (new F("{0} {1}!")->compile("hello", "world");
```

## Test

```console
# set up Docker images for php 7.2
$ docker build -t youhey/php72-stringformatter docker/php72

# set up Docker images for php 7.1
$ docker build -t youhey/php71-stringformatter docker/php71

# set up Docker images for php 7.0
$ docker build -t youhey/php70-stringformatter docker/php70

# composer install
$ docker run --rm -v "$(pwd):/work" youhey/php72-stringformatter composer install
# or docker run --rm -v "$(pwd):/work" youhey/php71-stringformatter composer install
# or docker run --rm -v "$(pwd):/work" youhey/php70-stringformatter composer install

# to run tests

$ docker run --rm -v "$(pwd):/work" youhey/php72-stringformatter composer test
# or docker run --rm -v "$(pwd):/work" youhey/php71-stringformatter composer test
# or docker run --rm -v "$(pwd):/work" youhey/php70-stringformatter composer test
```
