<?php

ini_set('max_execution_time', 300000);
include_once 'functions.php';

if (! empty ($_GET['p'] )) {
    $i = $_GET['p'];
    convert_image_to_columns ("input/Farhange Farsi Amiyane-Najafi_".$i.".jpg");
    header ("Location: /?p=$i");
}

if (! empty ( $_GET['first'] ) && ! empty ( $_GET['end'] ) ) {
    $first = $_GET['first'];
    $end = $_GET['end'];
    for ($i = $first; $i <= $end; $i++) {
        convert_image_to_columns ("input/Farhange Farsi Amiyane-Najafi_".$i.".jpg");
    }
}


?>