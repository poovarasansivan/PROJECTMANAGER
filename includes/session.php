<?php

$path = $GLOBALS['_path'];
session_start();

if (!isset($_SESSION['userData']) || $_SESSION['userData'] == null || $_SESSION['userData'] == '') {

    session_name("PROJECTMANAGER");

    header("Location: $path" . "auth/login");
    exit();
}