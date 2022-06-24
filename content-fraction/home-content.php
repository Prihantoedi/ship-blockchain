<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Latest<strong> Transaction</strong> List</h1>


        <div class="row">
            <div class="col">
                <div class="card flex-fill">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Latest Transactions</h5>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>Block Number</th>
                                <th>Hash</th>
                                <th class="d-none d-xl-table-cell">Timestamp</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($transaction_for_home as $tfh) {
                            ?>

                                    <tr>
                                        <td><?php echo $tfh->block_no; ?></td>
                                        <td><a href="transaction-detail.php?block=<?php echo $tfh->block_no;?>"><?php echo $tfh->hash; ?></a></td>
                                        <td class="d-none d-xl-table-cell"><?php echo $tfh->timestamp; ?></td>
                                    </tr>
                            <!-- foreach close -->
                            <?php }?>
                        </tbody>
                    </table>
                </div>
        </div>

    </div>
</main>