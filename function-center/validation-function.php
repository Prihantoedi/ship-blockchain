<?php 

    function pendingValidation($id, $connection){
        $query = "SELECT * FROM transit_data WHERE validation_status = 'pending' AND to_id = $id";

        $transit_data = mysqli_query($connection, $query);
    
        $need_validation_ = [];
        
        //
        if(!empty($transit_data)){
            while($row = mysqli_fetch_assoc($transit_data)){
           
                if($row["to_id"] === $id && $row["validation_status"] === "pending"){
                    
                    $decode = decryption(False, $row["data"]);
                    $need_validation_[] = [$row['id'], $decode];
                }
            }
        }
    
        $validate_num_count_ = count($need_validation_);

        return ["need-validation" => $need_validation_, "validate-num-count" => $validate_num_count_];

    }



?>