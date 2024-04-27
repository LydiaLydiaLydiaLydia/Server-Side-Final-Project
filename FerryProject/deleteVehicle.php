  <?php
session_start();
$pg_title = "Admin Dashboard | FerrySYS";
$pg_script = "scripts/delete.js";
include "inc/header.inc.php";
include "inc/databaseFuncs.inc.php";

//loading in vcodes that exist in tickets, so we don't hard-delete a necessary constraint
$pdo = connect();
$_SESSION['TVCodes'] = getTicketVCodes($pdo);
//loading in VehicleTypes for user selection
$_SESSION['vehicles'] = getVehicles($pdo);
?>
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
    <input type = "submit" value = "See Details">
</form>
<?php
if(isset($_POST['vehicleType'])){
    $VDescription = $_POST['vehicleType'];
    echo "<p>".$VDescription."</p>";
    ?>

<div id = "vDetails">
<form  action = "deleted.php">
    <p><?php echo $VDescription; ?></p>
    <p>Vehicle Code: <?php echo $_SESSION['vehicles'][$VDescription]['vCode']; ?></p>
    <p>Vehicle Price: <?php echo $_SESSION['vehicles'][$VDescription]['price']; ?></p>
    <p>Vehicle Units: <?php echo $_SESSION['vehicles'][$VDescription]['units']; ?></p>
    <input type = 'submit' value = 'confirm delete' id = "submit">
</form>

</div>
<script>
    comboBoxSelected("<?php echo $VDescription; ?>");
    displayDetails();
</script>
    <?php
}
include "inc/footer.inc.php";
?>