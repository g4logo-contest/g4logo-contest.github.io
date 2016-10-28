<?php

	if (file_exists('count_file.html')) 
	{
		$fil = fopen('count_file.html', r);
		$dat = fread($fil, filesize('count_file.txt')); 
		echo $dat+1;
		fclose($fil);
		$fil = fopen('count_file.html', w);
		fwrite($fil, $dat+1);
	}

	else
	{
		$fil = fopen('count_file.html', w);
		fwrite($fil, 1);
		echo '1';
		fclose($fil);
	}
?>