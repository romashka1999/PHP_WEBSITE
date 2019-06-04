<?php
require_once 'validate.php';
require_once 'base.php';
require_once 'algorithm.php';

function redirect($url)
{
    header("Location: $url");
}

function isLoggedIn()
{
    return isset($_SESSION['currentUser']);
}

function currentUser($key)
{
    return isset($_SESSION['currentUser']) ? $_SESSION['currentUser'][$key] : null;
}

?>