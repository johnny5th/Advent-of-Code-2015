<?php
$str = file_get_contents('8.txt');

$strings = explode("\n", $str);
$string_chars = 0;
$slashed_chars = 0;

foreach($strings as $string) {
  // Remove whitespace
  $string = str_replace(" ", "", $string);
  $this_string_chars = strlen($string);
  $string_chars += $this_string_chars;

  $slashed_string = addslashes($string);
  $this_slashed_chars = strlen($slashed_string) + 2;

  $slashed_chars += $this_slashed_chars;
  print $string . " : " . $slashed_string . " --- " . $this_string_chars . " : " . $this_slashed_chars . "<br>";
}

print $slashed_chars - $string_chars;
