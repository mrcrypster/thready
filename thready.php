<?php

class thready {
  protected $threads = [],
            $max_threads = 5;
  
  public function __construct($max_threads = 5) {
    $this->max_threads = $max_threads;
  }
  
  public function add_thread($func) {
    do {
      foreach ( $this->threads as $pid ) {
        pcntl_waitpid($pid, $status, WNOHANG|WUNTRACED);
        
        if ( !posix_getsid($pid) ) {
          $this->threads = array_diff($this->threads, [$pid]);
        }
      }
      
      usleep(1000);
    }
    while ( count($this->threads) >= $this->max_threads );
    
    $pid = pcntl_fork();

    if ( $pid == -1 ) {
      exit("Error forking...\n");
    }
    else if ( $pid == 0 ) {
      $func();
      exit;
    }
    else {
      $this->threads[] = $pid;
    }
  }
}
