<?php
session_start();
$pg_title = "Admin Dashboard | FerrySYS";
$pg_script = "scripts/validateAmend.js";
include "inc/header.inc.php";
include "inc/databaseFuncs.inc.php";
?>
<div id = "content">
<?php
if(isset($_POST['amended'])){
    $_SESSION['vehicle']['vDescription'] = $_POST['vdescription'];
    $_SESSION['vehicle']['price'] = $_POST['price'];
    $_SESSION['vehicle']['units'] = $_POST['units'];
    ?>
    <div id = 'alert'>
    <p>Vehicle successfully amended</p>
    <a href = "amendVehicle.php">Amend Another</a>
</div>
    <?php
}
if(!isset($_POST['vehicleType']) && !isset($_POST['amended'])){
    $pdo = connect();
    $_SESSION['vehicles'] = getVehicles($pdo);
    $pdo = null;
}
?>
<form method = 'post' action = 'amendVehicle.php' id = "selectType">
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
if(isset($_POST['vehicleType']) || isset($_POST['amended'])){
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
    $val_desc = $_SESSION['vehicle']['vDescription'];
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
    <input type = "submit" value = "Amend" id = "submit" name = "amended">
</form>
<script>
        comboBoxSelected("<?php echo $_SESSION['vehicle']['vDescription']; ?>");
        activateVButton();
</script>

<?php
}
if(isset($_POST['amended'])){
    ?>
    <script defer>
        hideButton("submit");
        hideButton("codeSubmit");
    </script>
    <?php
    $pdo = connect();
    updateVehicle($pdo, $_SESSION['vehicle']);
    $pdo = null;
    session_destroy();   
}
?>

<?php
include "inc/footer.inc.php";
?>