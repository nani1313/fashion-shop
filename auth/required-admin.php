<?php

if ($loggedInUser['role'] != 'admin') {
    header('Location: ../error/503.php');
} 