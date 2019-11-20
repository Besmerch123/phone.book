<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . "library.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "header.php";





$page = 'home';


if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = $_GET['page'];
}
$template = __DIR__ . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $page . '.php';
if (file_exists($template))
    require_once $template;
else
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . '404.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . "footer.php";
?>
