<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">	
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="blurt.min.css">
		<script src="blurt.min.js"></script>
		<script>
			$(document).ready(function(){
			$("button").click(function( ){
				var file_text;
				file_text = $( "#y1f_1" ).text( );
				$.post( "val.php", {file_data : file_text} , function( data ){
					blurt('Successfully saved');
				});
			});
			});
			document.onreadystatechange = function () {
			  var state = document.readyState
			  if (state == 'interactive') {
				   document.getElementById('contents').style.visibility="hidden";
			  } else if (state == 'complete') {
				  setTimeout(function(){
					 document.getElementById('interactive');
					 document.getElementById('load').style.visibility="hidden";
					 document.getElementById('contents').style.visibility="visible";
				  },1000);
			  }
			}
		</script>
	</head>
	<style>
		body {background-color: #262626;}
		
		}
		table, th, td {
			border: 1px solid black;
			border-collapse:collapse; 
			width: 100px

		}
		th {
			height: 20px;
		}
		.uploads{
		    margin: auto;
		    margin-top:5%;
			width: 60%;
		    height: 400px;
			border: 3px solid gray;
			border-radius: 18px;
			padding: 75px;
			text-align: center;
			background: #f2f2f2;
		    padding: 75px;
		    box-shadow: 1px 1px 1px 1px #888888;
		}  
		.skewedBox{
			background: #708090;
			padding: 80px 0;
		}
		.button {
			background-color: #008CBA;
			border: none;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
		}
		#load{
			width:100%;
			height:100%;
			position:fixed;
			z-index:9999;
			background:url("https://www.creditmutuel.fr/cmne/fr/banques/webservices/nswr/images/loading.gif") no-repeat center center rgba(0,0,0,0.25)
		}
	</style>
	<body>
		<div id="load"></div>
		<div id="contents">
		<section class="skewedBox">
			<div class="container">
			</div>
		</section>
		<div class="uploads">
		<div class="table-responsive">    
		  <?php
			// Create a table from a csv file 
			session_start();
			echo "<table class='table' >\n\n";
			$row = 1;
			$form_type = $_GET['radioVal'];
			$_SESSION['form_type'] = $form_type;
			$path_pwd = dirname(__DIR__);
			$path_temp_value = $path_pwd.'/temp/value.csv';
			$path_config_file = $path_pwd.'/config/'.$form_type.'.csv';
			if (($handle = fopen($path_config_file, "r")) !== FALSE) {
				 echo "<tr>";
				 $data = fgetcsv($handle, 5000, "~");
				 while (($data = fgetcsv($handle, 1000, "~")) !== FALSE) { 
				    echo "<th>" . ' ' . $data[0] . "</th>" ;
				}
				 echo "</tr>";
				 fclose($handle);
			}
			$f = fopen($path_temp_value, "r");
			while (($line = fgetcsv($f)) !== false) {
					$row = $line[0];    // We need to get the actual row (it is the first element in a 1-element array)
					$cells = explode("~",$row);
					echo "<tr id='y1f_1'>";
					foreach ($cells as $cell) {
						echo "<td contenteditable='true'>" . htmlspecialchars($cell). "\t"  . "</td>";
					}
					echo "</tr>\n";
			}
			fclose($f);
			echo "\n</table>";
		  ?>
		  </div>
		  </br><button onclick="location.href='csvcon.php'";>
		     <span title="save" class="glyphicon glyphicon-save">SAVE</span>
		  </button>
		  <button onclick="location.href='form.php';" >
		     <span title="cancel">CANCEL</span>
		  </button>
		</div>
		</div>
	</body>
</html>