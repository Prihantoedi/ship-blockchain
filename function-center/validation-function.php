<?php 

    if(isset($_POST['submit-validation'])){

        require("check-node.php");
        $trans_id = $_POST['trans-id'];
        $validation_status = $_POST['trans-validation'];



        $query_select = "SELECT data FROM transit_data WHERE id = $trans_id";
        $select_trans = mysqli_query($conn, $query_select);
        $get_data = mysqli_fetch_assoc($select_trans);


        // dekripsi data
        $data = $get_data["data"];
    
		$ciphering = "AES-128-CTR";
        $options = 0;

        $decryption_iv = "andialwanpatiara";
        $decryption_key = "1a4afd3ef2b67fa640b428265dba46513cbd6ess";

        $encryption_iv = "andialwanpatiara";
        $encryption_key = "1a4afd3ef2b67fa640b428265dba46513cbd6ess";

        $decryption = openssl_decrypt($data, $ciphering, $decryption_key, $options, $decryption_iv);
        // die($decryption);
        $decode = json_decode($decryption);


        $decrypt_majority = openssl_decrypt($majority, $ciphering, $decryption_key, $options, $decryption_iv);
        $decode_majority = json_decode($decrypt_majority);
        
        // take last block
        $last_block = end($decode_majority);

    
        $last_block_encode = json_encode($last_block);
        $timestamp = microtime(true);

        $new_block = new stdClass();
        $new_block->previous = hash("sha256", $last_block_encode);
        $new_block->sender = $decode->sender;
        $new_block->recipient = $decode->recipient;
        $new_block->project_name = $decode->project_name;
        $new_block->project_code = $decode->project_code;
        $new_block->submission_time = $decode->submission_time;
        $new_block->validation_status = $validation_status;
        $new_block->timestamp = $timestamp;

        $nonce = -1;
        $difficulty = "0000";
        $hash_result = "";
        while(substr($hash_result, 0, 4) !== $difficulty){
            $nonce+=1;
            $new_block->nonce = $nonce;
            $new_block_encode = json_encode($new_block);
            $hash_result = hash("sha256", $new_block_encode);
        }

        array_push($decode_majority, $new_block);

        $encode_majority = json_encode($decode_majority);
        $encrypt_majority = openssl_encrypt($encode_majority, $ciphering, $encryption_key, $options, $encryption_iv);

        $query_update_block = "UPDATE transactions SET transaction = '$encrypt_majority'";
        mysqli_query($conn, $query_update_block);

        $query_update_transit_data = "UPDATE transit_data SET notification_status = true, validation_status = '$validation_status' WHERE id = $trans_id";
        mysqli_query($conn, $query_update_transit_data);
        
        if($validation_status == "valid"){
            $_SESSION['complete-validation'] = "Transaction request from Engineering has been successfully validated";
        } else{
            $_SESSION["complete-validation"] = "Transaction request from Engineering has been rejected";
        }
        

       


    }


?>