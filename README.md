# thready
Simple way to run multi-threaded PHP scripts (based on PCNTL)

## How to use

```php
require 'thready.php';

$thready = new thready(10); # how many threads we want to have

for ( $i = 0; $i < 1000; $i++ ) {
  # this will ensure we're launching only as max threads as we have passed to thready constructor
  $thready->add_thread(function() {
    # some logic we want to execute in child threads
  });
}

```
