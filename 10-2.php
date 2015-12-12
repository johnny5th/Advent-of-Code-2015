<?php
$digits = 3113322113;
for($i=0; $i<50; $i++) {
  $digits = preg_replace_callback('/(\d)\1*/', function($matches) {
      return strlen($matches[0]) . substr($matches[0], 0, 1);
  }, $digits);
}

print strlen($digits);
