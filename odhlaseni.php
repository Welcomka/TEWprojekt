<?php
session_start();
if (!isset($_SESSION['UzivatelID']))
{
    header('Location: prihlaseni.php');
    exit();
}

else 
{
    session_destroy();
    header('Location: prihlaseni.php');
    exit();
}
?>