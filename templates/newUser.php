<?php

if (isset($_GET['id'])) {
    $user = $pdoDriver->find('users', $_GET['id']);
}

if (isset($_POST) && !empty($_POST)) {
    $data = $_POST;
    $data['password'] = md5($data['password']);
    if (isset($_GET['id'])) {
        $params = [
            'id' => $_GET['id']
        ];
        if ($pdoDriver->update('users', $data, $params)) {
            echo "<span class='alert-success'>Success Update!!!</span>";
        }
    } else {
        if ($pdoDriver->insert('users', $data))
            echo "<span class='alert-success'>Success Insert!!!</span>";
    }
}
 
if (!isset($_GET['delete'])) {
    ?>


    <form action="" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= $user[0]['name'] ?>">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" required
                   value="<?= $user[0]['username'] ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" required
                   value="<?= $user[0]['username'] ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= $user[0]['email'] ?>">
        </div>
        <div class="form-group">
            <label for="sex">Sex</label>
            <select name="sex" id="sex" class="form-control">
                <option value="0">Male</option>
                <option value="1">Female</option>
            </select>
        </div>
        <?php
        if ($_GET['id']) {
            echo " <button type=\"submit\" class=\"btn btn-warning\">Update</button>";
        } else {
            echo " <button type=\"submit\" class=\"btn btn-success\">Create</button>";
        }
        ?>
        <button type="reset" class="btn btn-danger">Clear</button>
    </form>
    <?php
} else {
    if (isset($_GET['id'])) {
        if ($pdoDriver->delete('users', $_GET['id'])) {
            echo "<span class='alert-success'>Success Delete!!!</span>";
        }
    }
}
?>
