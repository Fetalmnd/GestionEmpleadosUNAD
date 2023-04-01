<?php

//Start session so messages can be stored to show errors or success when doing CRUD actions
session_start();


$conn = mysqli_connect(
    'sql112.epizy.com',
    'epiz_33923845',
    '9p1ksybc',
    'epiz_33923845_employees'
);
?>