<?php
$pay_name = str_replace('WUA:', '', $water_user_association->wua_name);
$pay_name = trim(str_replace("-".$water_user_association->district_name, '', $pay_name));
if($pay_name){ ?>
<div class="table-responsive">
    <table class="table table-bordered table_small" id="all_expenses">
        <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th>Financial Year</th>
                <th>District</th>
                <th>Cheque</th>
                <th>Date</th>
                <th>Wua Reg No</th>
                <th>Scheme Name</th>
                <th>Payee Name</th>
                <th>Com</th>
                <th>Sub Com</th>
                <th>Category</th>
                <th>Section Cost</th>
                <th>Gross Paid</th>
                <th>Whit</th>
                <th>Whst</th>
                <th>Kpra</th>
                <th>St Duty</th>
                <th>Rdp</th>
                <th>Gur Ret</th>
                <th>Misc Ded</th>
                <th>Net Total</th>
                <th>CC</th>
                <!-- <th>Ll</th> -->
                <th>Install</th>
                <th>status</th>

            </tr>
        </thead>
        <tbody>

            <?php
            $count=1;
            $query = "SELECT wua, Payee_name FROM all_expenses_backup2 
                WHERE TRIM(Payee_name) LIKE '%".$pay_name."%'
                GROUP BY wua";
                $wuas = $this->db->query($query)->result();
                foreach($wuas as $wua){ ?>
            <?php $query="SELECT COUNT(*) as total FROM schemes WHERE scheme_name = '".$wua->Payee_name.' - '.$wua->wua."'"; 
                    $color="";
                    $schemEntryCount = $this->db->query($query)->row()->total;
                    if($schemEntryCount>0){
                        $color="lightgray";
                    }
                    ?>

            <tr style="background-color: <?php echo $color; ?>;">
                <td><?php echo $wua->wua; ?></td>
                <td colspan="24"><?php echo $wua->Payee_name; ?> - <?php echo $wua->wua; ?>
                    <?php if($schemEntryCount>0){ ?>
                    <i class="fa fa-check" style="color:green" aria-hidden="true"></i>
                    <?php  } ?>
                </td>
            </tr>

            <?php 
            
                $query = "SELECT * FROM all_expenses_backup2 
                WHERE TRIM(Payee_name) LIKE '%".$pay_name."%'
                AND wua = '".$wua->wua."'
                ORDER BY date ASC";
                $rows = $this->db->query($query)->result();
                $cheques= array();
                $category = array();
                $chq_count=1;
                $start_date = '';
                $end_date = '';
                $sanctioned_cost=0;
                foreach ($rows as $row) { 
                    if($chq_count=='1'){
                    $start_date =  $row->Date;
                    }else{
                    $end_date =  $row->Date;
                    }
                    $chq_count++;
                    ?>
            <tr style="background-color: <?php echo $color; ?>;">
                <td></td>
                <td><?php echo $count++ ?></td>
                <td><?php echo $row->financial_year; ?></td>
                <td><?php echo $row->District; ?>
                    <small><?php echo $row->Region; ?></small>
                </td>
                <td><?php echo $row->Cheque; 
                $cheques[] = $row->Cheque;
                
                ?></td>
                <td><?php echo date('d-m-Y', strtotime($row->Date)); ?></td>
                <td><?php echo $row->wua; ?>
                    <?php if($schemEntryCount==0){ ?>
                    <small onclick="edit_expense_wua_no('<?php echo $row->expense_id; ?>')">Edit</small>
                    <?php } ?>
                </td>
                <td><?php echo $row->scheme_name; ?></td>
                <td><?php echo $row->Payee_name; ?></td>
                <td><?php echo $row->com; ?></td>
                <td><?php echo $row->sub_com; ?></td>
                <td><?php echo $row->category; 
                $query="SELECT component_category_id FROM component_categories WHERE category = '".$row->category."'";
                $component_category = $this->db->query($query)->row();
                $category[$row->category] = $component_category->component_category_id;


                ?></td>
                <td><?php echo str_replace(',', '', $row->section_cost); ?></td>
                <td><?php echo $row->gross_pay; ?></td>
                <td><?php echo $row->whit; ?></td>
                <td><?php echo $row->whst; ?></td>
                <td><?php echo $row->kpra; ?></td>
                <td><?php echo $row->st_duty; ?></td>
                <td><?php echo $row->rdp; ?></td>
                <td><?php echo $row->gur_ret; ?></td>
                <td><?php echo $row->misc_ded; ?></td>
                <td><?php echo $row->net_total; ?></td>
                <!-- <td><?php echo $row->CC; 
                $cc = str_replace(',','',$row->CC);
                if($cc>0){
                $sanctioned_cost=$cc;
                }
                ?></td> -->
                <td><?php echo $row->LL; ?></td>
                <td><?php echo $row->Install; ?></td>
                <td><?php echo $row->status; ?></td>

            </tr>
            <?php } ?>
            <?php if($schemEntryCount==0){ ?>
            <tr>
                <td colspan="25">
                    <?php  
                    if((count($cheques)==2 or count($cheques)==3)  and count($category)==1){ 
        $query = "SELECT financial_year_id
        FROM financial_years
        WHERE '" . $start_date . "' BETWEEN start_date AND end_date;";
        $finacial_year = $this->db->query($query)->row();
        if ($finacial_year) {
            $financial_year_id = $finacial_year->financial_year_id;
        } else {
            $financial_year_id  = 0;
        }
                        ?>
                    <form method="post"
                        action="<?php echo site_url(ADMIN_DIR.'water_user_associations/add_scheme_and_cheque') ?>">
                        <input type="text" name="scheme_code" value="<?php echo $wua->wua ?>" /> <input type="text"
                            name="scheme_name" value="<?php echo $wua->Payee_name; ?> - <?php echo $wua->wua; ?>" />
                        <input type="text" name="cheques" value="<?php echo implode(',',$cheques) ?>" />
                        <input type="text" name="component_category_id" value="<?php echo reset($category) ?>" />
                        <input type="text" name="registration_date" value="<?php echo $start_date; ?>" />
                        <input type="text" name="completion_date" value="<?php echo $end_date; ?>" />
                        <input type="text" name="sanctioned_cost" value="<?php echo $sanctioned_cost; ?>" />
                        <input type="text" name="district_id"
                            value="<?php echo $water_user_association->district_id ?>" />
                        <input type="text" name="water_user_association_id"
                            value="<?php echo $water_user_association->water_user_association_id; ?>" />
                        <input type="text" name="financial_year_id" value="<?php echo $financial_year_id; ?>" />
                        <input type="submit" name="save" value="Add Scheme" />
                    </form>
                    <?php } ?>
                    <hr />
                </td>
            </tr>
            <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php } ?>

<script>
function edit_expense_wua_no(expense_id) {
    //alert(expense_id);
    $.ajax({
            method: "POST",
            url: "<?php echo site_url(ADMIN_DIR . 'water_user_associations/change_wua_reg_no'); ?>",
            data: {
                expense_id: expense_id
            },
        })
        .done(function(respose) {
            $('#modal').modal('show');
            $('#modal_title').html('Change WUA REG NO. For Correction');
            $('#modal_body').html(respose);
        });
}
</script>