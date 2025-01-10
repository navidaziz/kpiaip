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
                 <th>Pre. Payment</th>
                 <th>Pre. Cheques</th>
                 <th>Payable Rs</th>
                 <th>Sanctioned Cost</th>
                 <th>Lining</th>
                 <th>1st</th>
                 <th>2nd</th>
                 <th>1st_2nd</th>
                 <th>Final</th>
                 <th>Other</th>
                 <th>Current Payment</th>
                 <th>WHIT</th>
                 <th>WHST</th>
                 <th>Net Rs.</th>

             </tr>
         </thead>
         <tbody>
             <?php

                $query = "
                            SELECT 
                                s.scheme_id,
                                s.scheme_name,
                                e.payee_name,
                                cc.category,
                                wua.bank_account_title,
                                pns.id as pns_id,
                                s.lining_length,
                                SUM(e.gross_pay) as `Pre. Payment`,
                                (SUM(e.gross_pay) - s.sanctioned_cost) as `Payable Rs`,
                                (s.sanctioned_cost) as `Sanctioned Cost`,
                                MAX(CASE WHEN e.installment = '1st' THEN e.gross_pay END) AS `1st`,
                                MAX(CASE WHEN e.installment = '2nd' THEN e.gross_pay END) AS `2nd`,
                                MAX(CASE WHEN e.installment = '1st_2nd' THEN e.gross_pay END) AS `1st_2nd`,
                                MAX(CASE WHEN e.installment = 'final' THEN e.gross_pay END) AS `final`,
                                MAX(CASE WHEN e.installment IS NULL THEN e.gross_pay END) AS `other`,
                                GROUP_CONCAT(e.cheque ORDER BY e.installment SEPARATOR ', ') AS `cheques`
                            FROM 
                                schemes s
                                INNER JOIN component_categories as cc ON cc.component_category_id = s.component_category_id
                                INNER JOIN payment_notesheet_schemes as pns ON(pns.scheme_id = s.scheme_id)
                                LEFT JOIN expenses e ON s.scheme_id = e.scheme_id
                                INNER JOIN water_user_associations as wua ON(wua.water_user_association_id = s.water_user_association_id)
                                WHERE pns.payment_notesheet_id = '" . $payment_notesheet_id . "'
                            GROUP BY 
                                s.scheme_id, s.scheme_name 
                                LIMIT 10;";
                $schemes = $this->db->query($query)->result();

                if (!empty($schemes)): ?>
                 <?php
                    $count = 1;
                    foreach ($schemes as $scheme): ?>
                     <tr>
                         <td><a href="<?php echo site_url(ADMIN_DIR . "payment_notesheets/remove/" . $scheme->pns_id . '/' . $payment_notesheet_id); ?>">Remove</a> </td>
                         <td><?php echo $count++ ?></td>
                         <td><?php echo $scheme->scheme_id; ?></td>
                         <td><?php echo $scheme->scheme_name; ?></td>
                         <td><?php
                                if ($scheme->payee_name) {
                                    echo $scheme->payee_name;
                                } else {
                                    echo $scheme->bank_account_title;
                                }
                                ?></td>
                         <td><?php echo $scheme->category; ?></td>
                         <td><?php echo number_format($scheme->{'Pre. Payment'}, 2); ?></td>
                         <td><?php echo $scheme->cheques; ?></td>
                         <td><?php echo number_format($scheme->{'Payable Rs'}, 2); ?></td>
                         <td><?php echo number_format($scheme->{'Sanctioned Cost'}, 2); ?></td>
                         <td><?php echo $scheme->lining_length; ?></td>
                         <td><?php echo number_format($scheme->{'1st'}, 2); ?></td>
                         <td><?php echo number_format($scheme->{'2nd'}, 2); ?></td>
                         <td><?php echo number_format($scheme->{'1st_2nd'}, 2); ?></td>
                         <td><?php echo number_format($scheme->{'final'}, 2); ?></td>
                         <td><?php echo number_format($scheme->{'other'}, 2); ?></td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td></td>

                     </tr>
                 <?php endforeach; ?>
             <?php else: ?>
                 <tr>
                     <td colspan="13" class="text-center">No data available</td>
                 </tr>
             <?php endif; ?>
         </tbody>
     </table>
 </div>
 <?php $title = $payment_notesheet->payment_notesheet_code . ' -  ' . $payment_notesheet->district_name;  ?>
 <script>
     title = '<?php echo $payment_notesheet->payment_notesheet_code . ' -  ' . $payment_notesheet->district_name . '-' . date('d-m-Y m:h:s'); ?>';
     $('#data_table').DataTable({
         dom: 'Bfrtip',
         paging: false,
         title: title,
         "order": [],
         "ordering": true,
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