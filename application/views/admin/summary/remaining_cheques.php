<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Remaining Cheques</title>
    <!-- Bootstrap 3 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>

    <div class="container" style="margin-top:30px;">
        <h2 class="text-center">Remaining Cheques</h2>
        <hr>

        <?php
        // Run the query safely
        $query = "SELECT `purpose`, `category`, `financial_year`, `district_name`, `cheque`, `date`, `payee_name` FROM `remaing_cheques`";
        $remaining_cheques = $this->db->query($query)->result();
        ?>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Purpose</th>
                    <th>Category</th>
                    <th>Financial Year</th>
                    <th>District</th>
                    <th>Cheque No.</th>
                    <th>Date</th>
                    <th>Payee Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($remaining_cheques)) {
                    $i = 1;
                    foreach ($remaining_cheques as $row) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo htmlspecialchars($row->purpose); ?></td>
                            <td><?php echo htmlspecialchars($row->category); ?></td>
                            <td><?php echo htmlspecialchars($row->financial_year); ?></td>
                            <td><?php echo htmlspecialchars($row->district_name); ?></td>
                            <td><?php echo htmlspecialchars($row->cheque); ?></td>
                            <td><?php echo htmlspecialchars($row->date); ?></td>
                            <td><?php echo htmlspecialchars($row->payee_name); ?></td>
                            <td>
                                <?php if ($row->category == 'B-3' or $row->category == 'B-1') { ?>
                                    <button onclick="get_cheque_detail('<?php echo $row->cheque; ?>')">Add Scheme</button>
                                <?php } ?>
                            <?php } ?>
                            </td>
                        </tr>
                    <?php

                } else { ?>
                        <tr>
                            <td colspan="8" class="text-center text-danger">No records found!</td>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS + jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
<script>
    function get_cheque_detail(cheque_no) {
        $.ajax({
                method: "POST",
                url: "<?php echo site_url(ADMIN_DIR . 'Summary/get_cheque_detail'); ?>",
                data: {
                    cheque_no: cheque_no
                },
            })
            .done(function(respose) {
                $('#modal').modal('show');

                $('#modal_title').html(cheque_no + ' Cheque No');
                $('#modal_body').html(respose);
                $('.modal-dialog').css('width', '99%'); // Directly set the width
            });
    }
</script>

</html>