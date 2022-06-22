<?php 
    $query_checking = mysqli_query($conn, "SELECT * FROM transactions");
    $check_node = array();
    
    while($row_check = mysqli_fetch_assoc($query_checking)){
        $transaction = $row_check['transaction'];
        if(array_key_exists($transaction, $check_node)){
            $check_node[$transaction]++;
        } else{
            $check_node[$transaction] = 1;
        }
    }

    $majority_qty = max($check_node);

    $majority = array_search($majority_qty, $check_node);

?>