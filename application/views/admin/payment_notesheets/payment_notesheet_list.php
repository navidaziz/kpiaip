 <style>
     .table_small>thead>tr>th,
     .table_small>tbody>tr>th,
     .table_small>tfoot>tr>th,
     .table_small>thead>tr>td,
     .table_small>tbody>tr>td,
     .table_small>tfoot>tr>td {
         padding: 4px;
         line-height: 1;
         vertical-align: top;
         border-top: 1px solid #ddd;
         font-size: 10px !important;
         color: black;
         margin: 0px !important;
     }
 </style>
 <div class="table-responsive">
     <table class="table table-bordered table-striped table_small" id="data_table">
         <thead>
             <tr>
                 <th></th>
                 <th>#</th>
                 <th>Scheme ID</th>
                 <th>Status</th>
                 <th>Scheme Name</th>
                 <th>Account Title</th>
                 <th>Cat:</th>
                 <th>FY</th>
                 <th>Sanctioned Cost</th>
                 <th>1st</th>
                 <th>2nd</th>
                 <th>1st & 2nd</th>
                 <th>Other</th>
                 <th>Final</th>
                 <th>Paid</th>
                 <th>Balance</th>
                 <th>Pay. Type</th>
                 <th>Pay. Amount</th>
                 <th>WHIT</th>
                 <th>WHST</th>
                 <th>KPRA</th>
                 <th>St.Duty</th>
                 <th>RDP</th>
                 <th>Gur.Ret.</th>
                 <th>Misc.Dedu.</th>
                 <th>Net Rs.</th>
                 <th>Recon.</th>
                 <th>Pre. Cheques</th>
                 <th>Pay. Count</th>
                 <th></th>
                 <th></th>
             </tr>
         </thead>
         <tbody>
             <?php
                $total_sanctioned = 0;
                $total_1st = 0;
                $total_2nd = 0;
                $total_1st_2nd = 0;
                $total_final = 0;
                $total_other = 0;
                $total_paid = 0;
                $total_balance = 0;
                $total_whit = 0;
                $total_whst = 0;
                $total_st_duty = 0;
                $total_rdp = 0;
                $total_kpra = 0;
                $total_gur_ret = 0;
                $total_misc_deduction = 0;
                $total_net_pay = 0;
                $total_recon = 0;
                $total_payment_amount = 0;
                $total_payment_count = 0;
                $query = "
            SELECT 
                s.scheme_id, s.scheme_status, s.scheme_code, s.scheme_name, e.payee_name, fy.financial_year, cc.category,  
                wua.bank_account_title, pns.id as pns_id, pns.payment_amount, pns.whit, pns.whst, pns.st_duty, 
                pns.rdp, pns.kpra, pns.gur_ret, pns.misc_deduction, pns.net_pay, pns.payment_type, 
                s.lining_length, 
                SUM(e.gross_pay) as `total_paid`, 
                COUNT(e.expense_id) as `payment_count`, 
                s.sanctioned_cost, 
                SUM(CASE WHEN e.installment = '1st' THEN e.gross_pay END) AS `1st`, 
                SUM(CASE WHEN e.installment = '2nd' THEN e.gross_pay END) AS `2nd`, 
                SUM(CASE WHEN e.installment = '1st_2nd' THEN e.gross_pay END) AS `1st_2nd`, 
                SUM(CASE WHEN e.installment = 'Final' THEN e.gross_pay END) AS `final`, 
                SUM(CASE WHEN e.installment NOT IN ('1st','2nd', '1st_2nd', 'Final') THEN e.gross_pay END) AS `other`, 
               (COALESCE(s.sanctioned_cost, 0) - COALESCE(SUM(e.gross_pay), 0)) AS remaining,
                (
                COALESCE(pns.payment_amount, 0) - 
                (
                COALESCE(pns.whit, 0) + 
                COALESCE(pns.whst, 0) + 
                COALESCE(pns.st_duty, 0) + 
                COALESCE(pns.rdp, 0) + 
                COALESCE(pns.kpra, 0) + 
                COALESCE(pns.gur_ret, 0) + 
                COALESCE(pns.misc_deduction, 0) + 
                COALESCE(pns.net_pay, 0)
                )
                ) AS recon,
                 GROUP_CONCAT(e.cheque ORDER BY e.installment SEPARATOR ', ') AS `cheques`
            FROM schemes s
            INNER JOIN component_categories cc ON cc.component_category_id = s.component_category_id
            INNER JOIN payment_notesheet_schemes pns ON pns.scheme_id = s.scheme_id
            INNER JOIN financial_years fy ON fy.financial_year_id = s.financial_year_id
            LEFT JOIN expenses e ON s.scheme_id = e.scheme_id
            INNER JOIN water_user_associations wua ON wua.water_user_association_id = s.water_user_association_id
            WHERE pns.payment_notesheet_id = '" . $payment_notesheet_id . "'
            GROUP BY s.scheme_id, s.scheme_name
            ORDER BY s.scheme_id ASC";
                $schemes = $this->db->query($query)->result();

                if (!empty($schemes)) {
                    $count = 1;
                    foreach ($schemes as $scheme) {
                        $total_sanctioned += $scheme->sanctioned_cost;
                        $total_1st += $scheme->{'1st'};
                        $total_2nd += $scheme->{'2nd'};
                        $total_1st_2nd += $scheme->{'1st_2nd'};
                        $total_final += $scheme->{'final'};
                        $total_other += $scheme->{'other'};
                        $total_paid += $scheme->total_paid;
                        $total_balance += $scheme->remaining;
                        $total_whit += $scheme->whit;
                        $total_whst += $scheme->whst;
                        $total_st_duty += $scheme->st_duty;
                        $total_rdp += $scheme->rdp;
                        $total_kpra += $scheme->kpra;
                        $total_gur_ret += $scheme->gur_ret;
                        $total_misc_deduction += $scheme->misc_deduction;
                        $total_net_pay += $scheme->net_pay;
                        $total_recon += $scheme->recon;
                        $total_payment_amount += $scheme->payment_amount;
                        $total_payment_count += $scheme->payment_count;
                ?>
                     <tr>
                         <td>
                             <a onclick="return confirm('Are you sure you want to remove this Scheme?');" href="<?php echo site_url(ADMIN_DIR . 'payment_notesheets/remove/' . $scheme->pns_id . '/' . $payment_notesheet_id); ?>">X</a>
                         </td>
                         <td><?php echo $count++; ?></td>
                         <td><?php echo $scheme->scheme_code; ?></td>
                         <td><?php echo $scheme->scheme_status; ?></td>
                         <td><?php echo $scheme->scheme_name; ?></td>
                         <td><?php echo $scheme->payee_name ? $scheme->payee_name : $scheme->bank_account_title; ?></td>
                         <td><?php echo $scheme->category; ?></td>
                         <td><?php echo $scheme->financial_year; ?></td>
                         <td><?php echo number_format($scheme->sanctioned_cost, 2); ?></td>
                         <td><?php echo number_format($scheme->{'1st'}, 2); ?></td>
                         <td><?php echo number_format($scheme->{'2nd'}, 2); ?></td>
                         <td><?php echo number_format($scheme->{'1st_2nd'}, 2); ?></td>
                         <td><?php echo number_format($scheme->{'other'}, 2); ?></td>
                         <td><?php echo number_format($scheme->{'final'}, 2); ?></td>
                         <td><?php echo number_format($scheme->total_paid, 2); ?></td>
                         <td><?php echo number_format($scheme->remaining, 0); ?></td>
                         <td><?php echo $scheme->payment_type; ?></td>
                         <td><?php echo $scheme->payment_amount ? number_format($scheme->payment_amount) : ''; ?></td>
                         <td><?php echo number_format($scheme->whit, 2); ?></td>
                         <td><?php echo number_format($scheme->whst, 2); ?></td>
                         <td><?php echo number_format($scheme->kpra, 2); ?></td>
                         <td><?php echo number_format($scheme->st_duty, 2); ?></td>
                         <td><?php echo number_format($scheme->rdp, 2); ?></td>

                         <td><?php echo number_format($scheme->gur_ret, 2); ?></td>
                         <td><?php echo number_format($scheme->misc_deduction, 2); ?></td>
                         <td><?php echo number_format($scheme->net_pay, 2); ?></td>
                         <td>
                             <?php if ($scheme->recon != 0) { ?>
                                 <span style="color:red !important"><?php echo $scheme->recon; ?></span>
                             <?php } else { ?>
                                 <?php echo $scheme->recon; ?>
                             <?php } ?>
                         </td>
                         <td><?php echo $scheme->cheques; ?></td>
                         <td><?php echo $scheme->payment_count; ?></td>
                         <td>
                             <button class="btn <?php echo $scheme->payment_amount ? 'btn-success' : 'btn-warning'; ?> btn-sm" style="padding: 3px;" onclick="update_payment('<?php echo $scheme->pns_id; ?>')">
                                 <?php echo $scheme->payment_amount ? 'Edit Pay.' : 'Add Pay.'; ?>
                             </button>
                         </td>
                         <td>
                             <a class="btn btn-danger btn-sm" style="padding: 3px;" href="<?php echo site_url(ADMIN_DIR . 'payment_notesheets/scheme_invoices/' . $payment_notesheet_id . '/' . $scheme->pns_id . '/' . $scheme->scheme_id); ?>">Invoices</a>
                         </td>
                     </tr>
             <?php
                    }
                }
                ?>
         </tbody>
         <tfoot>
             <tr>
                 <th colspan="8" class="text-right">Total:</th>
                 <th><?php echo number_format($total_sanctioned, 2); ?></th>
                 <th><?php echo number_format($total_1st, 2); ?></th>
                 <th><?php echo number_format($total_2nd, 2); ?></th>
                 <th><?php echo number_format($total_1st_2nd, 2); ?></th>
                 <th><?php echo number_format($total_other, 2); ?></th>
                 <th><?php echo number_format($total_final, 2); ?></th>
                 <th><?php echo number_format($total_paid, 2); ?></th>
                 <th><?php echo number_format($total_balance, 2); ?></th>
                 <th></th> <!-- Payment Type -->
                 <th><?php echo number_format($total_payment_amount, 2); ?></th>
                 <th><?php echo number_format($total_whit, 2); ?></th>
                 <th><?php echo number_format($total_whst, 2); ?></th>
                 <th><?php echo number_format($total_kpra, 2); ?></th>
                 <th><?php echo number_format($total_st_duty, 2); ?></th>
                 <th><?php echo number_format($total_rdp, 2); ?></th>

                 <th><?php echo number_format($total_gur_ret, 2); ?></th>
                 <th><?php echo number_format($total_misc_deduction, 2); ?></th>
                 <th><?php echo number_format($total_net_pay, 2); ?></th>
                 <th><?php echo number_format($total_recon, 2); ?></th>
                 <th></th> <!-- Cheques -->
                 <th><?php echo $total_payment_count; ?></th>
                 <th colspan="2"></th>
             </tr>
         </tfoot>

     </table>
 </div>
 <script>
     function update_payment(id) {
         $.ajax({
                 method: "POST",
                 url: "<?php echo site_url(ADMIN_DIR . 'payment_notesheets/get_payment_update_form'); ?>",
                 data: {
                     id: id
                 },
             })
             .done(function(respose) {
                 $('#modal').modal('show');
                 $('#modal_title').html('Current Payment');
                 $('#modal_body').html(respose);
             });
     }
 </script>
 <?php $title = $payment_notesheet->payment_notesheet_code . ' -  ' . $payment_notesheet->district_name;  ?>
 <script>
     title = '<?php echo $payment_notesheet->payment_notesheet_code . ' -  ' . $payment_notesheet->district_name . '-' . date('d-m-Y m:h:s'); ?>';
     $('#data_table').DataTable({
         dom: 'Bfrtip',
         paging: false,
         title: title,
         //"order": [],
         "ordering": false,
         searching: true,
         buttons: [

             {
                 extend: 'print',
                 title: title,
                 messageTop: '<?php echo $title; ?>'

             },
             {
                 extend: 'excelHtml5',
                 title: title,
                 messageTop: '<?php echo $title; ?>'

             }

         ]
     });
 </script>