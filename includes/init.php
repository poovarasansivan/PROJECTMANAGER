<?php

$_path = "/temp";


function head()
{
    require 'head.php';
}
function script()
{
    require 'script.php';
}
function menu()
{
    require 'navbar.php';
}

function db()
{
    $db = new mysqli("localhost", "root", "", "dashboard");
    return $db;
}
function footer()
{
    require 'footer.php';
}

function checkSession()
{
    require 'session.php';
}