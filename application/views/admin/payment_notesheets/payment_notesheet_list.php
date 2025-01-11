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
                 <th>Scheme Name</th>
                 <th>Title of A/C (as per record)</th>
                 <th>Cat:</th>
                 <th>Financial Year</th>
                 <th>Sanctioned Cost</th>
                 <th>Payment Count</th>
                 <th>1st</th>
                 <th>2nd</th>
                 <th>1st_2nd</th>
                 <th>Final</th>
                 <th>Other</th>
                 <th>Total Paid</th>
                 <th>Remaining Amount</th>
                 <th>Payment Request</th>
                 <th>Payment Amount</th>
                 <th>WHIT</th>
                 <th>WHST</th>
                 <th>Net Rs.</th>
                 <th>Pre. Cheques</th>
                 <th></th>

             </tr>
         </thead>
         <tbody>
             <?php

                $query = "
                            SELECT 
                                s.scheme_id,
                                s.scheme_code,
                                s.scheme_name,
                                e.payee_name,
                                fy.financial_year,
                                cc.category,
                                wua.bank_account_title,
                                pns.id as pns_id,
                                pns.payment_amount,
                                pns.whit,
                                pns.whst,
                                pns.net_pay,
                                pns.payment_type,
                                s.lining_length,
                                SUM(e.gross_pay) as `total_paid`,
                                COUNT(e.expense_id) as `payment_count`,
                                (s.sanctioned_cost) as `sanctioned_cost`,
                                SUM(CASE WHEN e.installment = '1st' THEN e.gross_pay END) AS `1st`,
                                SUM(CASE WHEN e.installment = '2nd' THEN e.gross_pay END) AS `2nd`,
                                SUM(CASE WHEN e.installment = '1st_2nd' THEN e.gross_pay END) AS `1st_2nd`,
                                SUM(CASE WHEN e.installment = 'final' THEN e.gross_pay END) AS `final`,
                                SUM(CASE WHEN e.installment IS NULL THEN e.gross_pay END) AS `other`,
                                GROUP_CONCAT(e.cheque ORDER BY e.installment SEPARATOR ', ') AS `cheques`
                            FROM 
                                schemes s
                                INNER JOIN component_categories as cc ON cc.component_category_id = s.component_category_id
                                INNER JOIN payment_notesheet_schemes as pns ON(pns.scheme_id = s.scheme_id)
                                INNER JOIN financial_years as fy ON(fy.financial_year_id = s.financial_year_id)
                                LEFT JOIN expenses e ON s.scheme_id = e.scheme_id
                                INNER JOIN water_user_associations as wua ON(wua.water_user_association_id = s.water_user_association_id)
                                WHERE pns.payment_notesheet_id = '" . $payment_notesheet_id . "'
                            GROUP BY 
                                s.scheme_id, s.scheme_name
                            ORDER BY id ASC    
                                ";
                $schemes = $this->db->query($query)->result();

                if (!empty($schemes)): ?>
                 <?php
                    $count = 1;
                    foreach ($schemes as $scheme): ?>
                     <tr>
                         <td>
                             <a
                                 onclick="return confirm('Are you sure you want to remove this Scheme?');"
                                 href="<?php echo site_url(ADMIN_DIR . 'payment_notesheets/remove/' . $scheme->pns_id . '/' . $payment_notesheet_id); ?>">
                                 X
                             </a>

                         </td>
                         <td><?php echo $count++ ?></td>
                         <td><?php echo $scheme->scheme_code; ?></td>
                         <td><?php echo $scheme->scheme_name; ?></td>
                         <td><?php
                                if ($scheme->payee_name) {
                                    echo $scheme->payee_name;
                                } else {
                                    echo $scheme->bank_account_title;
                                }
                                ?></td>
                         <td><?php echo $scheme->category; ?></td>
                         <td><?php echo $scheme->financial_year; ?></td>
                         <td><?php echo number_format($scheme->{'sanctioned_cost'}, 2); ?></td>
                         <td><?php echo $scheme->payment_count ?></td>
                         <td><?php echo number_format($scheme->{'1st'}, 2); ?></td>
                         <td><?php echo number_format($scheme->{'2nd'}, 2); ?></td>
                         <td><?php echo number_format($scheme->{'1st_2nd'}, 2); ?></td>
                         <td><?php echo number_format($scheme->{'final'}, 2); ?></td>
                         <td><?php echo number_format($scheme->{'other'}, 2); ?></td>
                         <td><?php echo number_format($scheme->{'total_paid'}, 2); ?></td>
                         <td><?php
                                $remaining = ($scheme->sanctioned_cost - $scheme->total_paid);
                                echo number_format($remaining, 0);
                                ?></td>
                         <td><?php
                                echo $scheme->payment_type;
                                //echo getOrdinal($scheme->payment_count + 1) 
                                ?></td>

                         <td>
                             <?php if ($scheme->payment_amount) { ?>
                                 <?php echo $scheme->payment_amount; ?>
                             <?php } else { ?>
                                 <button onclick="update_payment('<?php echo $scheme->pns_id; ?>')">Add Payment<botton>
                                     <?php } ?>
                         </td>
                         <td><?php echo $scheme->whit; ?></td>
                         <td><?php echo $scheme->whst; ?></td>
                         <td><?php echo $scheme->net_pay; ?></td>
                         <td><?php echo $scheme->cheques; ?></td>
                         <td>
                             <?php if ($scheme->payment_amount) { ?>
                                 <button onclick="update_payment('<?php echo $scheme->pns_id; ?>')">Update Payment<botton>
                                     <?php }  ?>
                         </td>

                     </tr>
                 <?php endforeach; ?>
             <?php else: ?>

             <?php endif; ?>
         </tbody>
         <tfoot>
             <?php

                $query = "
                            SELECT 
                                pns.id as pns_id,
                                SUM(pns.payment_amount) as payment_amount,
                                SUM(pns.whit) as whit,
                                SUM(pns.whst) as whst,
                                SUM(pns.net_pay) as net_pay
                                
                            FROM payment_notesheet_schemes as pns 
                                WHERE pns.payment_notesheet_id = '" . $payment_notesheet_id . "' ";
                $scheme = $this->db->query($query)->row();

                if (!empty($scheme)): ?>

                 <tr>
                     <td>


                     </td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <th>Total</th>
                     <th><?php echo $scheme->payment_amount; ?></th>
                     <th><?php echo $scheme->whit; ?></th>
                     <th><?php echo $scheme->whst; ?></th>
                     <th><?php echo $scheme->net_pay; ?></th>
                     <th></th>
                     <th></th>

                 </tr>
             <?php else: ?>

             <?php endif; ?>

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

             },
             // {
             //     extend: 'pdfHtml5',
             //     title: title,
             //     pageSize: 'A4',
             //     //orientation: 'landscape',
             //     messageTop: '<?php echo $title; ?>'

             // }
         ]
     });
 </script>