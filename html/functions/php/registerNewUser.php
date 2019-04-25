<?php

	function registerNewUser($steamid)
	{
		include 'settings.php';

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) 
		{
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT id FROM users WHERE steamid='".$steamid."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			// user already in db
			if($showdebugmessages==1)
			{
				echo 'user already in database';
			}
		}
		else 
		{
			// user not found
			$ip = $_SERVER['REMOTE_ADDR'];

			$link = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='.$api_key.'&steamids='.$steamid.'&format=json');
			$link_decoded = json_decode($link, true);

			$nickname = $link_decoded['response']['players'][0]['personaname'];
			$avatar = $link_decoded['response']['players'][0]['avatarfull'];

			$sql = "INSERT INTO users (steamid, ip, balance, avatar, nickname, won, played, hasRedeemedCode, refEarningsTotal, refEarningsAvailable) VALUES ('".$steamid."', '".$ip."', '0', '".$avatar."', '".$nickname."', '0', '0', '0', '0', '0')";

			if ($conn->query($sql) === TRUE) 
			{
				if($showdebugmessages==1)
				{
					echo 'user with steamid '.$steamid.' added succesfully';
				}
			} 
			else 
			{
				if($showdebugmessages==1)
				{
					echo 'error while adding user with id '.$steamid.': '.$conn->error.'<br>sql: '.$sql;
				}
			}
		}

		$conn->close();
	}

?>