<?php


require_once(__DIR__ . DIRECTORY_SEPARATOR . 'Autoload.php');
spl_autoload_register(['Autoload', 'loader']);

$server = parse_url($_SERVER['REQUEST_URI']);

define('PUBLIC_URL', '/' . trim($server['path'], '/') . '/public');

use application\libraries\PdoDriver;
use application\storage\Cookie;

$config = require_once 'config.php';

$pdoDriver = new PdoDriver(
    $config['host'],
    $config['dbname'],
    $config['username'],
    $config['password'],
    $config['port'],
    $config['charset']
);

$menu = ['Phone-book'];
$cookie = new Cookie();

if (isset($_POST['login']) && $_POST['login'] == 'login') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($user = $pdoDriver->login('users', $username, $password)) {
        $cookie->create('user', $user['username']);
        header("Location: ".$server['path']);

    } else {
        $cookie->delete('user');
        $message = "Неправильный логин или пароль";
        header("Location: ".$server['path']."?page=login");

    }

}
if (isset($_POST['logout']) && $_POST['logout'] == 'logout') {
    $cookie->delete('user');
    header("Location: ".$server['path']);

}