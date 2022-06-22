<?php 
    require("connection.php");



    function randomWord($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
    
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
    
        return $randomString;
    }

    

    
    $query_transactions = "SELECT * FROM transactions";

    $get_transactions = mysqli_query($conn, $query_transactions);

    if($get_transactions->num_rows == 0){

        $ciphering = "AES-128-CTR";
        $options = 0;

        $encryption_iv = "andialwanpatiara";

        $encryption_key_none_user = "1c4afd3ef2b67fa640b428265dba46513cbd6ebb";


        for($i = 0; $i <= 149; $i++){
            $len = 20;
            $none_user = new stdClass();
            $none_user->role = "none";
            $none_user->pub = randomWord($len);
            $none_user->prk = randomWord($len);

            $encode_none_user = json_encode($none_user);
            $encrypt_none_user = openssl_encrypt($encode_none_user, $ciphering, $encryption_key_none_user, $options, $encryption_iv);
            
            $query_none_user = "INSERT INTO user (data) VALUES ('$encrypt_none_user')";
            $insert_none_user = mysqli_query($conn, $query_none_user); 
        }
        
        $genesis = new stdClass();
        $genesis->previous = "00000000000000000000000000000000000";
        $genesis->type = "Initial";
        $genesis->timestamp = microtime(true);
        $blockchain[] = $genesis;

        $difficulty = "0000";
        $hash_result = "";

   
        $nonce = -1;
        while(substr($hash_result, 0, 4) !== $difficulty){
            $nonce+=1;
            $last_block = end($blockchain);
            $last_block->nonce = $nonce;
            $data_encode = json_encode($last_block);
            $hash_result = hash("sha256", $data_encode);
        }
        
        $encryption_key = "1a4afd3ef2b67fa640b428265dba46513cbd6ess";
        $encode = json_encode($blockchain);

        // mengenkripsi data hasil genesis blok 
        $encryption = openssl_encrypt($encode, $ciphering, $encryption_key, $options, $encryption_iv);

        for($j = 1; $j <= 150; $j++){
            $query_insert = "INSERT INTO transactions (user_id, transaction) VALUES ($j, '$encryption')";
            $insert_genesis = mysqli_query($conn, $query_insert) or die(mysqli_error($conn));
        }
       
    

        echo "GENESIS BLOCK SUCCESSFULLY FORMED";
        

    } 
    
    else{

        $ciphering = "AES-128-CTR";
        $options = 0;
        $decryption_iv = "andialwanpatiara";
        $decryption_key = "1a4afd3ef2b67fa640b428265dba46513cbd6ess";
        $data = mysqli_fetch_assoc($get_transactions);
        $data = $data["transaction"];
        $decryption = openssl_decrypt($data, $ciphering, $decryption_key, $options, $decryption_iv);
        die($decryption);
        $decode = json_decode($decryption);
        
        // $encode = json_encode($decode[0]);
        // print_r(hash("sha256", $encode));
        // echo "<script>alert(Genesis Block is already exist!);<script>";
    }

?>