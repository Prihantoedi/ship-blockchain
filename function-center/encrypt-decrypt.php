<?php 
    function decryption($auth_decryption, $data){
        $ciphering = "AES-128-CTR";
        $options = 0;

        if($auth_decryption){
            $decryption_iv = "andialwanpatiara";
            $decryption_key = "1c4afd3ef2b67fa640b428265dba46513cbd6ebb";

        } else{
            $decryption_iv = "andialwanpatiara";
            $decryption_key = "1a4afd3ef2b67fa640b428265dba46513cbd6ess";
        }

        $decryption = openssl_decrypt($data, $ciphering, $decryption_key, $options, $decryption_iv);
        
        $decode = json_decode($decryption);
        return $decode;        
        

    }

?>