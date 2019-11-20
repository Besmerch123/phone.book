<?php

$phones = $pdoDriver->find('phones');

?>


<a href="?page=newPhone" class="btn btn-success">New</a>
<table class="table table-striped">
    <tr> 
    	<th>№</th>       
        <th>name</th>        
        <th>phone</th>
        <th>adres</th>
        <th>action</th>
    </tr>
    <?php
    if (isset($phones) && !empty($phones)) {
        foreach ($phones as $phone) {
            echo "<tr>";
             foreach ($phone as $key => $field){
            		echo "<td>$field</td>";
            	}
            echo "<td>
                    <a href=\"?page=newPhone&id={$phone['id']}\" class=\"btn btn-warning\">Update</a>
                    <a href=\"?page=newPhone&id={$phone['id']}&delete=1\" class=\"btn btn-danger\">Delete</a>
                  </td>";           
            echo "</tr>";
        	}
    } else { ?>
        <tr>
            <td>Table empty!!</td>
        </tr>
    <?php }
    ?>
</table>