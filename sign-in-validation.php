<?php
    session_start();
    require("connection.php");

    
    if(isset($_POST['submit'])){
        $query = mysqli_query($conn, "SELECT * FROM user");
        $prk = $_POST['private-key'];

        $ciphering = "AES-128-CTR";
        $options = 0;
        $decryption_iv = "andialwanpatiara";

        $decryption_key = "1c4afd3ef2b67fa640b428265dba46513cbd6ebb";
        $rows = [];
        while($row = mysqli_fetch_assoc($query)){
            $scr_data = $row["data"];
            
            $decryption = openssl_decrypt($scr_data, $ciphering, $decryption_key, $options, $decryption_iv);
            $decoding = json_decode($decryption);

            if($prk === $decoding->prk){
                $rows['pub'] = $decoding->pub;
                $rows['role'] = $decoding->role;
                break;
            }
        }

        if(count($rows) == 0){
            $_SESSION['err'] = "Invalid Private Key!";
            header("Location: sign-in.php");
            exit;
        } else{
            $_SESSION['pub'] = $rows['pub'];
            $_SESSION['role'] = $rows['role'];
            header("Location: admin-port.php");
            exit;
        }

        
    } else{
        $_SESSION['err'] = "Invalid Private Key!";
        header("Location: sign-in.php");
        exit;
    }

?>