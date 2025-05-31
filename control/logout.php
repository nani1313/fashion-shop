<?php
session_start();

// clear session
$_SESSION = [];

header('Location: ../view/login.php'); 