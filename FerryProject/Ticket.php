<?php
session_start();
$pg_title = "Purchase Ticket | FerrySYS";
$pg_script = "scripts/ticket.js";
include "inc/header.inc.php";

//loading in values for the date picker
date_default_timezone_set("Europe/Dublin");
if(isset($_POST["usrDate"])){
    $dispDate = date("Y-m-d", strtotime($_POST["usrDate"]));
}else{
    $dispDate = date("Y-m-d");
}

$vehicles = array();
$ports = array();
$departures = array();

//loading in values for the vehicle type picker
include 'inc/databaseFuncs.inc.php';
$pdo = connect();
$vehicles = getVehicles($pdo);

//loading in the ports from database into array
$allPts = ferrySelect($pdo, 'Ports');
//$i = 0;
while($row=$allPts->fetch()){
    $ports[$row['PCode']] = $row['PName'];
}
$pdo = null;

$pName;
$pCode;
$vType;
$arrPort;


$_SESSION['forTicket'] = array(
    'tDate' => date('Y-m-d'),
    'tTime' => date('G:i:s'),
    'vCode' => "",
    'salePrice' => 0,
    'depID' => 0,
    'vUnit' => 0
);
?>
<div id = "content">
<form action = "Ticket.php" method = "post">
    <label>Pick a Date of Travel</label>
    <input type = "date" name = "usrDate" value = "<?php echo $dispDate; ?>" min = "<?php echo $dispDate; ?>" max = "2024-05-30"/>
    <br>
    <label>How will you be travelling?</label>
    <select id = "vehicleType" name = "vehicleType">
    <?php
        foreach($vehicles as $key => $value){
    ?>

        <option value = "<?php echo $key; ?>" id  = "<?php echo $key; ?>">
    <?php echo $key; ?>
        </option>

    <?php
        }
    ?>

    </select>
    <br>
    <label>Where will you be travelling from?</label>
    <select name = "depPort" id = "depPort">
    <?php
        foreach($ports as $key => $value){

    ?>

    <option value = "<?php echo $key; ?>" id = "<?php echo $key; ?>">
    <?php echo $value; ?>
    </option>

    <?php
        }
    ?>
    </select>
    <br>
    <br>
    <input id = 'submit' type = "submit" value = "Show Available Departures">
</form>
<?php
if(isset($_POST["usrDate"])){
    $depDate = $_POST["usrDate"];
    $pCode = $_POST["depPort"];
    $vType = $_POST['vehicleType'];
    $vUnit = $vehicles[$vType]['units'];
    $pdo = connect();
    $availTimes = selectDepartures($pdo, $depDate, $pCode);
    foreach($ports as $key => $value){
        if($key != $pCode){
            $arrPort = $value;
        }
    }
    include "inc/timetable.inc.php";
    $_SESSION['forTicket']['vCode'] = $vehicles[$vType]['vCode'];
    $_SESSION['forTicket']['salePrice'] = $vehicles[$vType]['price'];
    $_SESSION['forTicket']['vUnit'] = $vehicles[$vType]['units'];
?>
<script>
    comboBoxSelected("<?php echo $_POST['vehicleType']; ?>");
    comboBoxSelected("<?php echo $_POST['depPort']; ?>");
    makeButtonsWork();
</script>
<div id = "ticketDetails">
    <form action = 'purchaseTicket.php' method = 'post'>
        <p>Date of Departure:</p>
        <p><?php echo $depDate; ?></p>
        <p>Time of Departure:</p>
        <p id = "time"></p> 
        <p>Vehicle Type:</p>
        <p id = "vehicle"><?php echo $vType; ?></p>
        <p>Ticket Price:</p>
        <p><?php echo $vehicles[$vType]['price']; ?></p>
        <input type = 'text' name = 'departureTime' id = 'departureTime' value = "">
        <br>
        <input id = 'submit' type = 'submit' value = "Confirm Ticket Details">
    </form>
</div>
<?php
$_SESSION['departures'] = $departures; 
}
include "inc/footer.inc.php";
?>