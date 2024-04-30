
<?php
session_start();
$pg_title = "Admin Dashboard | FerrySYS";
include "inc/header.inc.php";
?>
<div id = "content">
<div id = "adminChoice">
    <div>
        <h1><a href = "addVehicle.php">Add A Vehicle Type</a></h1>
    </div>
    <div>
        <h1><a href = "amendVehicle.php">Amend A Vehicle Type</a></h1>
    </div>
    <div>
        <h1><a href = "deleteVehicle.php">Delete A Vehicle Type</a></h1>
    </div>
</div>

<?php
include "inc/footer.inc.php";
?>