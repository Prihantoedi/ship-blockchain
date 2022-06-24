<?php 

    if(isset($_POST['submit-validation'])){

        
        require("check-node.php");
        $trans_id = $_POST['trans-id'];
        $validation_status = ucfirst($_POST['trans-validation']);



        $query_select = "SELECT data FROM transit_data WHERE id = $trans_id";
        $select_trans = mysqli_query($conn, $query_select);
        $get_data = mysqli_fetch_assoc($select_trans);



        // dekripsi data
        $data = $get_data["data"];
        
        $decode = decryption(False, $data);

		
        $decode_majority = decryption(False, $majority);

        
        // take last block
        $last_block = end($decode_majority);

    
        $last_block_encode = json_encode($last_block);
        $timestamp = microtime(true);
        $sender = $decode->sender;
        $new_block = new stdClass();
        $new_block->timestamp = $timestamp;
        if($sender === "material & logistics"){
            $new_block->previous = hash("sha256", $last_block_encode);
            $new_block->sender = $decode->sender;
            $new_block->recipient = $decode->recipient;
            $new_block->project_code = $decode->project_code;
            $new_block->po_no = $decode->po_no;
            $new_block->po_date = $decode->po_date;
            $po_status_ = $validation_status === "Reject" ? "Reject" : $decode->po_status;
            $new_block->po_status = $po_status_;
            $new_block->vendor_name = $decode->vendor_name;
            $new_block->vendor_code = $decode->vendor_code;
            $new_block->vendor_city = $decode->vendor_city;
            $new_block->f_item = $decode->f_item;
            $new_block->item_description = $decode->item_description;
            $new_block->quantity = $decode->quantity;
            $new_block->unit = $decode->unit;
            // $new_block->validation_status = $validation_status;
            
        } 
        // else{ // warehouse

        // }
        // update timestamp transit data

        $decode->timestamp = microtime(true);


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


        $encrypt_majority = encryption(False, $decode_majority);
        // $encode_majority = json_encode($decode_majority);
        // $encrypt_majority = openssl_encrypt($encode_majority, $ciphering, $encryption_key, $options, $encryption_iv);

        $query_update_block = "UPDATE transactions SET transaction = '$encrypt_majority'";
        mysqli_query($conn, $query_update_block);

        // encrypt decode
        $encrypt_decode = encryption(False, $decode);
        $query_update_transit_data = "UPDATE transit_data SET data = '$encrypt_decode', notification_status = true, validation_status = '$validation_status' WHERE id = $trans_id";
        mysqli_query($conn, $query_update_transit_data);
        
        if($validation_status == "Valid"){
            $_SESSION['complete-validation'] = $sender === "material & logistics" ? "Transaction request from Material & Logistics has been successfully validated" : "Transaction request from Warehouse has been successfully validated"; 
            
        } else{
            $_SESSION['complete-validation'] = $sender === "material & logistics" ? "Transaction request from Material & Logistics has been rejected" : "Transaction request from Warehouse has been rejected";
        }
        

       


    }


?>