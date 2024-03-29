<?php
    include 'myHeader.php';
    include 'inc/select.inc.php';
    $title = 'Timetable | FerrySYS';

?>
<table>
        <tr>
            <th>Departure Port</th>
            <th>Departure Time</th>
            <th>Arrival Time</th>
            <th>Tickets Available</th>
        </tr>
    
<?php

    try{
        /*
       
        */
        $result = departureSelect();

        while($row = $result->fetch()){
            $depPort = $row["DepPort"];
            $deptime = $row["DepTime"];
            $arrTime = $row["ArrTime"];
            $capacity = $row["Capacity"];

            ?>
            <tr>
                <td><?php echo $depPort; ?></td>
                <td><?php echo $deptime; ?></td>
                <td><?php echo $arrTime; ?></td>
            <?php
            if($capacity > 0){
            ?>
                <td>Yes</td>
            </tr>
            <?php
            }
            else{
            ?>
                <td>No</td>
            </tr>
            <?php
            }
        }
        ?>
        </table>
        <?php
    }
    catch (PDOException $e){
        $output = 'Uanble to connect to the database server: '. $e->getMessage() . ' in '. $e->getLine();
    }

    include 'myFooter.html';
?>