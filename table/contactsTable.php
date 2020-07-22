<?php
echo "
<tr>
    <td><a href='index.php?sect=contact&id=".$value['id']."'>".$value['surname']."</a></td>
    <td><a href='index.php?sect=contact&id=".$value['id']."'>".$value['name']."</a></td>
    <!--<td><a href='index.php?sect=contact&id=".$value['id']."'>".$value['middleName']."</a></td>-->
    <td><a href='index.php?sect=contact&id=".$value['id']."'>".$value['job']."</a></td>
    <td>".$value['tel1']."</td>
    <td>".$value['mailing']."</td>
   </tr>";
 ?>
