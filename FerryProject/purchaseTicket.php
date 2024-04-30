<?php 
session_start();
    $pg_title = "Confirm Purchase";
    include "inc/header.inc.php";
    include "inc/databaseFuncs.inc.php";

    $_SESSION['forTicket']['depID'] = $_SESSION['departures'][substr($_POST['departureTime'], 0, 5)];

    $pdo = connect();
    $ticketID = insertTicket($pdo, $_SESSION['forTicket']['tDate'],$_SESSION['forTicket']['tTime'], $_SESSION['forTicket']['vCode'], $_SESSION['forTicket']['salePrice'], $_SESSION['forTicket']['depID'], $_SESSION['forTicket']['vUnit']);
    $pdo = null;
 ?>
 <div id = "content">
 <h1>Thank you for your purchase</h1>
<h2>Your ticket/booking number is <?php echo $ticketID; ?></h2>
<a href = 'Ticket.php'>Book another ticket</a>
 <?php  
    session_destroy();
    include "inc/footer.inc.php";
?>  