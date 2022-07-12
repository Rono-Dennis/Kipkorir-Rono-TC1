<?php 
require '../model/addressbook.php'; 

session_start();
$res = isset($_SESSION['serialization'])
    ? unserialize($_SESSION['serialization'])
    : new addressbook(); 
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Address Book</title>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="../libs/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="row">
            <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="page-header">
                        <h4>Add Details</h4>
                    </div>
                    <!-- <p>Please fill this form and submit to add details record in the database.</p> -->
                    <form action="../index.php?act=add" method="post" >


                        <!-- first field -->
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control"> 
                        </div>


                        <!-- second field -->
                        <div class="form-group">
                            <label>FistName</label>
                            <input name="firstname" type ="text" class="form-control"> 
                        </div>


                        <!-- third field -->
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" type ="text" class="form-control"> 
                        </div>


                        <!-- fourth field -->
                         <div class="form-group">
                            <label>Street Name</label>
                            <input name="street" type ="text" class="form-control"> 
                        </div>



                        <!-- fifth field -->
                         <div class="form-group">
                            <label>zip_code</label>
                            <input type ="number" name="zip_code" class="form-control"> 
                        </div>


                         <!-- last field -->
                        <div class="form-group">
                            <label for="text">City</label>
                            <select name="city" class="form-control" placeholder="Select your city">
                                <?php 
                                for($i=0; $i<count($res); $i++){?>
                                    <option value= "<?php echo $res[$i]?>">
                                    <?php echo $res[$i]?>
                                    </option>
                                <?php }?>   
                            </select>
                        </div>


                        <!-- submit form -->
                        
                        <input type="submit" name="addbtn" class="btn btn-primary" value="Submit">
                        <a href="../index.php" class="btn btn-default">Cancel</a>
                    </form>

                     
            </div>
            <div class="col-md-4"></div>
            </div>        
        </div>
    </div>
</body>
</html>
       