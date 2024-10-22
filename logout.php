<?php
session_start();
$_SESSION['message'] = 'Bye-bye!';

unset($_SESSION['loggedin']);
unset($_SESSION['user']);

header("Location: /");
exit();
