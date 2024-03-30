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
?>

<form action = "Ticket.php" method = "post">
    <label>Pick a Date of Travel</label>
    <input type = "date" name = "usrDate" value = "<?php echo $dispDate; ?>">
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
    <input type = "submit" value = "Show Available Departures">
</form>

<?php
if(isset($_POST["usrDate"])){
    $depDate = $_POST["usrDate"];
    include "timetable.php";
}
include "inc/footer.inc.php";
?>