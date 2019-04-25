<?php

	function getUserSteamAvatar($steamid)
	{
		include 'settings.php';

		$link = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='.$api_key.'&steamids='.$steamid.'&format=json');
		$link_decoded = json_decode($link, true);

		echo $link_decoded['response']['players'][0]['avatarfull'];
	}

?>