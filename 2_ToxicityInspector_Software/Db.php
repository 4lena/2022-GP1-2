<?php
include("vendor/autoload.php");

$client = new MongoDB\Client(
    'mongodb+srv://doadmin:TwP50hB27l143HW9@db-mongodb-blr1-89764-b2f084a2.mongo.ondigitalocean.com/admin?tls=true&authSource=admin&replicaSet=db-mongodb-blr1-89764'
);
$db = $client->Toxicity_Inspector;
?>
