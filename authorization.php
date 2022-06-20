<?php 

    function authorizationCheck($page, $session){

        if(count($session) == 0){
            header("Location: http://localhost/ship-block");
            exit;
        }
        $role = $session['role'];
        $page_name_split = explode("-", $page);
        $role_split = explode(" ", $role);
        
        if(count($page_name_split) == 3){
            $page_name = $page_name_split[0]. " & ".$page_name_split[1];
        } else{
        
            $page_name = $page_name_split[0];
            $role_to_page = $role_split[0]."-admin";

        }

        if(count($role_split) == 3){
            $role_to_page = $role_split[0]."-".$role_split[2]."-admin";
        } else{
            $role_to_page = $role_split[0]."-admin";
        }
        if($page_name != $role){
            $redirect_back = "Location: http://localhost/ship-block/".$role_to_page;
            header($redirect_back);
            exit;
        }
    }
    

?>