function updateTradeLink() 
{
	var steamid = $("#steamid").val();
	var link = $("#link").val();
	$.ajax(
	{
		url: 'updateTradeLink.php', 
		type: 'POST', 
		data: '&steamid=' + steamid + '&link=' + link, 
		dataType: 'text', 
		success: function (data) 
		{
			document.getElementById('tlink_alert').innerHTML = data;
			$("#tlink_alert").fadeIn();
		}
	});
}