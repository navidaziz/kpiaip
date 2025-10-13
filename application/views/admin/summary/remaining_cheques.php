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
                        </tr>
                    <?php
                    }
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

</html>