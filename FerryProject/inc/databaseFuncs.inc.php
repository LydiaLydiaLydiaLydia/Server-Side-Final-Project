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

            $result = null;
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
            $result = null;            
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

            $VCselect = null;
            return $codes;
        }
        catch(PDOException $e){
            echo "Sorry, cannot connect to the database at this time<br>";
            echo  $e->getMessage()." in ".$e->getFile()." on line ".$e->getLine();
        }
    }

    function insertVehicle($pdo){
        try{
            $sql = "INSERT INTO vehicletypes(VDescription, VCode, Price, Units, VStatus) VALUES (:vdescription, :vcode, :price, :units, :vstatus)";
            $Vinsert = $pdo->prepare($sql);
            $Vinsert->bindValue(':vdescription', $_SESSION['forVehicle']['vDescription']);
            $Vinsert->bindValue(':vcode', $_SESSION['forVehicle']['vCode']);
            $Vinsert->bindValue(':price', $_SESSION['forVehicle']['price']);
            $Vinsert->bindValue(':units', $_SESSION['forVehicle']['units']);
            $Vinsert->bindValue(':vstatus', $_SESSION['forVehicle']['vStatus']);
            $Vinsert->execute(); 

            $Vinsert = null;
        }
        catch(PDOException $e){
            echo "Sorry, cannot connect to the database at this time<br>";
            echo  $e->getMessage()." in ".$e->getFile()." on line ".$e->getLine();
        }
    }

?>