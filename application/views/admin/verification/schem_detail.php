<?php
$query = "SELECT s.*, d.district_name as district, d.region, sc.category, sc.category_detail 
FROM schemes  as s 
INNER JOIN component_categories as sc ON  sc.component_category_id = s.component_category_id
INNER JOIN districts as d ON d.district_id = d.district_id
WHERE  s.scheme_code = ?";

$scheme = $this->db->query($query, [$scheme_code])->row();


?>
<?php if ($scheme) { ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8">
                    <h4>
                        Scheme Code: <strong><?php echo htmlspecialchars($scheme->scheme_code); ?></strong><br />
                        Scheme Name: <strong><?php echo htmlspecialchars($scheme->scheme_name); ?></strong><br />
                    </h4>
                    <h4>
                        <small>
                            Address: Region: <?php echo htmlspecialchars($scheme->region); ?>, District: <?php echo htmlspecialchars($scheme->district); ?>, Tehsil: <?php echo htmlspecialchars($scheme->tehsil); ?>, UC: <?php echo htmlspecialchars($scheme->uc); ?>, Address: <?php echo htmlspecialchars($scheme->villege); ?>
                        </small>
                    </h4>
                </div>
                <div class="col-md-4">
                    <h4>
                        Scheme Category: <strong><?php echo htmlspecialchars($scheme->category); ?></strong><br />
                        <?php echo htmlspecialchars($scheme->category_detail); ?>
                    </h4>
                    <p>Scheme Status: <strong><?php echo htmlspecialchars($scheme->scheme_status); ?></strong></p>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12" style="text-align: center;">
                    <a class="btn btn-danger" target="_blank" href="<?php echo site_url(ADMIN_DIR . "verification/print_scheme_detail/" . $scheme->scheme_id); ?>"><i class="fa fa-print" aria-hidden="true"></i> Print Scheme Detail</a>

                </div>

            </div>

        </div>
    </div>
<?php } else { ?>
    <div class="alert alert-danger">
        <i class="glyphicon glyphicon-exclamation-sign"></i>
        Scheme Code. <strong><?php echo htmlspecialchars($scheme_code); ?></strong> not found in database.
        Please try again with a different Scheme Code. Thank you.
    </div>
<?php } ?>