 <!DOCTYPE html>
 <html lang="en">

 <head>
     <title>Bootstrap Example</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 </head>

 <body>

     <div class="jumbotron text-center">
         <h1>Data Correction</h1>
     </div>

     <div class="container">
         <div class="row">
             <div class="col-sm-12">
                 <ol> <?php foreach ($wuas as $wua) { ?>
                     <li>
                         <ol><?php echo $wua->wua_name; ?>
                             <?php foreach ($wua->schemes as $scheme) { ?>
                             <li>
                                 <?php echo $scheme->scheme_name ?>
                                 <table class="table table-bordered">
                                     <?php 
                            $query = "SELECT e.*,fy.financial_year, d.district_name, d.region, cc.category  FROM expenses as e 
                            INNER JOIN financial_years as fy ON(fy.financial_year_id = e.financial_year_id)
                            INNER JOIN districts as d ON(d.district_id = e.district_id)
                            INNER JOIN component_categories as cc ON(cc.component_category_id = e.component_category_id)
                            WHERE scheme_id = $scheme->scheme_id";
                            $expenses = $this->db->query($query)->result();
                            $count=1;
                            if($expenses){
                            foreach($expenses as $expense){ ?>
                                     <tr>
                                     <tr>

                                         <td><?php echo $count++; ?></td>

                                         <td><?php echo $expense->category; ?></td>
                                         <td><?php echo $expense->cheque; ?></td>
                                         <td><?php echo date('d-m-Y', strtotime($expense->date)); ?></td>
                                         <td><small><i><?php echo $expense->payee_name; ?></i></small></td>
                                         <td><?php if($expense->gross_pay>0){ echo number_format($expense->gross_pay, 2); }else{ echo 0; }?>
                                         </td>
                                         <td><?php if($expense->whit_tax>0){ echo number_format($expense->whit_tax, 2); }else{ echo 0; }?>
                                         </td>
                                         <td><?php if($expense->whst_tax>0){ echo number_format($expense->whst_tax, 2); }else{ echo 0; }?>
                                         </td>
                                         <td><?php if($expense->st_duty_tax>0){ echo number_format($expense->st_duty_tax, 2); }else{ echo 0; }?>
                                         </td>
                                         <td><?php if($expense->rdp_tax>0){ echo number_format($expense->rdp_tax, 2); }else{ echo 0; }?>
                                         </td>
                                         <td><?php if($expense->kpra_tax>0){ echo number_format($expense->kpra_tax, 2); }else{ echo 0; }?>
                                         </td>
                                         <td><?php if($expense->gur_ret>0){ echo number_format($expense->gur_ret, 2); }else{ echo 0; }?>
                                         </td>
                                         <td><?php if($expense->misc_deduction>0){ echo number_format($expense->misc_deduction, 2); }else{ echo 0; }?>
                                         </td>
                                         <td><?php if($expense->net_pay>0){ echo number_format($expense->net_pay, 2); }else{ echo 0; }?>
                                         </td>
                                         <th>
                                             <?php if ($scheme->sanctioned_cost) echo round(($expense->net_pay * 100) / $scheme->sanctioned_cost, 2) . " %"   ?>
                                         </th>
                                         <th><?php echo $expense->cheq_status; ?></th>
                                     </tr>

                                     <?php } ?>
                                     <?php }else{
                                    echo 'No expenses.';
                                } ?>
                                 </table>
                             </li>
                             <?php } ?>
                         </ol>
                     </li>
                     <?php } ?>

                 </ol>
             </div>
         </div>

 </body>

 </html>