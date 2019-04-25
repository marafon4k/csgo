function updateCode() 
{
	var steamid = $("#steamid").val();
	var code = $("#code333").val();
	$.ajax(
	{
		url: 'updateCode.php', 
		type: 'POST', 
		data: '&steamid=' + steamid + '&code=' + code, 
		dataType: 'text', 
		success: function (data) 
		{
			document.getElementById('afMsg').innerHTML = data;
			$("#afMsg").fadeIn();
		}
	});
}