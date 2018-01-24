
<?php
	
	session_start();
	$path_pwd = dirname(__DIR__);
	$path_temp_data = $path_pwd."/temp/data.txt";
	$path_temp_file =  $path_pwd."/temp/file.csv";
	$radioVal = $_SESSION['form_type'];
	
	$handle = fopen($path_temp_data, "r");
	$lines = [];
	if (($handle = fopen($path_temp_data, "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 
		1000, "\t")) !== FALSE) {
			$lines[] = $data;
		}
	    fclose($handle);
	}
	
	$fp = fopen($path_temp_file, 'w');
	foreach ($lines as $line) {
		fputcsv($fp, $line);
	}
	fclose($fp);
	
	exec("python check_file.py $radioVal");
	
	echo '<script language="javascript">';
	echo 'alert("message successfully sent")';
	echo '</script>';

	header("location: form.php");
	
?>