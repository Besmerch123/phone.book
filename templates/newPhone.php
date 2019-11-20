<?php

if (isset($_GET['id'])) {
    $phone = $pdoDriver->find('phones', $_GET['id']);
}

if (isset($_POST) && !empty($_POST)) {
    $data = $_POST;
    if (isset($_GET['id'])) {
        $params = [
            'id' => $_GET['id']
        ];
        if ($pdoDriver->update('phones', $data, $params)) {
            echo "<span class='alert-success'>Success Update!!!</span>";
        }
    } else {
        if ($pdoDriver->insert('phones', $data))
            echo "<span class='alert-success'>Success Insert!!!</span>";
    }
}
 
if (!isset($_GET['delete'])) {
    ?>


    <form action="" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= $phone[0]['name'] ?>">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="int" class="form-control" name="phone" id="phone" required
                   value="<?= $phone[0]['phone'] ?>">
        </div>
        <div class="form-group">
            <label for="adres">Adres</label>
            <input type="text" class="form-control" name="adres" id="adres"
                   value="<?= $phone[0]['adres'] ?>">
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
        if ($pdoDriver->delete('phones', $_GET['id'])) {
            echo "<span class='alert-success'>Success Delete!!!</span>";
        }
    }
}
?>
