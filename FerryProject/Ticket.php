<?php
$pg_title = "Purchase Ticket | FerrySYS";
include "inc/header.inc.php";

date_default_timezone_set("GMT");
if(isset($_POST["usrDate"])){
    $dispDate = date("Y-m-d", strtotime($_POST["usrDate"]));
}else{
    $dispDate = date("Y-m-d");
}
?>
<form action = "Ticket.php" method = "post">
    <label>Pick a Date of Travel</label>
    <input type = "date" name = "usrDate" value = "<?php echo $dispDate; ?>">
    <input type = "submit" value = "Show Available Departures">
</form>
<?php
if(isset($_POST["usrDate"])){
    include "timetable.php";
}
include "inc/footer.inc.php";
?>