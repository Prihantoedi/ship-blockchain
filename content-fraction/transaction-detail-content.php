<main class="content scrollable">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Transaction Detail</strong></h1>

        <div class="row">
            <div class="col">


                <div class="card flex-fill mt-2">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Block Number: <?php echo $block_no; ?></h5>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <tbody>

                            
                            <?php if(isset($block_info->type)){?>
                                <tr>
                                    <td>Previous</td>
                                    <td><?php echo $block_info->previous; ?></td>
                                </tr>

                                <tr>
                                    <td>Type</td>
                                    <td><?php echo $block_info->type; ?></td>
                                </tr>

                                <tr>
                                    <td>Nonce</td>
                                    <td><?php echo $block_info->nonce; ?></td>
                                </tr>

                                <tr>
                                    <td>Timestamp</td>
                                    <td><?php echo $block_info->timestamp; ?></td>
                                </tr>

                                <tr>
                                    <td>Hash</td>
                                    <td><?php echo $block_info->hash; ?></td>
                                </tr>
                            
                            <!-- end if isset -->
                            <?php } else{ if($block_info->sender == "engineering"){?>
                                <tr>
                                    <td>Previous</td>
                                    <td><?php echo $block_info->previous; ?></td>
                                </tr>
                                <tr>
                                    <td>Sender</td>
                                    <td><?php echo $block_info->sender; ?></td>
                                </tr>

                                <tr>
                                    <td>Recipient</td>
                                    <td><?php echo $block_info->recipient; ?></td>
                                </tr>

                                <tr>
                                    <td>Project Name</td>
                                    <td><?php echo $block_info->project_name; ?></td>
                                </tr>

                                <tr>
                                    <td>Project Code</td>
                                    <td><?php echo $block_info->project_code; ?></td>
                                </tr>

                                <tr>
                                    <td>Status</td>
                                    <td><?php echo $block_info->validation_status; ?></td>
                                </tr>

                                <tr>
                                    <td>Nonce</td>
                                    <td><?php echo $block_info->nonce; ?></td>
                                </tr>

                                <tr>
                                    <td>Submission Time</td>
                                    <td><?php echo microtimeToDate($block_info->submission_time); ?></td>
                                </tr>

                                <tr>
                                    <td>Timestamp</td>
                                    <td><?php echo $block_info->timestamp; ?></td>
                                </tr>

                                <tr>
                                    <td>Hash</td>
                                    <td><?php echo $block_info->hash; ?></td>
                                </tr>


                                
                            <?php } else if ($block_info->sender == "material & logistics") {?>
                                <tr>
                                    <td>Previous</td>
                                    <td><?php echo $block_info->previous; ?></td>
                                </tr>
                                <tr>
                                    <td>Sender</td>
                                    <td><?php echo $block_info->sender; ?></td>
                                </tr>

                                <tr>
                                    <td>Recipient</td>
                                    <td><?php echo $block_info->recipient; ?></td>
                                </tr>

                                <tr>
                                    <td>PO No.</td>
                                    <td><?php echo $block_info->po_no; ?></td>
                                </tr>

                                <tr>
                                    <td>PO Date</td>
                                    <td><?php echo microtimeToDate($block_info->po_date); ?></td>
                                </tr>

                                <tr>
                                    <td>Vendor Name</td>
                                    <td><?php echo $block_info->vendor_name; ?></td>
                                </tr>

                                <tr>
                                    <td>Vendor Code</td>
                                    <td><?php echo $block_info->vendor_code; ?></td>
                                </tr>

                                <tr>
                                    <td>Vendor City</td>
                                    <td><?php echo $block_info->vendor_city; ?></td>
                                </tr>

                                <tr>
                                    <td>Project Code</td>
                                    <td><?php echo $block_info->project_code; ?></td>
                                </tr>

                                <tr>
                                    <td>F-Item</td>
                                    <td><?php echo $block_info->f_item; ?></td>
                                </tr>

                                <tr>
                                    <td>Item Description</td>
                                    <td><?php echo $block_info->item_description; ?></td>
                                </tr>

                                <tr>
                                    <td>Quantity</td>
                                    <td><?php echo $block_info->quantity; ?></td>
                                </tr>

                                <tr>
                                    <td>Unit</td>
                                    <td><?php echo $block_info->unit; ?></td>
                                </tr>

                                <tr>
                                    <td>Status PO</td>
                                    <td><?php echo $block_info->po_status; ?></td>
                                </tr>

                                <tr>
                                    <td>Nonce</td>
                                    <td><?php echo $block_info->nonce; ?></td>
                                </tr>


                                <tr>
                                    <td>Timestamp</td>
                                    <td><?php echo $block_info->timestamp; ?></td>
                                </tr>

                                <tr>
                                    <td>Hash</td>
                                    <td><?php echo $block_info->hash; ?></td>
                                </tr>
                            <?php } else if($block_info->sender == "purchasing" && $block_info->recipient == "warehouse") {?>
                                <tr>
                                    <td>Previous</td>
                                    <td><?php echo $block_info->previous; ?></td>
                                </tr>
                                <tr>
                                    <td>Sender</td>
                                    <td><?php echo $block_info->sender; ?></td>
                                </tr>

                                <tr>
                                    <td>Recipient</td>
                                    <td><?php echo $block_info->recipient; ?></td>
                                </tr>

                                <tr>
                                    <td>GR No.</td>
                                    <td><?php echo $block_info->gr_no; ?></td>
                                </tr>

                                <tr>
                                    <td>GR Date</td>
                                    <td><?php echo microtimeToDate($block_info->gr_date); ?></td>
                                </tr>

                                <tr>
                                    <td>F-Item</td>
                                    <td><?php echo $block_info->f_item; ?></td>
                                </tr>

                                <tr>
                                    <td>Item Description</td>
                                    <td><?php echo $block_info->item_description; ?></td>
                                </tr>

                                <tr>
                                    <td>Quantity</td>
                                    <td><?php echo $block_info->quantity; ?></td>
                                </tr>

                                <tr>
                                    <td>Unit</td>
                                    <td><?php echo $block_info->unit; ?></td>
                                </tr>

                                <tr>
                                    <td>Status GR</td>
                                    <td><?php echo $block_info->gr_status; ?></td>
                                </tr>

                                <tr>
                                    <td>Nonce</td>
                                    <td><?php echo $block_info->nonce; ?></td>
                                </tr>

                                <tr>
                                    <td>Timestamp</td>
                                    <td><?php echo $block_info->timestamp; ?></td>
                                </tr>

                                <tr>
                                    <td>Hash</td>
                                    <td><?php echo $block_info->hash; ?></td>
                                </tr>
                            <?php } else{?>
                                <tr>
                                    <td>Previous</td>
                                    <td><?php echo $block_info->previous; ?></td>
                                </tr>
                                <tr>
                                    <td>Sender</td>
                                    <td><?php echo $block_info->sender; ?></td>
                                </tr>

                                <tr>
                                    <td>Recipient</td>
                                    <td><?php echo $block_info->recipient; ?></td>
                                </tr>

                                <tr>
                                    <td>PR No.</td>
                                    <td><?php echo $block_info->pr_no; ?></td>
                                </tr>

                                <tr>
                                    <td>PR Date</td>
                                    <td><?php echo $block_info->pr_date; ?></td>
                                </tr>

                                <tr>
                                    <td>PO No.</td>
                                    <td><?php echo $block_info->po_no; ?></td>
                                </tr>

                                <tr>
                                    <td>Vendor Name</td>
                                    <td><?php echo $block_info->vendor_name; ?></td>
                                </tr>

                                <tr>
                                    <td>Vendor Code</td>
                                    <td><?php echo $block_info->vendor_code; ?></td>
                                </tr>

                                <tr>
                                    <td>Vendor City</td>
                                    <td><?php echo $block_info->vendor_city; ?></td>
                                </tr>

                                <tr>
                                    <td>F-Item</td>
                                    <td><?php echo $block_info->f_item; ?></td>
                                </tr>

                                <tr>
                                    <td>Item Description</td>
                                    <td><?php echo $block_info->item_description; ?></td>
                                </tr>

                                <tr>
                                    <td>Quantity</td>
                                    <td><?php echo $block_info->quantity; ?></td>
                                </tr>

                                <tr>
                                    <td>Unit</td>
                                    <td><?php echo $block_info->unit; ?></td>
                                </tr>

                                <tr>
                                    <td>Price</td>
                                    <td>Rp. <?php echo $block_info->price; ?></td>
                                </tr>

                                <tr>
                                    <td>Amount</td>
                                    <td>Rp. <?php echo $block_info->amount; ?></td>
                                </tr>

                                <tr>
                                    <td>Status PR</td>
                                    <td><?php echo $block_info->pr_status; ?></td>
                                </tr>

                                <tr>
                                    <td>Nonce</td>
                                    <td><?php echo $block_info->nonce; ?></td>
                                </tr>

                                <tr>
                                    <td>Timestamp</td>
                                    <td><?php echo $block_info->timestamp; ?></td>
                                </tr>

                                <tr>
                                    <td>Hash</td>
                                    <td><?php echo $block_info->hash; ?></td>
                                </tr>
                            
                            
                            
                            <?php }?>


                            <!-- end of else isset -->
                            <?php }?>
                        

                        </table>
                        
                    </div>
                </div>

                
            </div>
        </div>

    </div>
</main>