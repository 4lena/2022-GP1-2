<?php
session_start();
include("Db.php");

$collection = $db->users;
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $userExist = $collection->findOne(['username' => $username]);
    if ($userExist['username'] == $username) { // ceck if this username already exist 
        echo '<script>window.location="signIn.php"; alert("This username is already exist, Change the username Or sign in");</script>';
    }
    else{
    $insertOneResult = $collection->insertOne([
        'username' => $username,
        'FirstName' => $_POST['first_name'],
        'LastName' => $_POST['last_name'],
        'password' => md5($_POST['password']),
    ]);
    $fname = $_POST['first_name'];
    if ($insertOneResult->getInsertedCount()) {
        $userInfo = $collection->findOne(['username' => $username]);
        $_SESSION['userID']= $userInfo['_id'];
        $_SESSION['Role'] = "User"; // set session attribute role
        $_SESSION['username'] = $username; // set session attribute username
        $_SESSION['FirstName'] = $_POST['first_name']; // set session attribute FirstName
        $_SESSION['LastName'] = $_POST['last_name']; // set session attribute LastName
        echo '<script>window.location="userHome.php?name=' .$fname . '"; alert("Signed Up successfully!");</script>';
    } else
        echo '<script>window.location="signup.php"; alert("Error on registerd record! Please try again");</script>';
}} 
else
    echo '<script>window.location="index.php";</script>';
?>
