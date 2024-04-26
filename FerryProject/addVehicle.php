<?php
session_start();
//a lot of the content of the valdiation of the vehicles comes from the developer.mozilla
// article on Client-Side Form Validation
// link: https://developer.mozilla.org/en-US/docs/Learn/Forms/Form_validation
$pg_title = "Admin Dashboard | FerrySYS";
$pg_script = "scripts/validateV.js";
include "inc/header.inc.php";
include "inc/databaseFuncs.inc.php";

//retrieve vcodes from db 
$pdo = connect();
$vCodes = getVehicleCodes($pdo);

$_SESSION['forVehicle'] = array(
    'vCode' => '',
    'vDescription' => "",
    'price' => 0,
    'units' => 0,
    'vStatus' => 'A'
);
?>
<form action = "addVehicle.php" method = "post" id = "form">
    <label>Vehicle Description: </label><br>
    <input type = "text" name = "vdescription" id = "vdescription" required minlength = "1" maxlength = "25">
    <br><br>
    <label>2 Character Identifying Code: (e.g., CR, VN)</label><br>
    <input type = "text" name = "vcode" id = "vcode" minlength = "2" maxlength = "2" pattern = "[a-zA-Z]{2}" required>
    <br><br>
    <label>Price: </label><br>
    <input type = "text" name = "price" id = "price" pattern = "\d+\.?\d*" maxlength = "5" required>
    <br><br>
    <label>Unit Size: (where one unit is the size of a standard carpark space)</label><br>
    <input type = "number" name = "units" id = "units" max = "3"  required>
    <br><br><br>
    <input type = "submit" value = "Add" id = "submit" required>
</form>
<?php
include "inc/footer.inc.php";
?>