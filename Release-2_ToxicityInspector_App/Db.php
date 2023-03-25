<?php
include("vendor/autoload.php");

$client = new MongoDB\Client(
    'mongodb+srv://doadmin:i7X2T8E5KqW4Z610@db-mongodb-blr1-89764-b2f084a2.mongo.ondigitalocean.com/admin?authSource=admin&replicaSet=db-mongodb-blr1-89764&tls=true'
);
$db = $client->Toxicity_Inspector;
?>
