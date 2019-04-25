function refreshUserInfo() 
{
	var steamid = $("#steamid").val();
	$.ajax(
	{
		url: 'refreshUserInfo.php', 
		type: 'POST', 
		data: '&steamid=' + steamid + '&link=' + link, 
		dataType: 'text', 
		success: function (data) 
		{
			location.reload();
		}
	});
}