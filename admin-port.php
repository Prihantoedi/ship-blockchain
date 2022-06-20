<?php 
    session_start();
    
    if(!isset($_SESSION['pub']) && !isset($_SESSION['role'])){
        header("Location: sign-in.php");
        exit;
    }


    if($_SESSION['role'] == "engineering"){
        header("Location: engineering-admin");
        exit;
    }

    else if($_SESSION['role'] == "material & logistics"){
        header("Location: material-logistics-admin");
        exit;
    }

    else if($_SESSION['role'] == "purchasing"){
        header("Location: purchasing-admin");
        exit;
    }

    else{
        header("Location: warehouse-admin");
    }

    

?>