<?php
    function connect(){
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=ferrysys; charset=utf8','root','');
    
            //making sure an exception is thrown with each error
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }
        catch(PDOException $e){
            echo "Sorry, cannot connect to the database at this time<br>";
            echo  $e->getMessage()." in ".$e->getFile()." on line ".$e->getLine();
        }
    }

    function ferrySelect($pdo, $tableName){
        
    try{
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

    function selectDepartures($pdo, $depDate, $depPort){
        try{
            $sql = "SELECT * FROM departures WHERE Date = :depdate AND DepPort = :depport";
            
            $result = $pdo->prepare($sql);
            $result->bindValue(':depdate', $depDate);
            $result->bindValue(':depport', $depPort);
            $result->execute(); 
            
            
            return $result; 
        }
        catch(PDOException $e){
            echo "Sorry, cannot connect to the database at this time<br>";
            echo  $e->getMessage()." in ".$e->getFile()." on line ".$e->getLine();
        }
    }
    function insertTicket($pdo, $tdate, $ttime, $vcode, $saleprice, $depid, $unitSize){
        try{ 
            $sql = "INSERT INTO tickets (TDate, TTime, VCode, SalePrice, DepID) 
                    VALUES (:tdate, :ttime, :vcode, :saleprice, :depid)";
            
            $result = $pdo->prepare($sql);
            $result->bindValue(':tdate', $tdate);
            $result->bindValue(':ttime', $ttime);
            $result->bindValue(':vcode', $vcode);
            $result->bindValue(':saleprice', $saleprice);
            $result->bindValue(':depid', $depid);
            if($result->execute()){
                $last_id = $pdo->lastInsertId();
            }

            //echo $last_id;
            reduceCapacity($pdo, $unitSize, $depid);
            return $last_id;
        }
        catch(PDOException $e){
            echo "Sorry, cannot connect to the database at this time<br>";
            echo  $e->getMessage()." in ".$e->getFile()." on line ".$e->getLine();
        }
    }

    function reduceCapacity($pdo, $unitSize, $depid){
        try{ 
            $sql = "UPDATE departures SET Capacity = (Capacity - :unitsize) WHERE DepID = :depid";
            
            $result = $pdo->prepare($sql);
            $result->bindValue(':unitsize', $unitSize);
            $result->bindValue(':depid', $depid);
            $result->execute();            
        }
        catch(PDOException $e){
            echo "Sorry, cannot connect to the database at this time<br>";
            echo  $e->getMessage()." in ".$e->getFile()." on line ".$e->getLine();
        }
    }

    //returns an array of the vehicle codes
    function getVehicleCodes($pdo){
        try{
            $sql = "SELECT VCode FROM vehicletypes";
            $VCselect = $pdo->prepare($sql);
            $VCselect->execute();

            $codes = array();

            while($row=$VCselect->fetch()){
                array_push($codes, $row['VCode']);
            }
            return $codes;
        }
        catch(PDOException $e){
            echo "Sorry, cannot connect to the database at this time<br>";
            echo  $e->getMessage()." in ".$e->getFile()." on line ".$e->getLine();
        }
    }

?>