<?php

	include '../cache/announcements.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Wiz-Page</title>
<style>

body { margin:0; border:0;}
.social { text-decoration: none;  color: #fff;  font:11px/18px Arial, sans-serif;text-shadow:#000000 0px 1px 1px; }

#warrper {
    width: 580px;
    height: 269px;
    background: url(images/bg.jpg);
}

#left {
	float:left;
	width: 175px;
}
#right {
	float:right;
    width: 400px;
	padding-top:25px;
}

html { overflow-y: hidden; }
a { text-decoration: none; color: #7d6a6a; font-family:Arial; font-size:11px; text-shadow:#000000 0px 1px 1px;}
a:hover { text-decoration: none;  color: #fff;  font-family:Arial; font-size:11px; text-shadow:#000000 0px 1px 1px; }


	
#web {
	width:89px;
	height:35px;
	background:url(images/web.jpg);
	margin-bottom:5px;
}

#forum {
	width:89px;
	height:35px;
	background:url(images/forum.jpg);
	margin-bottom:5px;
}

#contact {
	width:89px;
	height:35px;
	background:url(images/contact.jpg);
}

#web:hover {
	width:89px;
	height:35px;
	background:url(images/web2.jpg);	margin-bottom:5px;
}

#forum:hover {
	width:89px;
	height:35px;
	background:url(images/forum2.jpg);	margin-bottom:5px;

}

#contact:hover {
	width:89px;
	height:35px;
	background:url(images/contact2.jpg);
}

ul { maring:0; padding:0; margin-left:10px;}
li { margin:0;  list-style-type:none; }

.date{ font-size:9px; }
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" scrolling="no" border="0">
	<div id="warrper">
		<div id="left">
			<div style="margin-left: 36px;margin-top: 130px;">
				<a href="http://www.lhgenericname01.lc/" target="_blank"><div id="web"></div></a>
				<a href="http://forum.lhgenericname01.lc/" target="_blank"><div id="forum"></div></a>
				<a href="http://www.lhgenericname01.lc/?do=tickets" target="_blank"><div id="contact"></div></a>
			</div>
			
		
		</div>
		<div id="right">
			<ul>
				<?php
					foreach($announcement as $a)
					{
						
						$new = '';
						if(time() - $a['date'] < (60*60*24*7))
							$new = '<img src="images/new.gif" alt="new" border="0" /> ';
						
						echo sprintf('<li><a href="%s" target="_blank"><span class="date">%s</span> &rsaquo; %s%s</a></li>', 
							$a['url'], 
							date('M d', $a['date']),
							$new,
							$a['title']);
					}
				?>
			</ul>
		</div>
		<div style="clear:both;">&nbsp;</div>
	</div>
</body>
</html>