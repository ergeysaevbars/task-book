<?php
function dump($arg){
    echo "<pre>";
    print_r($arg);
    echo "</pre>";
}

function setError($key, $value){
    $_SESSION['errors'][$key] = $value;
}

function getError($key){
    $error = $_SESSION['errors'][$key];
    unset($_SESSION['errors'][$key]);
    return $error;
}

function setValue($key, $value){
    $_SESSION['values'][$key] = $value;
}

function getValue($key){
    $value = $_SESSION['values'][$key];
    unset($_SESSION['values'][$key]);
    return $value;
}

function getCountErrors(){
    return count($_SESSION['errors']) > 0;
}

function errorExists($key){
    return isset($_SESSION['errors'][$key]);
}