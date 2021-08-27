<?php

function addTime($time, $minute) {
    $time = strtotime($time);
    $endtime = date("H:i", strtotime("+".$minute." minutes", $time));
    return $endtime;
}