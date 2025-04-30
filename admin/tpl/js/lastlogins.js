function GetHost(spot, ip)
{
	var url = 'gethost.php?ip=' + ip;
	

	$(spot).html('<img src="tpl/img/loading3.gif" />');

	$.get(url,{},function(response)
	{
			$(spot).html(response);
	});             
}
