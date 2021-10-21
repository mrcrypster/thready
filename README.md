# thready
Simple way to run multi-threaded PHP scripts (based on PCNTL)

## How to use

```php
require 'thready.php';

$thready = new thready(10); # how many threads we want to have

for ( $i = 0; $i < 1000; $i++ ) {
  $thready->add_thread(function() {
    # some logic we want to execute in child threads
  });
}

```
