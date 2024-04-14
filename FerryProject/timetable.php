<table>
    <tr>
        <th>Departs from <?php echo $ports[$pCode]; ?></th>
        <th>Arrives at <?php echo $arrPort; ?></th>
        <th>Available</th>
    </tr>
<?php
    $counter = 0;
    while($row = $availTimes->fetch()){
        $departures[$row['DepTime']] = $row['DepID'];
?>
    <tr <?php if(($counter % 2) == 0){ echo 'class = "oddTr"'; }?>>
        <td class = "depTime">
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
        <td><button class = "chooseTick" id = "<?php echo $counter; ?>">Book Ticket</button></td>
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