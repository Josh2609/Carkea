<?php
session_start(); // get on the sesh

// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

header("Location: ../index.php"); // redirects back to home page if logged out
exit();
