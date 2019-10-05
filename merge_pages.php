<?php

ini_set('max_execution_time', 400000000000);
include_once 'functions.php';

if (! empty ( $_GET['first'] ) && ! empty ( $_GET['end'] ) ) {
    $first = $_GET['first'];
    $end = $_GET['end'];
    for ($i = $first; $i <= $end; $i++) {
        $i = strval($i);
        $j = strval($i + 2);
        merge_two_image ("merged_output2/".$i.".jpg", "merged_output2/".$j.".jpg");
    }
}

?>