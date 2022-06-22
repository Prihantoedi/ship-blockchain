<?php 
    session_start();

    require("connection.php");
    
    
    if(isset($_POST['submit'])){
        
        require("function-center/check-node.php");


        $query = mysqli_query($conn, "SELECT * FROM user");

        $ciphering = "AES-128-CTR";
        $options = 0;
        $decryption_iv = "andialwanpatiara";

        $decryption_key = "1c4afd3ef2b67fa640b428265dba46513cbd6ebb";
        

        $division = strtolower($_POST['division']);
        $rows = [];
        $division_count = 0;
        while($row = mysqli_fetch_assoc($query)){
            
            $scr_data = $row["data"];
            
            $decryption = openssl_decrypt($scr_data, $ciphering, $decryption_key, $options, $decryption_iv);
            $decoding = json_decode($decryption);

            $take_role = strtolower($decoding->role);
            if($take_role === $division){
                $division_count++;
            }

            if($division_count > 0){
                $_SESSION['err'] = "division quota is full, please enter another division";
                header("Location: sign-up.php");
                exit;
            }
        }


        

        // pengecekkan quota divisi
        $micro_time = microtime(true);
        $data = $division.$micro_time;
        
         // cipher method
        $private_key = hash("md2", $data);

        $public_key = "0x".hash("md2", $private_key);
        

        $new_user = new stdClass();
        $new_user->role = $division;
        $new_user->pub = $public_key;
        $new_user->prk  = $private_key;
        
        $encode = json_encode($new_user); 

        $encryption_iv = "andialwanpatiara";
        $encryption_key = "1c4afd3ef2b67fa640b428265dba46513cbd6ebb";

        $encryption = openssl_encrypt($encode, $ciphering, $encryption_key, $options, $decryption_iv);
    
        
        $query_register = "INSERT INTO user (data) VALUES ('$encryption') ";
        $register = mysqli_query($conn, $query_register);

        $last_id = mysqli_insert_id($conn);


        $query_copy_transaction = "INSERT INTO transactions (user_id, transaction) VALUE ($last_id, '$majority')";
        $insert_copy = mysqli_query($conn, $query_copy_transaction);


        $_SESSION['prk'] = $private_key;
        header("Location: pk-info.php");
        exit();

    }
    else{
        die("Nothing");
    }

?>