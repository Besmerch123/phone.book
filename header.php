<!doctype html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Phone book - Brainacad diplom project Bezsmertnyi V.</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?= $server['path'] ?>">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php foreach ($menu as $item):?>
            <li class="nav-item active">
                <a class="nav-link" href="?page=<?=$item?>"><?=$item?> </a>
            </li>
            <?php endforeach;?>
        </ul>
        <?php  if($cookie->read('user')):?>
        <form class="form-inline my-2 my-lg-0" method="post">
            <input class="form-control mr-sm-2" type="hidden" value="logout" name="logout">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
        </form>
        <?php else:;?>
            <ul class="navbar-nav my-2 my-lg-0">
                <a class="nav-link" href="?page=login">Login </a>
            </ul>
        <?php endif;?>
    </div>
</nav>
<div class="container">
<div class="jumbotron">