<?php

function print_array ($arr) {
    echo '<pre>' . print_r($arr, true) . '</pre>';
}

function array2str ($arr) {
    return '<pre>' . print_r($arr, true) . '</pre>';
}