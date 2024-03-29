<?php
    include 'myHeader.php';

    if (isset($_POST['submitdetails'])) {                   
        try { 
            $vType = $_POST['vType'];
            $vCode = $_POST['vCode'];
            $price = $_POST['price'];
            $units = $_POST['units'];

            if ($vType == ''  or $vCode == '' or $price == '' or $units == ''){
                echo("You did not complete the insert form correctly <br> ");
                }
            else{
                //must do validation here
                settype($price, "float");
                settype($units, "integer");
                
                $pdo = new PDO('mysql:host=localhost;dbname=ferrysys; charset=utf8', 'root', ''); 
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
                $sql = "INSERT INTO vehicletypes (VDescription, VCode, Price, Units, VStatus) VALUES(:vType, :vCode, :price, :units, 'A')";
                            
                $stmt = $pdo->prepare($sql);
                            
                    $stmt->bindValue(':vType', $vType);
                    $stmt->bindValue(':vCode', $vCode);
                    $stmt->bindValue(':price', $price);
                    $stmt->bindValue(':units', $units);
                            
                    $stmt->execute();
                    ?>
                    <p>Added successfully. Try doing another</p>
                    <?php
                }
            } 
        catch (PDOException $e) { 
            $title = 'An error has occurred';
            $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
            } 
        } 
                        
    include 'addVehicleType.html';
                        
?>