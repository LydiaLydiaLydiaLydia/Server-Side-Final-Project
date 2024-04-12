<table>
    <tr>
        <th>Departs from <?php echo $ports[$pCode]; ?></th>
        <th>Arrives at <?php echo $arrPort; ?></th>
        <th>Available</th>
    </tr>
<?php
    $counter = 0;
    while($row = $availTimes->fetch()){
?>
    <tr <?php if(($counter % 2) == 0){ echo 'id = "oddTr"'; }?>>
        <td>
<?php
    echo substr($row['DepTime'], 0, 5);
?> 
        </td>
        <td>
<?php
    echo substr($row['ArrTime'], 0, 5);
?> 
        </td>
<?php
        if($row['Capacity'] >= $vUnit){
?>
        <td><button id = "<?php echo 'dep'.$counter; ?>">Book Ticket</button></td>
<?php
        }
        else{
?>
        <td>No Tickets Available</td>
<?php
        }
?>
    </tr>
<?php
    $counter++;
    }
?>
</table>