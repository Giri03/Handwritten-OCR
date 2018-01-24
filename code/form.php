<!DOCTYPE html>
<html lang="en">
 <head>
   <title>OCR13</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <style>
	.mainDiv{
	  position: relative;
	  width: 1200px;
	  height: 100px;
	  margin: 0px auto;
	  margin-top:-25px;
	}
	.square{
	  width:100px;
	  height:100px;
	  background:#708090;
	  border:solid 2px #708090;
	  float:left;
	  transform: skew(180deg,210deg);
	  position: absolute;
	  top: 43px;
	  box-shadow: 0px 0px 50px #C0C0C0;
	}
	.square2{
	  width:100px;
	  height:100px;
	  opacity: 0.5;
	  background:#708090;
	  border:solid 2px #708090;
	  float:left;
	  transform: skew(180deg,150deg);
	  position: absolute;
	  left:102px;
	  top: 43px;
	  box-shadow: 0px 0px 50px #C0C0C0;
	}
	.square3{
	  width:114px;
	  height:100px;
	  background:#708090;
	  border:solid 2px #708090;
	  float:right;
	  box-shadow: 0px 0px 50px #C0C0C0;
	  transform: rotate(150deg) translate(-40px, -16px) skew(30deg, 0deg);
	  position: absolute;
	  left: 0px;
	  top: -32px;
	}
	body{
	  margin: 0;
	  padding: 0;
	  background: #262626;
	}
	.skewedBox{
	  background: #708090;
	  padding: 80px 0;
	  transform: skew(0deg, -150deg) translate(-10px);
	}
	h1{
	  color:#696969; 
	  opacity: 1;
	}
	h2{
	  color:#696969; 
	  opacity: 1;
	}
	.uploads{
      margin: auto;
      margin-top: -5%;
	    width: 30%;
      height: 300px;
      border: 0px darkslategrey;
      border-radius: 10px;
      padding: 15px;
      text-align: center;
      background: #D3D3D3;
      opacity: 1;
      padding: 40px;
      box-shadow: 8px 8px 8px 8px #C0C0C0;
  } 
  #file{
      display: none;
	}
  .button{
    padding: 10px;
    text-align: center;   
    transition-duration: 0.4s;
    cursor: pointer;
    background-color: white;
    color: black;
    border: 2px solid #555555;
    border-radius: 50px;
    margin-top: 30px;
	}
  .button:hover{
    background-color: #262626;
    color: white;
	}
  #box1{
    width: 30%;
    height: 30px;
    padding: 60px 0;
    text-align: center;
    padding-top:10px;
	  margin-right:-10px;
    margin-bottom:40px;
  }
  .submit{
    margin-right:-10px;
    margin-top:20px;
    border-radius: 50px;
	}
  ::-webkit-file-upload-button{
	  background: #0073e6;
	  color: white;
	  padding: 0.5em;
	}

 </style>
 <body>
	<section class="skewedBox">
	  <div class="container">
	  </div>
	</section>
	<section class="skewedBox2">
	  <div class="container">
	    <h1>OCR</h1>
			<h2>We Made It Happen</h2>
	  </div>
	</section>
	<div class="uploads">
		<form action = "chdir.php" method="post" enctype="multipart/form-data">
			<input type="file" name="uploadedfile" >
			<div id="box1">
				<h4><span title="Category">CATEGORY</span></h4>
				<?php
					$path_pwd= dirname(__DIR__);
					$dir = $path_pwd ."//input";
					// Sort in ascending order - this is default
					$a = scandir($dir);
					$files = array_slice($a, 2);
					$arrayKeys = array_keys($files);
						for ($i=0; $i<count($files); $i++) {
						echo "<input type=radio name=value value='". $files[$arrayKeys[$i]] ."'>"; 
						echo $files[$arrayKeys[$i]]."<br>";  
					}
				?>
	  	</div>
			<br>
      <div class='submit'>
        <button type="submit" accesskey="S" name="submit"class="btn btn-primary"><i class="fa fa-spinner" aria-hidden="true"></i>
		   		<span title="submit">SUBMIT</span>
		 		</button>
      </div>
    </form>      
	</div>
	<div class="mainDiv">
	   <div class="square"></div>
	   <div class="square2"></div>
	   <div class="square3"></div>
  </div>
 </body>
</html>