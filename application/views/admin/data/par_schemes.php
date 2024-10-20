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

                 <?php 
                 $s_count=1;
                 foreach ($schemes as $scheme) { ?>
                 <li><?php echo $s_count++; ?> -
                     <?php echo $scheme->scheme_name ?> - <?php echo $scheme->component_category ?> -
                     <?php echo $scheme->district_name ?>
                     <table class="table table-bordered">
                         <?php 
                                    $query = "SELECT e.*, d.district_name, d.region, cc.category  FROM all_expenses as e 
                                    INNER JOIN districts as d ON(d.district_id = e.district_id)
                                    INNER JOIN component_categories as cc ON(cc.component_category_id = e.category_id)
                                    WHERE e.scheme_name  = '".$scheme->scheme_name."'
                                    AND e.category_id = '".$scheme->component_category_id."'
                                    AND e.district_id = '".$scheme->district_id."'";
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
                             <td><?php if($expense->whit>0){ echo number_format($expense->whit, 2); }else{ echo 0; }?>
                             </td>
                             <td><?php if($expense->whst>0){ echo number_format($expense->whst, 2); }else{ echo 0; }?>
                             </td>
                             <td><?php if($expense->st_duty>0){ echo number_format($expense->st_duty, 2); }else{ echo 0; }?>
                             </td>
                             <td><?php if($expense->rdp>0){ echo number_format($expense->rdp, 2); }else{ echo 0; }?>
                             </td>
                             <td><?php if($expense->kpra>0){ echo number_format($expense->kpra, 2); }else{ echo 0; }?>
                             </td>
                             <td><?php if($expense->gur_ret>0){ echo number_format($expense->gur_ret, 2); }else{ echo 0; }?>
                             </td>
                             <td><?php if($expense->misc_ded>0){ echo number_format($expense->misc_ded, 2); }else{ echo 0; }?>
                             </td>
                             <td><?php if($expense->net_total>0){ echo number_format($expense->net_total, 2); }else{ echo 0; }?>
                             </td>
                             <th>
                                 <?php if ($scheme->sanctioned_cost) echo round(($expense->net_total * 100) / $scheme->sanctioned_cost, 2) . " %"   ?>
                             </th>
                             <th><?php echo $expense->status; ?></th>
                         </tr>

                         <?php } ?>
                         <?php }else{
                                    echo 'No expenses.';
                                } ?>
                     </table>
                 </li>
                 <?php } ?>


                 </ol>
             </div>
         </div>

 </body>

 </html>