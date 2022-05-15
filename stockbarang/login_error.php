<?php
require 'function.php'; 



//cek
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    $cekdatabase = mysqli_query($conn,"SELECT * FROM  login where email='$email' and password='$password'");

    $hitung = mysqli_num_rows($cekdatabase);

    if($hitung>0){
        $_SESSION['log'] = 'True';
        header('location:beranda.php');
    } else { 
        header('location:login.php');
    };
};

if(!isset($_SESSION['log'])){

} else {
    header('location:beranda.php');
}



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <script src="https://kit.fontawesome.com/1aae66e82c.js" crossorigin="anonymous"></script>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Page Title - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-dark">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                    <br><br>
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"><i class="fas fa-user"></i> Silahkan Login</h3></div>
                                    <div class='alert alert-danger alert-dismissable'>
                                        
                                        <h4>  <i class='icon fa fa-times-circle'></i> Gagal Login!</h4>
                                        Username atau Password salah, cek kembali Username dan Password Anda.
                                    </div>
                                    <div class="card-body">
                                        <form method="post" autocomplete="off"> 
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" name="email" id="inputEmailAddress" type="email" placeholder="Masukan Email" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Masukan Password" />
                                            </div>
                                            
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                               
                                                <button class="btn btn-dark" name="login">Masuk</button>
                                            </div>
                                        </form>


                                       


                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
