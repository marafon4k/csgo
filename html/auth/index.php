<?php

try {
	$db = new PDO('mysql:host=localhost;dbname=csgolobbyrur', 'root', ' ', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch (PDOException $e) {
	exit($e->getMessage());
}

if (isset($_COOKIE['hash'])) {
	$sql = $db->query("SELECT * FROM `users` WHERE `hash` = " . $db->quote($_COOKIE['hash']));
	if ($sql->rowCount() != 0) {
		$row = $sql->fetch();
		$user = $row;
	}
}

switch ($_GET['page']) {
	case '':
		include 'openid.php';
		try
		{
			$openid = new LightOpenID('http://'.$_SERVER['SERVER_NAME'].'/');
			if (!$openid->mode) {
				$openid->identity = 'http://steamcommunity.com/openid/?l=english';
				header('Location: ' . str_replace("cseuro", "cseuro", $openid->authUrl()));
			} elseif ($openid->mode == 'cancel') {
				echo '';
			} else {
				if ($openid->validate()) {

					$id = $openid->identity;
					$ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
					preg_match($ptn, $id, $matches);

					$url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key= &steamids=$matches[1]";
					$json_object = file_get_contents($url);
					$json_decoded = json_decode($json_object);
					foreach ($json_decoded->response->players as $player) {
						$name_vip = strtolower($player->personaname);
						if (strpos($name_vip, strtolower('cseuro')) != false){
							$vip = '1';
						} else {
							$vip = '0';	   
						} 
						$rep = str_replace("script", "", $player->personaname);
						$steamid = $player->steamid;
						$name = $rep;
						$name = str_replace("script", "*", $name);
						$name = str_replace("/", "*", $name);
						$name = str_replace("<", "*", $name);
						$name = str_replace(">", "*", $name);
						$name = str_replace("body", "*", $name);
						$name = str_replace("onload", "*", $name);
						$name = str_replace("alert", "*", $name);
						$name = str_replace(")", "*", $name);
						$name = str_replace("(", "*", $name);
						$name = str_replace("'", "*", $name);
						$name = str_replace(".ru", "*", $name);
						$name = str_replace(".RU", "*", $name);
						$name = str_replace(".com", "*", $name);
						$name = str_replace(".COM", "*", $name);
						$site = $vip;
						$avatar = $player->avatar;
						$country = $player->loccountrycode;
					}

					$hash = md5($steamid . time() . rand(1, 50));
					$sql = $db->query("SELECT * FROM `users` WHERE `steamid` = '" . $steamid . "'");
					$row = $sql->fetchAll(PDO::FETCH_ASSOC);
					if (count($row) == 0) {
						$name = str_replace("script", "*", $name);
						$name = str_replace("/", "*", $name);
						$name = str_replace("<", "*", $name);
						$name = str_replace(">", "*", $name);
						$name = str_replace("body", "*", $name);
						$name = str_replace("onload", "*", $name);
						$name = str_replace("alert", "*", $name);
						$name = str_replace(")", "*", $name);
						$name = str_replace("(", "*", $name);
						$name = str_replace("'", "*", $name);
						$name = str_replace(".ru", "*", $name);
						$name = str_replace(".RU", "*", $name);
						$name = str_replace(".com", "*", $name);
						$name = str_replace(".COM", "*", $name);
						
						$db->exec("INSERT INTO `users` (`hash`, `steamid`, `name`, `avatar`, `site`, `country`) VALUES ('" . $hash . "', '" . $steamid . "', " . $db->quote($name) . ", '" . $avatar . "', '" . $site . "', '" . $country ."')");
					} else {
						$db->exec("UPDATE `users` SET `hash` = '" . $hash . "', `name` = " . $db->quote($name) . ", `country` = '" . $country . "', `avatar` = '" . $avatar . "', `site` = " . $site . " WHERE `steamid` = '" . $steamid . "'");
					}
					setcookie('hash', $hash, time() + 3600 * 24 * 7, '/');
					header('Location: http://cseuro.com/sets.php?id=' . $hash);
				}
			}
		} catch (ErrorException $e) {
			exit($e->getMessage());
		}
		break;
}

function curl($url) {
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
	curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 

	$data = curl_exec($ch);
	curl_close($ch);

	return $data;
}