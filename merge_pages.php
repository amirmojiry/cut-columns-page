<?php

ini_set('max_execution_time', 400000000000);
include_once 'functions.php';

for ($i = 1405; $i <= 1541; $i+=4) {
    $i = strval($i);
    $j = strval($i + 2);
    merge_two_image ("merged_output2/".$i.".jpg", "merged_output2/".$j.".jpg");
}

?>