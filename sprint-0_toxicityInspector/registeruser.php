<?php
include("Db.php");

$collection = $db->users;

$insertOneResult = $collection->insertOne([
    'email'      => 'noura123@gmail.com',
    'FirstName'       => 'noura',
    'LastName'       => 'Ahmad',
    'password'   => md5('123'),
    
]);

if($insertOneResult->getInsertedCount()){

    echo "USER SUCCESSFULLY REGISTERED";
    exit;

}else{
    echo "ERROR ON REGISTER RECORD";
    exit;    
}



?>