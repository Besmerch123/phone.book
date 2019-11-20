<?php

$users = $pdoDriver->find('users');

$sex = ['male', 'female']
?>


<a href="?page=newUser" class="btn btn-success">New</a>
<table class="table table-striped">
    <tr>
        <th>Id</th>
        <th>name</th>
        <th>username</th>
        <th>password</th>
        <th>email</th>
        <th>sex</th>
        <th>action</th>
    </tr>
    <?php
    if (isset($users) && !empty($users)) {
        foreach ($users as $user) {
            echo "<tr>";
            foreach ($user as $key => $field) {
                if ($key == 'sex') {
                    echo "<td>{$sex[$field]}</td>";
                } else
                    echo "<td>$field</td>";
            }
            echo "<td>
                    <a href=\"?page=newUser&id={$user['id']}\" class=\"btn btn-warning\">Update</a>
                    <a href=\"?page=newUser&id={$user['id']}&delete=1\" class=\"btn btn-danger\">Delete</a>
                  </td>";
            echo "<td></td>";
            echo "</tr>";
        }
    } else { ?>
        <tr>
            <td>Table empty!!</td>
        </tr>
    <?php }
    ?>
</table>