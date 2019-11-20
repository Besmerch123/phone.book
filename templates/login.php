<?php

?>

<form action="" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
    <input type="hidden" value="login" name="login">
    <button type="submit" class="btn btn-success">OK</button>
    <a href="?page=newUser" class="btn btn-warning">Registrate</a>
</form>

<?php if(isset($message)){
    echo $message;
}?>