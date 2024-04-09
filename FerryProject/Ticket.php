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
?>

<form action = "Ticket.php" method = "post">
    <label>Pick a Date of Travel</label>
    <input type = "date" name = "usrDate" value = "<?php echo $dispDate; ?>" min = "2024-04-29" max = "2024-05-05"/>
    <br>
    <label>How will you be travelling?</label>
    <select name = "vechicleType">
    <?php
        while($row=$allVs->fetch()){
            $vType = $row['VDescription'];
            $vUnit = $row['Units'];
    ?>

    <option value = "<?php echo $vUnit; ?>">
    <?php echo $vType; ?>
    </option>

    <?php
        }
    ?>

    </select>
    <br>
    <label>Where will you be travelling from?</label>
    <select name = "depPort">
    <?php
        while($row=$allPts->fetch()){
            $pCode = $row['PCode'];
            $pName = $row['PName'];
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
    //echo "childe";
    $depDate = $_POST["usrDate"];
    $availTimes = selectDepartures($depDate, $pCode);
    while($row = $availTimes->fetch()){
        echo "<p>egg</p>";
    }
    include "timetable.php";
    
}
include "inc/footer.inc.php";
?>