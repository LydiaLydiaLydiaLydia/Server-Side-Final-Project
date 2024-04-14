<?php
$pg_title = "Purchase Ticket | FerrySYS";
include "inc/header.inc.php";

//loading in values for the date picker
date_default_timezone_set("GMT");
if(isset($_POST["usrDate"])){
    $dispDate = date("Y-m-d", strtotime($_POST["usrDate"]));
}else{
    $dispDate = date("Y-m-d");
}

$vehicles = array();
$ports = array();
$departures = array();

//loading in values for the vehicle type picker
include 'inc/selectAll.inc.php';
$allVs = ferrySelect('vehicletypes');
$i = 0;
while($row=$allVs->fetch()){
    //so the arrays should look like 
    //vehicles[Car[], Coach[]...etc]
    //Car[]
    $vehicles[$row['VDescription']] = array();
    $vehicles[$row['VDescription']]['vCode'] = $row['VCode'];
    $vehicles[$row['VDescription']]['price'] = $row['Price'];
    $vehicles[$row['VDescription']]['units'] = $row['Units'];
    $i++;
}

//loading in the ports from database into array
$allPts = ferrySelect('Ports');
$i = 0;
while($row=$allPts->fetch()){
    $ports[$row['PCode']] = $row['PName'];
}

$pName;
$pCode;
$vType;
$arrPort;

$_SESSION['forTicket'] = array(
    'tCode' => 0,
    'tDate' => "",
    'tTime' => "",
    'vCode' => "",
    'salePrice' => 0,
    'depID' => 0
);
?>
<form action = "Ticket.php" method = "post">
    <label>Pick a Date of Travel</label>
    <input type = "date" name = "usrDate" value = "<?php echo $dispDate; ?>" min = "2024-04-29" max = "2024-05-05"/>
    <br>
    <label>How will you be travelling?</label>
    <select id = "vehicleType" name = "vehicleType">
    <?php
        foreach($vehicles as $key => $value){
    ?>

        <option value = "<?php echo $key; ?>">
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

    <option value = "<?php echo $key; ?>">
    <?php echo $value; ?>
    </option>

    <?php
        }
    ?>
    <input type = "submit" value = "Show Available Departures">
</form>
<?php
if(isset($_POST["usrDate"])){
    $depDate = $_POST["usrDate"];
    $pCode = $_POST["depPort"];
    $vType = $_POST['vehicleType'];
    $vUnit = $vehicles[$vType]['units'];
    $availTimes = selectDepartures($depDate, $pCode);
    foreach($ports as $key => $value){
        if($key != $pCode){
            $arrPort = $value;
        }
    }
    include "timetable.php";
    $_SESSION['forTicket'] = array(
        'tCode' => 0,
        'tDate' => $depDate,
        'tTime' => "",
        'vCode' => $vehicles[$vType]['vCode'],
        'salePrice' => $vehicles[$vType]['price'],
        'depID' => 0
    );
?>
<script>
    makeButtonsWork();
</script>
<div id = "ticketDetails">
    <form action = 'purchaseTicket.php' method = 'post'>
        <p>Date of Departure:</p>
        <p><?php echo $depDate; ?></p>
        <br>
        <p>Time of Departure:</p>
        <p id = "time"></p> 
        <p>Vehicle Type:</p>
        <p id = "vehicle"><?php echo $vType; ?></p>
        <p>Ticket Price:</p>
        <p><?php echo $vehicles[$vType]['price']; ?></p>
        <input type = 'text' name = 'departureTime' id = 'departureTime' value = "">
        <input type = 'submit' value = "Confirm Ticket Details">
    </form>
</div>
<?php
}
include "inc/footer.inc.php";
?>