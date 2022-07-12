<?php
require '../model/addressbook.php';
require '../model/allcities.php';
session_start();
$details = isset($_SESSION['sporttbl0'])
    ? unserialize($_SESSION['sporttbl0'])
    : new addressbook();
    $res = isset($_SESSION['spotbCities'])
    ? unserialize($_SESSION['spotbCities'])
    : new allcities();
   
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="../libs/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Add Details</h2>
                    </div>
                    <p>Please fill this form and submit to add details record in the database.</p>
                    <form action="../index.php?act=add" method="post" >


                        <!-- first field -->
                        <div class="form-group <?php echo !empty(
                            $details->name_msg
                        )
                            ? 'has-error'
                            : ''; ?>">
                            <label>Category</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $details->name; ?>" required> 
                        </div>



                        <!-- second field -->
                        <div class="form-group <?php echo !empty(
                            $details->firstname_msg
                        )
                            ? 'has-error'
                            : ''; ?>">
                            <label>Name</label>
                            <input name="firstname" class="form-control" value="<?php echo $details->firstname; ?>" required> 
                        </div>


                        <!-- second field -->
                        <div class="form-group <?php echo !empty(
                            $details->email_msg
                        )
                            ? 'has-error'
                            : ''; ?>">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $details->email; ?> " required> 
                        </div>



                        <!-- fourth field -->
                         <div class="form-group <?php echo !empty(
                            $details->street_msg
                        )
                            ? 'has-error'
                            : ''; ?>">
                            <label>Street Name</label>
                            <input name="street" class="form-control" value="<?php echo $details->street; ?>" required> 
                        </div>



                        <!-- fifth field -->
                         <div class="form-group <?php echo !empty(
                            $details->zip_code_msg
                        )
                            ? 'has-error'
                            : ''; ?>">
                            <label>zip_code</label>
                            <input name="zip_code" type="number" class="form-control" value="<?php echo $details->zip_code; ?>" required> 
                        </div>


                         <!-- last field -->
                         <div class="form-group <?php echo !empty(
                            $details->zip_code_msg
                        )
                            ? 'has-error'
                            : ''; ?>">
                            <label>city</label>
                            <input name="city" class="form-control" value="<?php echo $details->city; ?>">
                            <span class="help-block"><?php echo $details->city_msg; ?></span>
                        </div> 


                        <!-- submit form -->
                        <input type="submit" name="addbtn" class="btn btn-primary" value="Submit">
                        <a href="../index.php" class="btn btn-default">Cancel</a>
                    </form>

                     
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
       