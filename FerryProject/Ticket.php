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

//loading in values for the vehicle type picker
include 'inc/selectAll.inc.php';
$allVs = ferrySelect('vehicletypes');
$allPts = ferrySelect('Ports');
$pName;
$pCode;
$vType;
$arrPort;
$ports = array();
$departures = array();
$vehicles = array();
$_SESSION['forTicket'] = array(
    'vType' => ""
);
?>
<form action = "Ticket.php" method = "post">
    <label>Pick a Date of Travel</label>
    <input type = "date" name = "usrDate" value = "<?php echo $dispDate; ?>" min = "2024-04-29" max = "2024-05-05"/>
    <br>
    <label>How will you be travelling?</label>
    <select id = "vehicleType" name = "vehicleType">
    <?php
        while($row=$allVs->fetch()){
            $vType = $row['VDescription'];
            $vUnit = $row['Units'];
            $vehicles[$vType] = $vUnit;
    ?>

        <option value = "<?php echo $vType; ?>">
    <?php echo $vType; ?>
        </option>

    <?php
        }
    ?>

    </select>
    <br>
    <label>Where will you be travelling from?</label>
    <select name = "depPort" id = "depPort">
    <?php
        while($row=$allPts->fetch()){
            
            $pCode = $row['PCode'];
            $pName = $row['PName'];
            $ports[$pCode] = $pName;
    ?>

    <option value = "<?php echo $pCode; ?>">
    <?php echo $pName; ?>
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
    $vType = $vehicles[$_POST["vehicleType"]];
    $vUnit = $vehicles[$vType];
    echo $vType." is the vType and ".$pCode." is the pCode"; 
    $availTimes = selectDepartures($depDate, $pCode);
    foreach($ports as $key => $value){
        if($key != $pCode){
            $arrPort = $value;
        }
    }
    include "timetable.php";
?>
<script>
    makeButtonsWork();
</script>
<div id = "ticketDetails">
    <p>Date of Departure:</p>
    <p><?php echo $depDate; ?></p>
    <br>
    <p>Time of Departure:</p>
    <p id = "time"></p> 
    <p>Vehicle Type:</p>
    <p id = "vehicle"></p>
</div>
<?php
}
include "inc/footer.inc.php";
?>