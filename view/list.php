<?php session_unset();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="~/../libs/fontawesome/css/font-awesome.css" rel="stylesheet" />    
    <link rel="stylesheet" href="~/../libs/bootstrap.css"> 
    <script src="~/../libs/jquery.min.js"></script>
    <script src="~/../libs/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <!-- <a href="index.php" class="btn btn-success pull-left">Home</a> -->
                        <h2 class="pull-left">Addressbook Details</h2>
                        <?php echo '<a href="index.php?act=addNewItem" class="btn btn-success pull-right">';?>
                        Add New Addressbook details</a>
                    </div>
                </div>

                <?php if($exported=='1'){?>
                <div class="col-md-12">
                <div class ="alert alert-success">
                        <p>Export Data To JSON Successfully</p>
                    </div>
                </div>
                <?php }?>
                <?php if($exported=='2'){?>
                <div class="col-md-12">
                    <div class ="alert alert-fail">
                        <p>Failed To Export Data To JSON, Try Again!!</p>
                    </div>
                </div>
                <?php }?>
                <?php if($exported=='3'){?>
                <div class="col-md-12">
                <div class ="alert alert-success">
                        <p>Export Data To XML Successfully</p>
                    </div>
                </div>
                <?php }?>
                <?php if($exported=='4'){?>
                <div class="col-md-12">
                    <div class ="alert alert-fail">
                        <p>Failed To Export Data To XML, Try Again!!</p>
                    </div>
                </div>
                <?php }?>
 

            </div>



            <form action="<?php echo "index.php?act=exportData"?>" method="post">  
            <div class="row">  
                <div class="btn-toolbar">
                    <a href="index.php?act=exportToJson" class="btn btn-primary btn-sm">Export To Json</a>                      &nbsp;&nbsp;&nbsp;
                    <a href="index.php?act=exportToXML" class="btn btn-primary btn-sm">Export To XML</a>   
                </div>
            </div>  
            <div class="row" style="text-align:center; padding : 5px 5px 5px 5px"></div>  
            </form>


            <div class="row">
                <div class="col-md-12">
                    <?php
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";                                        
                                        echo "<th>Name</th>";
                                        echo "<th>FirstName</th>";
                                        echo "<th>Email</th>";
                                         echo "<th>Street</th>";
                                         echo "<th>zip_code</th>";
                                         echo "<th>city</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";                                        
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['firstname'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['street'] . "</td>";
                                        echo "<td>" . $row['zip_code'] . "</td>";
                                        echo "<td>" . $row['city'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='index.php?act=update&id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><i class='fa fa-edit'></i></a>";
                                        echo "<a href='index.php?act=delete&id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><i class='fa fa-trash'></i></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>