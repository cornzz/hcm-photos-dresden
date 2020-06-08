<?php
 
$key = "XXX"; 
$sharexdir = "../u/"; 

if (isset($_GET['k'])) {
    if ($_GET['k'] == $key) {
        if (isset($_GET['delete']) && $_GET['delete'] != "" && $_GET['delete'] != "." && $_GET['delete'] != "./" && $_GET['delete'] != ".." && $_GET['delete'] != "../") {
            if (file_exists($sharexdir.$_GET['delete'])) {
                    delete_files($sharexdir.$_GET['delete']);
                    echo 'Your uploaded file "';
                    echo $sharexdir.$_GET['delete'];
                    echo '" has been deleted.';
                    echo "<script>window.close();</script>";
                    die();
                } else {
                    echo 'The file "';
                    echo $sharexdir.$_GET['delete'];
                    echo '" does not exist.';
                    
            }
        } else {
            echo 'No file specified.';
        }
    } else {
        echo 'Invalid key.';
    }
} else {
    echo 'Key not set.';
}

function delete_files($target) {
    if(is_dir($target)){
        array_map('unlink', glob($target . "/*"));
        rmdir($target);
    } elseif(is_file($target)) {
        unlink( $target );  
    }
}


?>