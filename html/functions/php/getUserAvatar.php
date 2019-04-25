<?php

	function getUserAvatar($steamid)
	{
		include 'settings.php';

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) 
		{
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT avatar FROM users WHERE steamid='".$steamid."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc())
			{
				echo $row['avatar'];
			}
		} 
		else 
		{
			echo 'error';
		}

		$conn->close();
	}

?>