<?php
include '../../includes/init.php';

session_unset();
session_destroy();

header("Location: ../login");
?>