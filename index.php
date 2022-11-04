
<?php  
 $connect = mysqli_connect("localhost", "root", "", "testing");  
 $query = "SELECT * FROM tbl_order ORDER BY order_id desc"; 
 $result = mysqli_query($connect, $query); 
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>number of billing cycle between two dates</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 
  
</head>
<body>

    <div class="container" style="width:900px;">  <br>
        <h2 class="text-center">Number of billing cycle between two dates</h2>  
        <h3 class="text-center">Order Data</h3><br />  
        <div class="col-md-3">  
            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  
        </div>  <br>
        <div class="col-md-3">  
            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
        </div> <br> 
        <div class="col-md-5">  
            <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />  
        </div>  
        <div style="clear:both"></div>
        <br>
        <div class="order_table">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 5%">ID</th>
                    <th style="width: 30%">Cunstomer Name</th>
                    <th style="width: 25%">Item</th>
                    <th style="width: 15%">Value</th>
                    <th style="width: 40%">Order Date </th>
                </tr>

                <?php
                while ($row = mysqli_fetch_array($result))
                {
                    ?>
                        <tr>
                            <td><?php echo $row["order_id"]; ?></td>  
                            <td><?php echo $row["order_customer_name"]; ?></td>  
                            <td><?php echo $row["order_item"]; ?></td>  
                            <td>₹ <?php echo $row["order_value"]; ?></td>  
                            <td><?php echo $row["order_date"]; ?></td>
                        </tr>
                    <?php

                }
                ?>
            </table>
        </div>                 
           
                 
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           });  
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"filter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#order_table').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      });  
 </script>
</body>
</html>