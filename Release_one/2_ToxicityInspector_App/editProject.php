<?php
session_start();
include("Db.php");

if (!(isset($_SESSION["Role"])) || $_SESSION["Role"] != "User")
    echo '<script>window.location="signIn.php"; alert("You don\'t have access to the requested page!, Please sign in first.");</script>';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = $_SESSION["username"];
$collectionU = $db->users;
$collectionP = $db->projects;
$collectionF = $db->files;

$name = $_GET['name'];
$oldProjectName = $_GET['ProjectName'];
$project = $collectionP->findOne(['username' => $username, 'ProjectName' => $oldProjectName]);
$oldDes = $project['ProjectDesc']; // retrive description 
$flag = 0;
if (isset($_POST['submit'])) {
    $newProjectName = $_POST['eName'];
    $newDes = $_POST['eDes'];
    if ($newProjectName == $oldProjectName && $oldDes == $newDes) { // if the project name and the discription are same (no update)
        $flag = 1;
        $locat = 'UserProjects.php?name=' . $name;
        echo '<script>window.location="' . $locat . '";</script>';
    } else if ($newProjectName == $oldProjectName && $flag == 0) { // if the project name same but the discription changed
        $flag = 1;
        $InfoEdit = $collectionP->updateOne(
            ['ProjectName' => $oldProjectName, 'ProjectDesc' => $oldDes, 'username' => $username], // conditions 
            ['$set' => ['ProjectDesc' => $newDes]]
        ); // updates 
        $locat = 'UserProjects.php?name=' . $name;
        echo '<script>window.location="' . $locat . '";</script>';
    } else {
        $checkExist = $collectionP->find(['username' => $username]);
        foreach ($checkExist as $check) { // if the new project name exist for the same user 
            if ($check['ProjectName'] == $newProjectName) {
                $flag = 1;
                echo '<script>alert("Project Name Is Already Exist!");</script>';
                $locat = 'UserProjects.php?name=' . $name;
                echo '<script>window.location="' . $locat . '";</script>';
            }
        }
    }
    if ($flag == 0) {
        $InfoEdit = $collectionP->updateOne(
            ['ProjectName' => $oldProjectName, 'ProjectDesc' => $oldDes, 'username' => $username], // conditions 
            ['$set' => ['ProjectName' => $newProjectName, 'ProjectDesc' => $newDes]]
        ); // updates 
        $fileEdit = $collectionF->updateMany(
            ['ProjectName' => $oldProjectName,'username' => $username], // conditions 
            ['$set' => ['ProjectName' => $newProjectName]]
        ); // updates 

        if ($InfoEdit->getMatchedCount()) // edited successsfully
            echo '<script>alert("Project Information Updated Successfully");</script>';
        else // failed 
            echo '<script>alert("Update Opreation Failed! Please Try Again!");</script>';

        $locat = 'UserProjects.php?name=' . $name;
        echo '<script>window.location="' . $locat . '";</script>';
    }
}
?>