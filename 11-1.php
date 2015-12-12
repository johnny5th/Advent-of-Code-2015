<?php

$password = "hxbxwxba";
set_time_limit(480);

while(true) {
  if(check_password(++$password))
    break;
}

print $password;

function check_password($password) {

  preg_match_all('/(\w)\1/', $password, $matches);
  if(sizeof($matches[0]) < 2)
    return false;

  if(preg_match('/(i|o|l)/', $password))
    return false;

  $password_array = str_split($password);
  for($i=0; $i<sizeof($password_array); $i++) {
    if(array_key_exists($i+1, $password_array) && array_key_exists($i+2, $password_array)) {
      $b = $password_array[$i];
      $b++;
      $c = $password_array[$i];
      $c++; $c++;
      if($password_array[$i+1] == $b && $password_array[$i+2] == $c) {
        return true;
      }
    }
  }

  return false;
}
