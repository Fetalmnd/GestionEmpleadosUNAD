<?php

//Start session so messages can be stored to show errors or success when doing CRUD actions
session_start();


$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'employees'

);
?>