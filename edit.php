<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">   

    <title>edit page</title>
</head>
<body>
    <?php
    require 'function.php';
    $edit = new CRUD();
    $result = $edit->edit_data();
    
   ?> 
 
    <div class="container">
        <h1 class="page-header text-center"> PHP JSON FILE CRUD</h1>
        <div class="row">
            <div class="col-1"></div>
                <div class="col-8">
                    <a href="index.php">Back</a>
                    <form method="POST">
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Id</label>
                            <div class="col-sm-10">
                                <input type="text" id="id" name="id" class="form-control" value="<?php  echo $result->id; ?>">
                            </div>
                        </div>  

                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Login</label>
                            <div class="col-sm-10">
                                <input type="text" id="login" name="login" class="form-control" value="<?php echo $result->login; ?>">
                            </div>
                        </div>  

                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10 ">
                                <input type="text" id="p1" name="p1" class="form-control" value="<?php echo $result->password; ?>">
                            </div>
                        </div>  

                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">ConfirmPassword</label>
                            <div class="col-sm-10">
                                <input type="text" id="p2" name="p2" class="form-control" value="<?php echo $result->confirm_password; ?>">
                            </div>
                        </div>  

                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" id="email" name="email" class="form-control" value="<?php echo $result->email; ?>">
                            </div>
                        </div>  

                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" id="name" name="name" class="form-control" value="<?php echo $result->name; ?>">
                            </div>
                        </div>  

                        <button type="submit" name="save" class="btn btn-primary" onclick="edit_data()">Save</button>  
                    </form>
                </div>        
        </div>
    </div>
</body>
</html>
</body>
</html>