<?php
set_time_limit (5000);

$i = 0;
while(true) {
  $md5 = md5("ckczppom" . $i++);

  if(substr($md5, 0, 6) === "000000") {
    print $i-1;
    break;
  }
}
