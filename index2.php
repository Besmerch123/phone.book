<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once(__DIR__ . DIRECTORY_SEPARATOR . 'Autoload.php');
spl_autoload_register(['Autoload', 'loader']);

use application\storage\Cookie;

$cookie = new Cookie();

$cookie->delete('Test');

if ($cookie->read('counter') !== false) {
    $cookie->update('counter', $cookie->read('counter') + 1);
    $message = "Вы посетили наш сайт " . $cookie->read('counter') . " раз";
} else {
    $cookie->create('counter', 1);
    $message = "Вы у нас впервые";
}


if (isset($_POST['date_bithd']) && !empty($_POST['date_bithd'])) {
    $date = $_POST['date_bithd'];

    $today = time();


    $today_day = date('z');
    $bithd_day = date('z', strtotime($date));

    if ($bithd_day > $today_day) {
        $days = $bithd_day - $today_day;
    } else {
        if (date('L')) {
            $daysInYear = 366;
        } else {
            $daysInYear = 365;
        }

        $days = $daysInYear - $today_day + $bithd_day;
    }

    if ($days == 0) {
        $bithd_message = "С Днем Рождения!!!";
    } else {
        $bithd_message = "До вашего дня рождения " . $days . " дней ";
    }

    $cookie->create('bithd_message', $bithd_message);
}


echo $message;

if ($cookie->read('bithd_message') !== false) {
    echo $cookie->read('bithd_message');
} else {
    echo "Укажите дату рождения";
}

?>

<form action="" method="post">
    <input type="date" name="date_bithd" required>

    <button type="submit">Ok</button>
</form>

