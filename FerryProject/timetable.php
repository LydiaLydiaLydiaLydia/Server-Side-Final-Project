<table>
    <tr>
        <th>Port</th>
        <th>Departs</th>
        <th>Arrives</th>
        <th>Available</th>
    </tr>
<?php
    while($row = $availTimes->fetch()){
?>
    <tr>
        <td>
<?php
    echo $pName;
?>
        </td>
        <td>
<?php
    echo $row['DepTime'];
?> 
        </td>
        <td>
<?php
    echo $row['ArrTime'];
?> 
        </td>
<?php
        if($row['Capacity'] >= $vUnit){
?>
        <td>Tickets Available</td>
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
    }
?>
</table>