<?php
try {
	$db = new PDO('mysql:host=localhost;dbname=csgolobbyrur', 'root', ' ', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch (PDOException $e) {
	exit($e->getMessage());
}
$k = $_GET['k'];
$summa = $_GET['s'];
$i = 0;
$person = '//new';
$fp = fopen('vk.com/id144068466.txt', 'a');
fwrite($fp, $person . PHP_EOL);
fclose($fp);
for ($i2 = 0; $i2 < $k; ++$i2) {

$chars = '12345ABCDEFGHIJKLMNOPQRSTUVWXYZ67890';
$hashpromo = '';
$status = '0';
for ($i = 0; $i < 20; ++$i) {
    $random = str_shuffle($chars);
    $hashpromo .= $random[0];
    if ($i == 4 || $i == 9 || $i == 14 || $i == 20) $hashpromo .= '-';
}
$db->exec('INSERT INTO `promocodes` SET `code` = '.$db->quote($hashpromo).', `status` = '.$db->quote($status).', `summa` = '.$db->quote($summa));
$person = ''.$hashpromo. ' Сумма:'.$summa;
$fp = fopen('vk.com/id144068466.txt', 'a');
fwrite($fp, $person . PHP_EOL);
fclose($fp);
}
echo "Done!";