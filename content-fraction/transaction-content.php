<main class="content scrollable">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Transactions</strong></h1>


        <div class="row">
            <div class="col">
                <?php foreach($all_transactions as $all){
                ?>
                    <div class="card flex-fill mt-2">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Block Number: <?php echo $all->block_no; ?></h5>
                        </div>

                        <div class="card-body">
                            <table class="table">
                                <?php if(isset($all->type)){?>
                                    <tbody>
                                        <tr>
                                            <td>Previous</td>
                                            <td><?php echo $all->previous; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Type</td>
                                            <td><?php echo $all->type; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nonce</td>
                                            <td><?php echo $all->nonce; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Timestamp</td>
                                            <td><?php echo $all->timestamp; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Hash</td>
                                            <td><?php echo $all->hash; ?></td>
                                        </tr>
                                    </tbody>
                                <?php } 
                                
                                else if($all->sender == "engineering") {?>
                                    <tbody>
                                        <tr>
                                            <td>Previous</td>
                                            <td><?php echo $all->previous; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Sender</td>
                                            <td><?php echo $all->sender; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Recipient</td>
                                            <td><?php echo $all->recipient; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Project Name</td>
                                            <td><?php echo $all->project_name; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Project Code</td>
                                            <td><?php echo $all->project_code; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Status</td>
                                            <td><?php echo $all->validation_status; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Nonce</td>
                                            <td><?php echo $all->nonce; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Submission Time</td>
                                            <td><?php echo microtimeToDate($all->submission_time); ?></td>
                                        </tr>

                                        <tr>
                                            <td>Timestamp</td>
                                            <td><?php echo $all->timestamp; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Hash</td>
                                            <td><?php echo $all->hash; ?></td>
                                        </tr>
                                    </tbody>
                                <?php }
                                else if($all->sender === "material & logistics"){?>

                                    <tbody>
                                        <tr>
                                            <td>Previous</td>
                                            <td><?php echo $all->previous; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Sender</td>
                                            <td><?php echo $all->sender; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Recipient</td>
                                            <td><?php echo $all->recipient; ?></td>
                                        </tr>

                                        <tr>
                                            <td>PO No.</td>
                                            <td><?php echo $all->po_no; ?></td>
                                        </tr>

                                        <tr>
                                            <td>PO Date</td>
                                            <td><?php echo microtimeToDate($all->po_date); ?></td>
                                        </tr>

                                        <tr>
                                            <td>Vendor Name</td>
                                            <td><?php echo $all->vendor_name; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Vendor Code</td>
                                            <td><?php echo $all->vendor_code; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Vendor City</td>
                                            <td><?php echo $all->vendor_city; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Project Code</td>
                                            <td><?php echo $all->project_code; ?></td>
                                        </tr>

                                        <tr>
                                            <td>F-Item</td>
                                            <td><?php echo $all->f_item; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Item Description</td>
                                            <td><?php echo $all->item_description; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Quantity</td>
                                            <td><?php echo $all->quantity; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Unit</td>
                                            <td><?php echo $all->unit; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Status PO</td>
                                            <td><?php echo $all->po_status; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Nonce</td>
                                            <td><?php echo $all->nonce; ?></td>
                                        </tr>


                                        <tr>
                                            <td>Timestamp</td>
                                            <td><?php echo $all->timestamp; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Hash</td>
                                            <td><?php echo $all->hash; ?></td>
                                        </tr>
                                    </tbody>

                                <?php } 
                                    else if($all->sender === "purchasing" && $all->recipient === "warehouse") {
                                ?>
                                    <tbody>
                                        <tr>
                                            <td>Previous</td>
                                            <td><?php echo $all->previous; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Sender</td>
                                            <td><?php echo $all->sender; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Recipient</td>
                                            <td><?php echo $all->recipient; ?></td>
                                        </tr>

                                        <tr>
                                            <td>GR No.</td>
                                            <td><?php echo $all->gr_no; ?></td>
                                        </tr>

                                        <tr>
                                            <td>GR Date</td>
                                            <td><?php echo microtimeToDate($all->gr_date); ?></td>
                                        </tr>

                                        <tr>
                                            <td>F-Item</td>
                                            <td><?php echo $all->f_item; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Item Description</td>
                                            <td><?php echo $all->item_description; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Quantity</td>
                                            <td><?php echo $all->quantity; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Unit</td>
                                            <td><?php echo $all->unit; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Status GR</td>
                                            <td><?php echo $all->gr_status; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Nonce</td>
                                            <td><?php echo $all->nonce; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Timestamp</td>
                                            <td><?php echo $all->timestamp; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Hash</td>
                                            <td><?php echo $all->hash; ?></td>
                                        </tr>
                                    </tbody>
                                <?php } else{?>
                                    <tbody>
                                        <tr>
                                            <td>Previous</td>
                                            <td><?php echo $all->previous; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Sender</td>
                                            <td><?php echo $all->sender; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Recipient</td>
                                            <td><?php echo $all->recipient; ?></td>
                                        </tr>

                                        <tr>
                                            <td>PR No.</td>
                                            <td><?php echo $all->pr_no; ?></td>
                                        </tr>

                                        <tr>
                                            <td>PR Date</td>
                                            <td><?php echo $all->pr_date; ?></td>
                                        </tr>

                                        <tr>
                                            <td>PO No.</td>
                                            <td><?php echo $all->po_no; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Vendor Name</td>
                                            <td><?php echo $all->vendor_name; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Vendor Code</td>
                                            <td><?php echo $all->vendor_code; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Vendor City</td>
                                            <td><?php echo $all->vendor_city; ?></td>
                                        </tr>

                                        <tr>
                                            <td>F-Item</td>
                                            <td><?php echo $all->f_item; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Item Description</td>
                                            <td><?php echo $all->item_description; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Quantity</td>
                                            <td><?php echo $all->quantity; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Unit</td>
                                            <td><?php echo $all->unit; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Price</td>
                                            <td>Rp. <?php echo $all->price; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Amount</td>
                                            <td>Rp. <?php echo $all->amount; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Status PR</td>
                                            <td><?php echo $all->pr_status; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Nonce</td>
                                            <td><?php echo $all->nonce; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Timestamp</td>
                                            <td><?php echo $all->timestamp; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Hash</td>
                                            <td><?php echo $all->hash; ?></td>
                                        </tr>
                                    </tbody>
                                <?php }?>
                            </table>
                            
                        </div>
                    </div>


                <!-- end foreach -->
                <?php } ?>
                
            </div>
        </div>

    </div>
</main>