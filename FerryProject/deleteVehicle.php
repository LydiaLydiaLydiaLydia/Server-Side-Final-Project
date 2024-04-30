
<?php
session_start();
$pg_title = "Admin Dashboard | FerrySYS";
$pg_script = "scripts/delete.js";
include "inc/header.inc.php";
include "inc/databaseFuncs.inc.php";

if(isset($_POST['confirmDelete'])){
    $softdelete = false;
    $pdo = connect();
    for($i = 0; $i< count($_SESSION['TVCodes']); $i++){
        if(($_SESSION['TVCodes'][$i]) == ($_SESSION['vehicle']['vCode'])){
            $softdelete = true;
            break;
        }
    }
    if($softdelete){
        $_SESSION['vehicle']['vStatus'] = 'U';
        updateVehicle($pdo, $_SESSION['vehicle']);
        ?>
        <script defer>
            hideButton();
        </script>
        <div id = 'alert'>
        <p>Vehicle successfully discontinued</p>
        
        <a href = 'deleteVehicle.php'>Delete another</a>
        <div>
        <?php
    }
    else{
        deleteVehicle($pdo, $_SESSION['vehicle']);
        session_destroy();
        ?>
        <script defer>
            hideButton();
        </script>
        <div id = 'alert'>
        <p>Vehicle successfully deleted</p>
        
        <a href = 'deleteVehicle.php'>Delete another</a>
    </div>
        <?php
    }
    $pdo = null;
}

//loading in vcodes that exist in tickets, so we don't hard-delete a necessary constraint
if(!isset($_POST['vehicleType'])){
    $pdo = connect();
    $_SESSION['TVCodes'] = getTicketVCodes($pdo);
//loading in VehicleTypes for user selection
    $_SESSION['vehicles'] = getVehicles($pdo);
    $pdo = null;
}

?>
<div id = "content"> 
<form method = 'post' action = 'deleteVehicle.php'>
    <select id = "vehicleType" name = "vehicleType">
        <?php
            foreach($_SESSION['vehicles'] as $key => $value){
        ?>

        <option value = "<?php echo $key; ?>" id = "<?php echo $key; ?>">
            <?php echo $key; ?>
        </option>

        <?php
            }
        ?>
    </select>
    <input type = "submit" value = "See Details" id = "descSubmit">
</form>
<?php
if(isset($_POST['vehicleType'])){
    $VDescription = $_POST['vehicleType'];
    $_SESSION['vehicle'] = array(
        'vCode' => $_SESSION['vehicles'][$VDescription]['vCode'],
        'vDescription' => $VDescription,
        'price' => $_SESSION['vehicles'][$VDescription]['price'],
        'units' => $_SESSION['vehicles'][$VDescription]['units'],
        'vStatus' => 'A'
    );
}
if(isset($_POST['vehicleType']) OR (isset($_POST['confirmDelete']))){

    ?>

<div id = "vDetails">
<form  action = "deleteVehicle.php" method = "post">
    <p><?php echo $_SESSION['vehicle']['vDescription']; ?></p>
    <p>Vehicle Code: <?php echo $_SESSION['vehicle']['vCode']; ?></p>
    <p>Vehicle Price: <?php echo $_SESSION['vehicle']['price']; ?></p>
    <p>Vehicle Units: <?php echo $_SESSION['vehicle']['units']; ?></p>
    <input type = 'submit' name = "confirmDelete" value = 'confirm delete' id = "submit">
</form>

<script>
    comboBoxSelected("<?php echo $_SESSION['vehicle']['vDescription']; ?>");
    displayDetails();
</script>
    <?php
}
if(isset($_POST['confirmDelete'])){
    ?>
    <script>
        hideButton("descSubmit");
        hideButton("submit");
    </script>
    <?php
}
?>
</div>
<?php

include "inc/footer.inc.php";
?>