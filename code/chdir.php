<?php ini_set('max_execution_time', 0); 
    $radioVal = $_POST['value'];

    if(isset($_POST['submit']))
    { 
        #all attributes related to current file
        $file = $_FILES['uploadedfile']; 
        $file_name = $_FILES['uploadedfile']['name'];
        $temp_name = $_FILES['uploadedfile']['tmp_name'];
        $error = $_FILES['uploadedfile']['error'];
        $size= $_FILES['uploadedfile']['size'];
        $type = $_FILES['uploadedfile']['type'];

        $file_ext = explode('.',$file_name);
        $file_actual_ext = strtolower(end($file_ext));# take the second(end) of file name
        #which files to allow
        $allowed = array('jpg','jpeg','png','tif','tiff');
        $path_pwd = dirname(__DIR__);
        if(in_array($file_actual_ext,$allowed)) 
        {
            if($error === 0)
            {
                $file_new_name =  $radioVal.'_'.$file_name;

                $fileDestination  = $path_pwd .'//input//'.$radioVal.'//'.$file_new_name;
                move_uploaded_file($temp_name,$fileDestination);    

                exec("python main.py $radioVal $file_new_name");
                
                header("location: edit.php?radioVal=".$radioVal); 

            }
            else
            {
                echo "There is an error in your file!";
            }
        }
        else
        {
            echo "You can upload only image files!";
        }
    }
    else
    {
        echo "error";
    }
?>  