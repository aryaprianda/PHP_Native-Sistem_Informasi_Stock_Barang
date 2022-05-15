<?php
require 'function.php';
require 'cek.php';
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
        <title>Beranda</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
        a{
            text-decoration:none;
            color: black;
        }
        body{
            background-color: white;
        }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">Sistem Gudang </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-10">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <?php
                            $level = $_SESSION['level'] == 'admin';
                            if($level){
                            ?>
                        <a class="dropdown-item" href="admin.php">Settings</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                        <?php } else { ?>  
                        <a class="dropdown-item" href="logout.php">Logout</a>
                        <?php } ?>

                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav" class="">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="beranda.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Beranda
                            </a>
                            <div class="sb-sidenav-menu-heading">Data</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsemaster" aria-expanded="false" aria-controls="collapsemaster">
                                <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
                                Data Master
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsemaster" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="index.php">Data Barang</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                                Transaksi
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="masuk.php">Barang Masuk</a>
                                    <a class="nav-link" href="keluar.php">Barang Keluar</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapselaporan" aria-expanded="false" aria-controls="collapselaporan">
                                <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                                Laporan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            
                            <div class="collapse" id="collapselaporan" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="index_export.php">Stock Barang</a>
                                    <a class="nav-link" href="masuk_export.php">Barang Masuk</a>
                                    <a class="nav-link" href="keluar_export.php">Barang Keluar</a>
                                </nav>
                            </div>
                           
                    <div class="sb-sidenav-footer">
                        <?php 
                        $ambildatalogin = mysqli_query($conn, "select * from login");
                        $data = mysqli_fetch_array($ambildatalogin);
                        $email = $data['email'];
                        $level = $data['level'];?>
                        <div class="small">Masuk Sebagai :
                        <font color="yellow"><?=$level;?></font>
                        </div>    
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid mt-4">
                        
                            <div class="container text-left">
                            <h1 ><i class="fas fa-home"></i> Beranda</h1>
                            </div>
                       <br>
                       <div class="container">
                       <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="card text-white mb-4" style="background-color:#00c0ef;color:#fff">
                                    <div class="row">
                                        <div class="col-4 mt-3 ml-5">
                                        <font size="7"><strong><?=$jumlahstock?></strong></font>
                                        </div>
                                        <div class="col mt-1">
                                             <h1 class="display-2"><i class="fa fa-folder"></i></h1>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="medium text-white stretched-link" href="index.php">Data Barang</a>
                                        <div class="medium text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4">
                                <div class="card text-white mb-4" style="background-color:#00a65a;color:#fff">
                                    <div class="row">
                                        <div class="col-4 mt-3 ml-5">
                                        <font size="7"><strong><?=$jumlahmasuk;?></strong></font>
                                        </div>
                                        <div class="col mt-1">
                                             <h1 class="display-2"><i class="fas fa-folder-plus"></i></h1>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="medium text-white stretched-link" href="masuk.php">Barang Masuk</a>
                                        <div class="medium text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3  col-md-4">
                                <div class="card text-white mb-4" style="background-color:#dd4b39;color:#fff">
                                    <div class="row">
                                        <div class="col-4 mt-3 ml-5">
                                        <font size="7"><strong><?=$jumlahkeluar;?></strong></font>
                                        </div>
                                        <div class="col mt-1">
                                             <h1 class="display-2"><i class="fas fa-folder-minus"></i></i></h1>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="medium text-white stretched-link" href="keluar.php">Barang Keluar</a>
                                        <div class="medium text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3  col-md-4">
                                <div class="card text-white mb-4" style="background-color:#f39c12;color:#fff">
                                    <div class="row">
                                        <div class="col-4 mt-3 ml-5">
                                        <font size="7"><strong><?=$jumlahuser;?></strong></font>
                                        </div>
                                        <div class="col mt-1">
                                             <h1 class="display-2"><i class="fas fa-user"></i></h1>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="medium text-white stretched-link" href="#">User</a>
                                        <div class="medium text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                       </div>
                        


                        <br>
                        <div class="container">
                        <div class="row"  >
                            <div class="col-lg-12 col-xs-12">
                                <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h5 class="box-title"><i class="fa fa-info-circle icon-title"></i> Stok Barang telah mencapai batas minimum</h5>
                                </div>
                                <br>
                                <div class="box-body table-hover">
                                    <div class="table-responsive">
                                    <!-- tampilan tabel barang -->
                                    <table class="table no-margin">
                                        <!-- tampilan tabel header -->
                                        <thead>
                                        
                                        <tr>
                                            <th class="center">No.</th>
                                            <th class="center">Nama Barang</th>
                                            <th>Deskripsi</th>
                                            <th>Stock</th>
                                        </tr>
                                        </thead>
                                        <!-- tampilan tabel body -->
                                        <tbody>
                                        <?php 
                                            $ambildatastock = mysqli_query($conn,"select * from stock where stock < 10");
                                            $i=1;
                                            while ($fetch=mysqli_fetch_array($ambildatastock)){ 
                                            $baranghndkhabis = $fetch['namabarang'];
                                            $deskripsihndkhabis = $fetch['deskripsi'];
                                            $stockhndkhabis = $fetch['stock']
                                        ?>
                                            <tr>
                                                
                                                <td><?=$i++;?></td>
                                                <td><?=$baranghndkhabis;?></td>
                                                <td><?=$deskripsihndkhabis;?></td>
                                                <td><?=$stockhndkhabis;?></td>
                                                
                                                
                                            </tr>

                                       
                                        <?php
                                        };
                                        ?>


                                                        </tbody>
                                    </table>
                                    </div>
                                </div><!-- /.box-body -->
                                </div><!-- /.box -->
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
    <br>
    <br>
    <br>
    <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
            <div class="modal-body">
                <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
                <br>
                <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required>
                <br>
                <input type="number" name="stock" placeholder="Stock" class="form-control" required>
                <br>
                <button type="submit" class="btn btn-primary" name="addnewbarang"> Submit </button>
            </div>
        </form>
       
      </div>
    </div>
  </div>


</html>