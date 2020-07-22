<?php
echo "
<tr>
    <td><a href='index.php?sect=account&id=".$value['id']."'>".$value['code']."</a></td>
    <td><a href='index.php?sect=account&id=".$value['id']."'>".$value['name']."</a></td>
    <td><a href='".$value['www']."'target='_blank'>".$value['www']."</a></td>
    <td>".$value['tel1']."</td>
    <td>".$value['email1']."</td>
   </tr>";
 ?>
<!-- <td><a href='index.php?sect=account&id=".$value['id']."'>".$value['id']."</a></td> -->
