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

        $new_block = new stdClass();
        $new_block->previous = hash("sha256", $last_block_encode);
        $new_block->sender = $decode->sender;
        $new_block->recipient = $decode->recipient;
        $new_block->timestamp = $timestamp;    
        
        if($decode->sender === "engineering"){
            $new_block->project_name = $decode->project_name;
            $new_block->project_code = $decode->project_code;
            $new_block->submission_time = $decode->submission_time;
            $new_block->validation_status = $validation_status;
            
        } else{
            
            $new_block->pr_no = $decode->pr_no;
            $new_block->pr_date = $decode->pr_date;
            $new_block->po_no = $decode->po_no;
            $new_block->vendor_name = $decode->vendor_name;
            $new_block->vendor_code = $decode->vendor_code;
            $new_block->vendor_city = $decode->vendor_city;
            $new_block->project_code = $decode->project_code;
            $new_block->f_item = $decode->f_item;
            $new_block->item_description = $decode->item_description;
            $new_block->quantity = $decode->quantity;
            $new_block->unit = $decode->unit;
            $new_block->price = $decode->price;
            $new_block->amount = $decode->amount;
            $pr_status_ = $validation_status === "Reject" ? "Reject" : $decode->pr_status;
            $new_block->pr_status = $pr_status_;
        }



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
        // update the po status to close if pr status close, put it into blockchain
        if(isset($new_block->pr_status) && $new_block->pr_status === "Close"){
            // get the po number from blockchain looping to change status become close
            $po_no_target = $decode->po_no;
            $new_second_block = new stdClass();
            foreach($decode_majority as $dm){
                if(isset($dm->sender) && $dm->sender === "material & logistics" && $dm->recipient === "purchasing" && $dm->po_no ===  $po_no_target && $dm->po_status === "Open"){
                    $new_second_block->previous = $hash_result;
                    $new_second_block->sender = $dm->sender;
                    $new_second_block->recipient = $dm->recipient;
                    $new_second_block->project_code = $dm->project_code;
                    $new_second_block->po_no = $dm->po_no;
                    $new_second_block->po_date = $dm->po_date;
                    $new_second_block->po_status = "Close";
                    $new_second_block->vendor_name = $dm->vendor_name;
                    $new_second_block->vendor_code = $dm->vendor_code;
                    $new_second_block->vendor_city = $dm->vendor_city;
                    $new_second_block->f_item = $dm->f_item;
                    $new_second_block->item_description = $dm->item_description;
                    $new_second_block->quantity = $dm->quantity;
                    $new_second_block->unit = $dm->unit;
                    $new_second_block->validation_status = $validation_status;
                    $new_second_block->timestamp = microtime(true);
                }
            }

            $second_nonce= -1;
            $second_hash_result = "";
            while(substr($second_hash_result, 0, 4) !== $difficulty){
                $second_nonce+=1;
                $new_second_block->nonce = $second_nonce;
                $new_second_block_encode = json_encode($new_second_block);
                $second_hash_result = hash("sha256", $new_second_block_encode);
            }

            array_push($decode_majority, $new_second_block);
    
        }


        
        
        $encrypt_majority = encryption(False, $decode_majority);

        $query_update_block = "UPDATE transactions SET transaction = '$encrypt_majority'";
        mysqli_query($conn, $query_update_block);

        // add microtime to decode
        $decode->timestamp = microtime(true);
        // encrypt decode
        $encrypt_decode = encryption(False, $decode);
        
        $query_update_transit_data = "UPDATE transit_data SET data = '$encrypt_decode', notification_status = true, validation_status = '$validation_status' WHERE id = $trans_id";
        mysqli_query($conn, $query_update_transit_data);


        
        if($validation_status == "Valid"){
            $_SESSION['complete-validation'] = $decode->sender === "engineering" ? "Transaction request from Engineering has been successfully validated" : "Transaction request from Purchasing has been successfully validated";
            
        } else{
            $_SESSION["complete-validation"] = $decode->sender === "engineering" ? "Transaction request from Engineering has been rejected" : "Transaction request from Purchasing has been rejected";
        }
    

    }


?>