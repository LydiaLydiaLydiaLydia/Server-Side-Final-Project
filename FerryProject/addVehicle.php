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

$val_desc;
$val_code;
$val_pric;
$val_unit;

$valid = false;
if(isset($_POST['vdescription'])){
    $val_desc = $_POST['vdescription'];
    $val_code = strtoupper($_POST['vcode']);
    $val_pric = $_POST['price'];
    $val_unit = $_POST['units'];
    
    for($i = 0; $i < count($vCodes); $i++){
        if($vCodes[$i] === $val_code){
            echo "<p id = 'alert' >2 Character Identifying Code already exists in database. Please choose another!</p>";
            $valid = false;
            break;
        }
        else{
            $valid = true;
        }
    }
    if($valid == true){
        $_SESSION['forVehicle']['vCode'] = $val_code;
        $_SESSION['forVehicle']['vDescription'] = $val_desc;
        $_SESSION['forVehicle']['price'] = $val_pric;
        $_SESSION['forVehicle']['units'] = $val_unit;

        insertVehicle($pdo);
        echo "<p id = 'alert'>Vehicle has been inserted into the database successfully!</p>";
        $pdo = null;
    }
}
else{
    $val_desc = "";
    $val_code = "";
    $val_pric = '';
    $val_unit = '';
}
?>
<form action = "addVehicle.php" method = "post" id = "form">
    <label>Vehicle Description: </label><br>
    <input type = "text" name = "vdescription" id = "vdescription" required minlength = "1" maxlength = "25" value = "<?php echo $val_desc; ?>">
    <br><br>
    <label>2 Character Identifying Code: (e.g., CR, VN)</label><br>
    <input type = "text" name = "vcode" id = "vcode" minlength = "2" maxlength = "2" pattern = "[a-zA-Z]{2}" required value = "<?php echo $val_code; ?>">
    <br><br>
    <label>Price: </label><br>
    <input type = "text" name = "price" id = "price" pattern = "\d+\.?\d*" maxlength = "5" required value = "<?php echo $val_pric; ?>">
    <br><br>
    <label>Unit Size: (where one unit is the size of a standard carpark space)</label><br>
    <input type = "number" name = "units" id = "units" max = "3"   value = "<?php echo $val_unit; ?>" required>
    <br><br><br>
    <input type = "submit" value = "Add" id = "submit">
</form>
<?php
include "inc/footer.inc.php";
?>