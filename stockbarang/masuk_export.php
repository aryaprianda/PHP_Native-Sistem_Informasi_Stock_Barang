<?php
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Laporan Barang Masuk</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
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
                <div class="container-fluid mt-4">
                    <div class="container text-center">
                    <section class="content-header">
                    <h1>
                    <i class="far fa-folder"></i> Barang Masuk
                    </section>
                    </div>
                        <br>
                        <div class="card mb-4">
                            <div class="card-header">
                            <marquee behavior="alternate">Hubungi Admin Untuk Menambah Atau Melakukan Perubahan Pada Barang</marquee> 
                            <br><br>
                            <div class="row mt-4">
                                <div class="col">
                                    <form method="post" class="form-inline">
                                        <input type="date" name="tgl_mulai" class="form-control">
                                        <input type="date" name="tgl_selesai" class="form-control ml-3">
                                        <button type="sumbit" name="filter_tgl" class="btn btn-dark ml-3">Filter</button>
                                    </form>
                                </div>
                                <a href="export_masuk.php" class="btn btn-dark mb-3">Export Data</a>
                            </div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>tanggal</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                           
                                        <?php

                                        if(isset($_POST['filter_tgl'])){
                                            $mulai = $_POST['tgl_mulai'];
                                            $selesai = $_POST['tgl_selesai'];

                                            if($mulai!=null || $selesai!=null){
                                                $ambilsemuadatastock = mysqli_query($conn, "select * from masuk m, stock s where s.idbarang = m.idbarang and tanggal BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 0 DAY)");
                                            }else {
                                                $ambilsemuadatastock = mysqli_query($conn, "select * from masuk m, stock s where s.idbarang = m.idbarang");
                                            }

                                        } else {
                                            $ambilsemuadatastock = mysqli_query($conn, "select * from masuk m, stock s where s.idbarang = m.idbarang");
                                        }   
                                            while($data = mysqli_fetch_array($ambilsemuadatastock)){ 
                                                $idb = $data['idbarang'];
                                                $idm = $data['idmasuk'];
                                                $tanggal = $data['tanggal'];
                                                $namabarang = $data['namabarang'];
                                                $qty = $data['qty'];
                                                $keterangan = $data['keterangan'];
                                                                      
                                        ?>
                                           <tr>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td><?=$qty;?></td>
                                                <td><?=$keterangan;?></td>
                                                
                                            </tr>

                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="edit<?=$idm;?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                        <h4 class="modal-title">Edit Barang</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <input type="text" name="keterangan" value="<?=$keterangan;?>" class="form-control" required>
                                                                <br>
                                                                <input type="number" name="qty" value="<?=$qty;?>" class="form-control" disabled>
                                                                <br>
                                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                                <input type="hidden" name="idm" value="<?=$idm;?>">
                                                                <button type="submit" class="btn btn-primary" name="updatebarangmasuk"> Submit </button>
                                                            </div>
                                                        </form>
                                                    
                                                    </div>
                                                    </div>
                                                </div>


                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete<?=$idm;?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Barang</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus <font color="red"><?=$namabarang;?></font>?
                                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                                <input type="hidden" name="kty" value="<?=$qty;?>">
                                                                <input type="hidden" name="idm" value="<?=$idm;?>">
                                                                <br>
                                                                <br>
                                                                <button type="submit" class="btn btn-danger" name="hapusbarangmasuk"> Hapus </button>
                                                            </div>
                                                        </form>
                                                    
                                                    </div>
                                                    </div>
                                                </div>


                                        <?php
                                        };
                                        ?>
                                            
                                        </tbody>
                                    </table>
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
          <h4 class="modal-title">Tambah Barang Masuk</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
            <div class="modal-body">
                <select name="barangnya" class="form-control">
                    <?php
                        $ambilsemuadatanya = mysqli_query($conn, "select * from stock");
                        while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                            $namabarangnya = $fetcharray['namabarang'];
                            $idbarangnya = $fetcharray['idbarang'];

                    ?>

                    <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>
                
                    <?php                           
                        }
                    ?> 
                </select>
                <br>
                <input type="number" name="qty" placeholder="Quantity" class="form-control" required>
                <br>
                <input type="text" name="penerima" placeholder="Keterangan" class="form-control" required>
                <br>
                <input type="date" name="tanggal" class="form-control" required>
                <br>
                <button type="submit" class="btn btn-primary" name="barangmasuk"> Submit </button>
            </div>
        </form>
       
      </div>
    </div>
  </div>

</html>
