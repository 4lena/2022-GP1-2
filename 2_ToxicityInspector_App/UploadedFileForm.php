<?php

session_start();
include("Db.php");
if (isset($_POST['submit']) && (isset($_SESSION["Role"])) &&  $_SESSION["Role"] == "User") {
    
    $username = $_SESSION["username"];
    $collectionP = $db->projects;
    $collectionF = $db->files;
    $name = $_GET['name'];

    $query = array('username' => $_SESSION['username'], 'ProjectName' => $_POST['ProjectName'], 'FileName' => $_POST['FileName']);
    
    if ($collectionF->findOne($query)) { // if the file is already exist 
        echo '<script>window.location="ProjectPage.php?name=' . $name . '&ProjectName=' . $_POST['ProjectName'] . '"; alert("This file is already exist!");</script>';
    } 
    else {
        $insertOneResult = $collectionF->insertOne([ 
            'userID'=> $_SESSION['userID'],
            'ProjectName' => $_POST['ProjectName'],
            'FileName' => $_POST['FileName'],
            'UploadedFile' => null,
            'Languages' => $_POST['Languages'],
            'username' => $username,
            'ToxicityLevel' => null, // as initial value before checking 
        ]);
        
        $fileInfo = $collectionF->findOne(['username' => $username, 'ProjectName' => $_POST['ProjectName'] , 'FileName' => $_POST['FileName']]); 
        $fileID = $fileInfo['_id'] ; // retrive id to store file in directory

        if (is_dir('Uploads/')) { // if directory is exist 
            $uploaddir = 'Uploads/';
            $file = $_FILES['UploadedFile']['name'];
            $uploadfile = $uploaddir . $fileID .'.csv';
            $temp = $_FILES['UploadedFile']['tmp_name'];
            move_uploaded_file($temp, $uploadfile);
            
        } else {  // if directory is not exist 
            $uploaddir = 'Uploads/';
            $file = $_FILES['UploadedFile']['name'];
            umask(mask);
            mkdir($uploaddir, 0775);
            $uploadfile = $uploaddir . $fileID .'.csv' ;
            $temp = $_FILES['UplocollectionFadedFile']['tmp_name'];
            move_uploaded_file($temp, $uploadfile);
        }

        $EditDir = $collectionF->updateOne( // store file in directory with file id added
            ['username' => $username, 'ProjectName' => $_POST['ProjectName'], 'FileName' => $_POST['FileName']], // conditions 
            ['$set' => ['UploadedFile' => $uploadfile]]); // updates 

        // fine the project to increment the number of files based on the file's language 
        $project = $collectionP->findOne(['username' => $username, 'ProjectName' => $_POST['ProjectName']]);
        if ($_POST['Languages'] == 'English') { // if file's language is english
            $project = $collectionP->findOne(['username' => $username, 'ProjectName' => $_POST['ProjectName']]);
            $count = $project['NumberOfEnglishFiles']+1;
            $FileIncrement = $collectionP->updateOne(
                    ['ProjectName' => $_POST['ProjectName'], 'username' => $username],
                    ['$set' => ['NumberOfEnglishFiles' => $count]]);    
        } 
        
        else if ($_POST['Languages'] == 'Arabic') { // if file's language is arabic
            $project = $collectionP->findOne(['username' => $username, 'ProjectName' => $_POST['ProjectName']]);
            $count = $project['NumberOfArabicFiles']+1;
            $FileIncrement = $collectionP->updateOne(
                    ['ProjectName' => $_POST['ProjectName'], 'username' => $username],
                    ['$set' => ['NumberOfArabicFiles' => $count]]);
        }

        if ($insertOneResult->getInsertedCount() && $FileIncrement->getMatchedCount() && $EditDir->getMatchedCount()) { // // if the insert file, increment number of files and directory update opreations successfully done 
            echo '<script>window.location="ProjectPage.php?ProjectName=' . $_POST['ProjectName'] . '&name=' . $name . '"; alert("File Uploaded Successfully!");</script>';
        } else // error on one of them or both 
            echo '<script>window.location="ProjectPage.php?name=' . $name . '&ProjectName=' . $_POST['ProjectName'] . '"; alert("Error On Uploading The File! Please try again");</script>';
    }
} else
    echo '<script>window.location="ProjectPage.php?name=' . $name . '&ProjectName=' . $_POST['ProjectName'] . '"</script>';
?>