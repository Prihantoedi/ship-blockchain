<?php 

    // require("../connection.php");

    
    class createTransaction{
        private $conn;

        public function __construct(){
            $this->conn = mysqli_connect("localhost", "root", "", "block_ship");
        }

        public function createTransEngineering($pr_name, $pr_code, $id){
            $project_name = $pr_name;
            $project_code = $pr_code;

            $engineering_id = $id;

            $new_transit = new stdClass();
            $new_transit->submission_time = microtime(true);
            $new_transit->sender = "engineering";
            $new_transit->recipient = "material & logistics";
            $new_transit->project_name = $project_name;
            $new_transit->project_code = $project_code;
            
            $encode = json_encode($new_transit); 

            $ciphering = "AES-128-CTR";
            $options = 0;

            $encryption_iv = "andialwanpatiara";
            $encryption_key = "1a4afd3ef2b67fa640b428265dba46513cbd6ess";

            $encryption = openssl_encrypt($encode, $ciphering, $encryption_key, $options, $encryption_iv);

            $query_all_user = "SELECT * FROM user";
            $all_user = mysqli_query($this->conn, $query_all_user);


            $decryption_iv = "andialwanpatiara";

            $decryption_key = "1c4afd3ef2b67fa640b428265dba46513cbd6ebb";
            $material_logstics_id = 0;

            while($row = mysqli_fetch_assoc($all_user)){
                $scr_data = $row["data"];
            
                $decryption = openssl_decrypt($scr_data, $ciphering, $decryption_key, $options, $decryption_iv);
                $decoding = json_decode($decryption);

                if($decoding->role === "material & logistics"){
                    $material_logstics_id = $row["id"];
                    break;
                }
            }


            $query = "INSERT INTO transit_data (user_id, to_id, data, notification_status, validation_status) VALUES ($engineering_id, $material_logstics_id, '$encryption', FALSE, 'pending')";
            $transit = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));

        }
    }


?>