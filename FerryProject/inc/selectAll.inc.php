<?php
    function ferrySelect($tableName){
        
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=ferrysys; charset=utf8','root','');

        //making sure an exception is thrown with each error
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM '.$tableName;
        $result = $pdo->prepare($sql);
        $result->execute(); 
        return $result; 
    }
    catch(PDOException $e){
        echo "Sorry, cannot connect to the database at this time<br>";
        echo  $e->getMessage()." in ".$e->getFile()." on line ".$e->getLine();
    }
    }
?>