<?php 
    if(!isset($_SESSION['admin_role'])){
        header("Location: "."http://localhost/ship-block/sign-in.php");
    }

    else{
        if(strtolower($_SESSION['admin_role']) === "engineering"){
            header("Location: http://localhost/ship-block/engineering-admin/");
            exit;
        }

        else if(strtolower($_SESSION['admin_role']) === "material & logistics"){
            header("Location: http://localhost/ship-block/material-logistics-admin/");
            exit;
        }

        else if(strtolower($_SESSION['admin_role']) === "purchasing"){
            header("Location: http://localhost/ship-block/purchasing-admin/");
            exit;
        }
        else{
            header("Location: http://localhost/ship-block/warehouse-admin/");
            exit;
        }
    }

?>
