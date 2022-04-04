<?php
    //include constants.php for URL
    include('../config/constants.php');
    //1. Destroy the session 
    session_destroy(); //unset's $_SESSION['USER']

    //2. Redirect to login page
    header('location:'.SITEURL.'admin/login.php');

?>