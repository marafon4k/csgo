<?php

	function makeAdmin($steamid)
	{
		include 'settings.php';

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) 
		{
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "UPDATE users SET admin='1', ban='0' WHERE steamid='".$steamid."'";

		if ($conn->query($sql) === TRUE) 
		{
			if($showdebugmessages==1)
			{
				echo 'main admin rank updated';
			}
		} 
		else 
		{
			if($showdebugmessages==1)
			{
				echo "Error updating record: " . $conn->error;
			}
		}

		$conn->close();
	}

?>