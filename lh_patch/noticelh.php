<html>
	<head>
		<title>launcher</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<style type="text/css">
			body { background-image:url(notice.jpg); font-family:verdana; color:white; font-size:10px;}
			a { color:white; text-decoration:none; }
		
		</style>
	</head>
	
	<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="overflow:hidden;">

	<?php
        	include '../cache/news.php';
                        
                foreach($cNews as $news)
		{
			if((time() - $news['date']) < (60*60*24*7))
				echo date('m-d', $news['date']) . ' > <img src="new.gif" /><a href="'.$news['url'].'" target="_blank">'. $news['title'] .'</a><br />';
			else
				echo  date('m-d', $news['date']) . ' > <a href="'.$news['url'].'" target="_blank">'. $news['title'] .'</a><br />';
		}
                        
                        
         ?>
	</body>
</html>