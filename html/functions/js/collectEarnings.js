function collectEarnings() 
{
	var steamid = $("#steamid").val();
	$.ajax(
	{
		url: 'collectEarnings.php', 
		type: 'POST', 
		data: '&steamid=' + steamid, 
		dataType: 'text', 
		success: function (data) 
		{
			document.getElementById('afMsg').innerHTML = data;
			$("#afMsg").fadeIn();
		}
	});
}