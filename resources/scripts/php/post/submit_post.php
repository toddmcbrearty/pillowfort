<?php 
	ini_set('display_errors', 'On');
	if  (preg_match('/^[A-Za-z0-9 _.,!"?]{5,35}$/', $_POST["title"]))  {
		$posts = $_SERVER['DOCUMENT_ROOT'].'/database/posts.txt';
		$handle = fopen($posts, 'a') ;
		$_POST["textarea"] = str_replace("\r\n", "", $_POST["textarea"]);

		switch ($_POST["link"]) {
			case NULL:
			//htmlspecialchars("<a href='test'>Test</a>", ENT_HTML5);
				fwrite($handle, "\r\n".$_POST["title"]."::".substr(MD5(microtime()), 0, 9)."::".$_POST["textarea"]."::text_area");
				break;
			
			default:
				if($_POST["textarea"] != NULL) {
					echo "You may only submit data for one field";
					break 2;
				}
				fwrite($handle, "\r\n".$_POST["title"]."::".substr(MD5(microtime()), 0, 9)."::".$_POST["link"]."::image_link");//currently only supports images
				break;
		}
		fclose($handle);
		$content = 'success!';
	}

	else
		$content = 'invalid input';

	echo $content;

	exit(); 

?>