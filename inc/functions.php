<?php

    function alert($msg) 
    {
         echo "<script type='text/javascript'>
            alert('$msg');
            window.location.href='home.php';  
            </script>";
    }

    function alert2($msg) 
    {
         echo "<script type='text/javascript'>
            alert('$msg');
            window.location.href='login.php';  
            </script>";
    }


?>