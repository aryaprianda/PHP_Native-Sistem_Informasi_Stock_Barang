<?php
require 'function.php';
require 'cek.php';

//get id barang
$idbarang = $_GET['id'];
$get = mysqli_query($conn,"select * from stock where idbarang='$idbarang'");
$fetch = mysqli_fetch_assoc($get);

$namabarang = $fetch['namabarang'];
$deskripsi = $fetch['deskripsi'];
$stock = $fetch['stock'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Detail Barang</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
        a{
            text-decoration:none;
            color: black;
        }
        <style>
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
        <div id="layoutSidenav">
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
                    <div class="container-fluid">
                    <div class="container text-center">
                        <h1 class="mt-4"><i class="far fa-folder-open"></i> Detail Barang</h1>
                        <br><br>
                    </div>

                    <div class="row ">
                        <div class="col-4">
                        <div class="card" style="width: 23rem;">
                        <div class="card-header bg-dark">
                            <font color="white"><h4>Deskripsi</h4></font>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">Nama Barang</div>
                                    <div class="col">: <?=$namabarang;?></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">Keterangan</div>
                                    <div class="col">: <?=$deskripsi;?></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">Stock</div>
                                    <div class="col">: <?=$stock;?></div>
                                </div> 
                            </li>
                        </ul>
                        </div>
                        </div>
                        <div class="col-8">
                        <div class="card mb-4">
                            <div class="card-header bg-dark">
                            <font color="white" class="text-center"><h4>Table Data</h4></font>
                            </div>
                            
                            <div class="card-body">
                            <h5>Barang Masuk</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="barangmasuk" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th>Quantity</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>


                                        <?php 
                                            $ambildatamasuk = mysqli_query($conn,"select * from masuk where idbarang='$idbarang'");
                                            $i=1;
                                            while ($fetch = mysqli_fetch_array($ambildatamasuk)){  
                                            $tanggal = $fetch['tanggal'];
                                            $keterangan = $fetch['keterangan'];
                                            $quantity = $fetch['qty'];    
                                         
                                        ?>

                                            <tr>
                                                
                                                <td><?=$i++;?></td>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$keterangan;?></td>
                                                <td><?=$quantity;?></td>
                                                
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="card-body">
                            <h5>Barang Keluar</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="barang keluar" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th>Quantity</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>


                                        <?php 
                                            $ambildatakeluar = mysqli_query($conn,"select * from keluar where idbarang='$idbarang'");
                                            $i=1;
                                            while ($fetch = mysqli_fetch_array($ambildatakeluar)){  
                                            $tanggal = $fetch['tanggal'];
                                            $penerima = $fetch['penerima'];
                                            $quantity = $fetch['qty'];    
                                         
                                        ?>

                                            <tr>
                                                
                                                <td><?=$i++;?></td>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$penerima;?></td>
                                                <td><?=$quantity;?></td>
                                                
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                        </div>
                    </div>
                        </div>
                    </div>



                   
                        
                </main>
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