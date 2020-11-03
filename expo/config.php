<?php
$connection = mysqli_connect('localhost', 'cedarsla_expoadmin', 'FQ8o[}Wt$m&;', 'cedarsla_expo');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'cedarsla_expo');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}