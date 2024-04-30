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
?>

<form action = "addVehicle.php" method = "post" id = "form">
    <label>Vehicle Description: </label><br>
    <input type = "text" name = "vdescription" id = "vdescription" required minlength = "1" maxlength = "25" value = "<?php echo $val_desc; ?>" class = "able">
    <br><br>
    <label>2 Character Identifying Code: (e.g., CR, VN)</label><br>
    <input type = "text" name = "vcode" id = "vcode" minlength = "2" maxlength = "2" pattern = "[a-zA-Z]{2}" required value = "<?php echo $val_code; ?>" class = "able">
    <br><br>
    <label>Price: </label><br>
    <input type = "text" name = "price" id = "price" pattern = "\d+\.?\d*" maxlength = "5" required value = "<?php echo $val_pric; ?>" class = "able">
    <br><br>
    <label>Unit Size: (where one unit is the size of a standard carpark space)</label><br>
    <input type = "number" name = "units" id = "units" max = "3"   value = "<?php echo $val_unit; ?>" required class = "able">
    <br><br><br>
    <input type = "submit" value = "Add" id = "submit" class = "able">
</form>

<?php
include "inc/footer.inc.php";
?>