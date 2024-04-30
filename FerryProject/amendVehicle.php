<?php
session_start();
$pg_title = "Admin Dashboard | FerrySYS";
$pg_script = "scripts/validateV.js";
include "inc/header.inc.php";
include "inc/databaseFuncs.inc.php";
?>
<div id = "content">
<?php
$pdo = connect();

if(!isset($_POST['vehicleType'])){
    $_SESSION['vehicles'] = getVehicles($pdo);
}
?>
<form method = 'post' action = 'amendVehicle.php'>
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
    <input type = "submit" value = "See Details" id = 'codeSubmit'>
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
    $val_desc = $VDescription;
    $val_pric = $_SESSION['vehicle']['price'];
    $val_unit = $_SESSION['vehicle']['units'];
    ?>
<form action = "amendVehicle.php" method = "post" id = "form">
    <label>Vehicle Description: </label><br>
    <input type = "text" name = "vdescription" id = "vdescription" required minlength = "1" maxlength = "25" value = "<?php echo $val_desc; ?>">
    <br><br>
    <label>Price: </label><br>
    <input type = "text" name = "price" id = "price" pattern = "\d+\.?\d*" maxlength = "5" required value = "<?php echo $val_pric; ?>">
    <br><br>
    <label>Unit Size: (where one unit is the size of a standard carpark space)</label><br>
    <input type = "number" name = "units" id = "units" max = "3"   value = "<?php echo $val_unit; ?>" required>
    <br><br><br>
    <input type = "submit" value = "Add" id = "submit" name = "amended">
</form>

<?php
}
?>

<?php
include "inc/footer.inc.php";
?>