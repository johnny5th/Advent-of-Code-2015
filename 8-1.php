<?php
$str = file_get_contents('8.txt');

$strings = explode("\n", $str);
$string_chars = 0;
$mem_chars = 0;

foreach($strings as $string) {
  // Remove whitespace
  $string = str_replace(" ", "", $string);
  $this_string_chars = strlen($string);
  $string_chars += $this_string_chars;

  $this_mem_chars = 0;
  $mem_string = substr($string, 1, -1);
  $mem_string = str_replace('\"', '', $mem_string, $count);
  $this_mem_chars += $count;
  $mem_string = str_replace('\\\\', '', $mem_string, $count);
  $this_mem_chars += $count;
  $mem_string = preg_replace('~(\\\\x[a-f0-9]{2})~i', '', $mem_string, -1, $count);
  $this_mem_chars += $count;
  $this_mem_chars += strlen($mem_string);

  $mem_chars += $this_mem_chars;
  print $string . " : " . $mem_string . " --- " . $this_string_chars . " : " . $this_mem_chars . "<br>";
}

print $string_chars - $mem_chars;
