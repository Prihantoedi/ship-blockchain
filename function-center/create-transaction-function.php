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
            
            $encryption = encryption(False, $new_transit);


            $query_all_user = "SELECT * FROM user";
            $all_user = mysqli_query($this->conn, $query_all_user);

            $material_logistics_id = 0;

            while($row = mysqli_fetch_assoc($all_user)){
                $scr_data = $row["data"];    
                $decoding = decryption(True, $scr_data);

                if($decoding->role === "material & logistics"){
                    $material_logistics_id = $row["id"];
                    break;
                }
            }


            $query = "INSERT INTO transit_data (user_id, to_id, data, notification_status, validation_status) VALUES ($engineering_id, $material_logistics_id, '$encryption', FALSE, 'pending')";
            $transit = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));

        }

        public function createTransMaterial($po_no_, $pro_code, $vend_name, $vend_code, $vend_city, $f_item, $item_desc, $qty, $unit_, $id){
            
            $new_transit = new stdClass();
            $new_transit->sender = "material & logistics";
            $new_transit->recipient = "purchasing";
            $new_transit->project_code = $pro_code;
            $new_transit->po_no = $po_no_;
            $new_transit->po_date = microtime(true);
            $new_transit->po_status = "Open";
            $new_transit->vendor_name = $vend_name;
            $new_transit->vendor_code = $vend_code;
            $new_transit->vendor_city = $vend_city;
            $new_transit->f_item = $f_item;
            $new_transit->item_description = $item_desc;
            $new_transit->quantity = $qty;
            $new_transit->unit = $unit_;
             
            $encryption = encryption(False, $new_transit);

            $query_all_user = "SELECT * FROM user";
            $all_user = mysqli_query($this->conn, $query_all_user);

            $purchasing_id = 0;

            while($row = mysqli_fetch_assoc($all_user)){
                $scr_data = $row["data"];    
                $decoding = decryption(True, $scr_data);

                if($decoding->role === "purchasing"){
                    $purchasing_id = $row["id"];
                    break;
                }
            }

            $query = "INSERT INTO transit_data (user_id, to_id, data, notification_status, validation_status) VALUES ($id, $purchasing_id, '$encryption', FALSE, 'pending')";
            $transit = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        }

        public function createTransPurchasing($pr_no_, $pr_date_, $po_no_, $vend_name, $vend_code, $vend_city, $f_item, $item_desc, $qty, $unit_, $price_, $pr_status_, $id, $blocks, $send_to){
            
            if($send_to == "material"){
                $decode_blocks = decryption(False, $blocks);
                if($pr_status_ === "Open"){
                    $pr_date_ = join("-", array_reverse(explode("-", $pr_date_)));
                    $pro_code = "";
                    foreach($decode_blocks as $db){
                        if(isset($db->po_no) && isset($db->project_code) && $db->po_no === $po_no_){
                            $pro_code = $db->project_code;
                            break;
                            
                        }
                    }
                    
            
                    $amount = (int)$price_ * (int)$qty;
                    $new_transit = new stdClass();
                    $new_transit->sender = "purchasing";
                    $new_transit->recipient = "material & logistics";
                    $new_transit->pr_no = $pr_no_;
                    $new_transit->pr_date = $pr_date_;
                    $new_transit->po_no = $po_no_;
                    $new_transit->vendor_name = $vend_name;
                    $new_transit->vendor_code = $vend_code;
                    $new_transit->vendor_city = $vend_city;
                    $new_transit->project_code = $pro_code;
                    $new_transit->f_item = $f_item;
                    $new_transit->item_description = $item_desc;
                    $new_transit->quantity = $qty;
                    $new_transit->unit = $unit_;
                    $new_transit->pr_status = $pr_status_;
                    $new_transit->price = $price_;
                    $new_transit->amount = $amount;

                    // die(print_r($new_transit));

                    

                } else{
                    // die(print_r($decode_blocks));
                    $new_transit = new stdClass();
                    foreach($decode_blocks as $db){
                        if(isset($db->pr_no)){
                            if($db->pr_no === $pr_no_ && $db->pr_status === "Open"){
                                // die("found");
                                $new_transit->sender = $db->sender;
                                $new_transit->recipient = $db->recipient;
                                $new_transit->pr_no = $pr_no_;
                                $new_transit->pr_date = $db->pr_date;
                                $new_transit->po_no = $db->po_no;
                                $new_transit->vendor_name = $db->vendor_name;
                                $new_transit->vendor_code = $db->vendor_code;
                                $new_transit->vendor_city = $db->vendor_city;
                                $new_transit->project_code = $db->project_code;
                                $new_transit->f_item = $db->f_item;
                                $new_transit->item_description = $db->item_description;
                                $new_transit->quantity = $db->quantity;
                                $new_transit->unit = $db->unit;
                                $new_transit->pr_status = $pr_status_;
                                $new_transit->price = $db->price;
                                $new_transit->amount = $db->amount;
                            }
                        }
                    }

                }

                $encryption = encryption(False, $new_transit);
                $query_all_user = "SELECT * FROM user";
                $all_user = mysqli_query($this->conn, $query_all_user);

                $recipient_id = 0;

                while($row = mysqli_fetch_assoc($all_user)){
                    $scr_data = $row["data"];    
                    $decoding = decryption(True, $scr_data);
    
                    if($decoding->role === "material & logistics"){
                        $recipient_id = $row["id"];
                        break;
                    }
                }
                
            }

            $query = "INSERT INTO transit_data (user_id, to_id, data, notification_status, validation_status) VALUES ($id, $recipient_id, '$encryption', FALSE, 'pending')";
            $transit = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));

        }


    }


?>