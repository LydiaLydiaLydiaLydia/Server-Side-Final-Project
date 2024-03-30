<?php
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=ferrysys; charset=utf8','root','');

        //making sure an exception is thrown with each error
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM departures WHERE date = '.$depDate.' AND depport = '.$depPort;
        
    }
    catch(PDOException $e){
        echo "Sorry, cannot connect to the database at this time<br>";
        echo  $e->getMessage()." in ".$e->getFile()." on line ".$e->getLine();
    }
?>