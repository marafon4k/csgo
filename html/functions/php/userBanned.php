<?php

	function userBanned($steamid)
	{
		include 'settings.php';

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) 
		{
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT ban, ban_reason FROM users WHERE steamid='".$steamid."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				if($row['ban']=='1')
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}

		$conn->close();
	}

?>