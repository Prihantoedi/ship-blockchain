<?php 

    function getNotification($id, $url, $connection){
        $current_time = date("d-m-Y H:i:s");
        $query_transit = "SELECT * FROM transit_data WHERE user_id = $id";
        
        $transit = mysqli_query($connection, $query_transit);
        $notif_num_count_ = 0;

        $notif_data_ = array();
        while($row = mysqli_fetch_assoc($transit)){
            if($row["validation_status"] == "Valid" || $row["validation_status"] == "Reject"){
                $decrypt_decode = decryption(FALSE, $row["data"]);
                // $decrypt_decode->validation_status = "valid";
                $day_diff = 0;

                
                $microtime_to_date = microtimeToDate($decrypt_decode->timestamp);


                $time = date_create($microtime_to_date);
                $current = date_create($current_time);

                $day_diff = $current->diff($time)->days;
                // if($decrypt_decode->sender === "engineering"){
                //     $submission_time = microtimeToDate($decrypt_decode->submission_time);
                
                //     $submission = date_create($submission_time);
                //     $current = date_create($current_time);
    
                //     $day_diff = $current->diff($submission)->days;
                // }
                // else if($decrypt_decode->sender === "material & logistics"){
                //     $po_date = microtimeToDate($decrypt_decode->po_date);
                
                //     $po = date_create($po_date);
                //     $current = date_create($current_time);
    
                //     $day_diff = $current->diff($po)->days;

                // } else if($decrypt_decode->sender === "purchasing"){
                
                // }
                
                
                $decrypt_decode->group = $day_diff <= 2 ? "recent" : "older";
                
                $decrypt_decode->validation_status = $row["validation_status"] == "Valid" ? "Valid" : "Reject";		

                array_push($notif_data_, $decrypt_decode);
                
                if($row["notification_status"] == TRUE){
                    $notif_num_count_++;
                }
            }
            
        }
    
        $split_current_url = explode("/", $url);
        $last_string_url = end($split_current_url);
        
        // $notif_num_count_ = $url == "/ship-block/engineering-admin/notifications.php" ? 0 : $notif_num_count_;
        // die($notif_num_count_);
        $notif_num_count_ = $last_string_url == "notifications.php" ? 0 : $notif_num_count_;

        $recent_ = array();
        $older_ = array();

        foreach($notif_data_ as $notif){
            $notif->group == "recent" ? array_push($recent_, $notif) : array_push($older_, $notif);
        }
        
        $recent_ = array_reverse($recent_);
        $older_ = array_reverse($older_);
    
        return ["notif-data" => count($notif_data_), "notif-num-count" => $notif_num_count_, "recent" => $recent_, "older" => $older_];
    }

?>