<?php 
session_start();
    $pg_title = "Confirm Purchase";
    include "inc/header.inc.php";
    include "inc/databaseFuncs.inc.php";

    $_SESSION['forTicket']['depID'] = $_SESSION['departures'][substr($_POST['departureTime'], 0, 5)];

    //echo "<BR>";
    //echo $_SESSION['forTicket']['tDate'];
    //echo "<BR>";
    //echo $_SESSION['forTicket']['tTime'];
    //echo "<BR>";
    //echo $_SESSION['forTicket']['vCode'];
    //echo "<BR>";
    //echo $_SESSION['forTicket']['salePrice'];
    //echo "<BR>";
    //echo $_SESSION['forTicket']['depID'];
    //echo "<BR>";
    //echo $_SESSION['vUnit'];
    //echo "<BR>";
    $pdo = connect();
    $ticketID = insertTicket($pdo, $_SESSION['forTicket']['tDate'],$_SESSION['forTicket']['tTime'], $_SESSION['forTicket']['vCode'], $_SESSION['forTicket']['salePrice'], $_SESSION['forTicket']['depID'], $_SESSION['vUnit']);
 ?>
 <h1>Thank you for your purchase</h1>
<h2>Your ticket/booking number is <?php echo $ticketID; ?></h2>
 <?php  
    include "inc/footer.inc.php";
?>  