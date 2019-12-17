<?php

session_start();
$_SESSION = [];
unset($_SESSION);
session_destroy();
header('location: testloginpage.php?logout=success');