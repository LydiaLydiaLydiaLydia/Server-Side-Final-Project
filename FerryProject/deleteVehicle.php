
  <?php
session_start();
$pg_title = "Admin Dashboard | FerrySYS";
$pg_script = "scripts/delete.js";
include "inc/header.inc.php";
include "inc/databaseFuncs.inc.php";

//loading in vcodes that exist in tickets, so we don't hard-delete a necessary constraint
$pdo = connect();
$_GLOBALS['TVCodes'] = getTicketVCodes($pdo);
//loading in VehicleTypes for user selection
$_GLOBALS['vehicles'] = getVehicles($pdo);
?>
<div id = "content"> 
<form method = 'post' action = 'deleteVehicle.php'>
    <select id = "vehicleType" name = "vehicleType">
        <?php
            foreach($_GLOBALS['vehicles'] as $key => $value){
        ?>

        <option value = "<?php echo $key; ?>" id = "<?php echo $key; ?>">
            <?php echo $key; ?>
        </option>

        <?php
            }
        ?>
    </select>
    <input type = "submit" value = "See Details">
</form>
<?php
if(isset($_POST['vehicleType'])){
    $VDescription = $_POST['vehicleType'];
    $_SESSION['vehicle'] = array(
        'vCode' => $_GLOBALS['vehicles'][$VDescription]['vCode'],
        'vDescription' => $VDescription,
        'price' => $_GLOBALS['vehicles'][$VDescription]['price'],
        'units' => $_GLOBALS['vehicles'][$VDescription]['units'],
        'vStatus' => 'A'
    );
}
if(isset($_POST['vehicleType']) OR (isset($_POST['confirmDelete']))){
    
    //echo "<p>".$VDescription."</p>";
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
    $softdelete = false;
    for($i = 0; $i< count($_GLOBALS['TVCodes']); $i++){
        if(($_GLOBALS['TVCodes'][$i]) == ($_SESSION['vehicle']['vCode'])){
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
        <p>Vehicle successfully discontinued</p>
        
        <a href = 'deleteVehicle.php'>Delete another</a>
        <?php
    }
    else{
        deleteVehicle($pdo, $_SESSION['vehicle']);
        session_destroy();
        ?>
        <script defer>
            hideButton();
        </script>
        <p>Vehicle successfully deleted</p>
        
        <a href = 'deleteVehicle.php'>Delete another</a>
        <?php
    }
}
?>
</div>
<?php
$pdo = null;
include "inc/footer.inc.php";
?>