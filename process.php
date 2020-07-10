<?php

session_start();

$mysqli = new mysqli('localhost', 'root', 'root', 'employees') or die(mysqli_error(@mysqli));

$id = 0;
$update = false;
$name = '';
$email = '';
$phone = '';

if (isset($_POST['save'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    $mysqli->query("INSERT INTO data (name, email, phone) VALUES('$name','$email','$phone')") or
            die($mysqli->error);
    
    $_SESSION['message'] = "The employee has been added!";
    $_SESSION['msg_type'] = "success";
    
    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());
    
    $_SESSION['message'] = "The employee has been deleted!";
    $_SESSION['msg_type'] = "danger";
    
    header("location: index.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    if (count($result)==1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    $mysqli->query("UPDATE data SET name='$name', email='$email', phone='$phone' WHERE id=$id")
            or die($mysqli->error());
    
    $_SESSION['message'] = "The employee details have been updated!";
    $_SESSION['msg_type'] = "warning";
    
    header('location: index.php');
}