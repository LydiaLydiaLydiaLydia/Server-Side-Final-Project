<?php 
session_start();
    $pg_title = "Confirm Purchase";
    include "inc/header.inc.php";

    //$_SESSION['forTicket']['depID'] = $_SESSION['departures'][$_POST['departureTime']];
    foreach($_SESSION['departures'] as $key => $value){
        echo $key." has dep id of ".$value."<br>";
    }
    
    echo $_SESSION['departures'][substr($_POST['departureTime'], 0, 5)];

    echo "<BR>";
    echo $_SESSION['forTicket']['tDate'];
    echo "<BR>";
    echo $_SESSION['forTicket']['tTime'];
    echo "<BR>";
    echo $_SESSION['forTicket']['vCode'];
    echo "<BR>";
    echo $_SESSION['forTicket']['salePrice'];
    echo "<BR>";
    echo $_SESSION['forTicket']['depID'];
    
    include "inc/footer.inc.php";
?>  