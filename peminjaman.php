<?php
require 'function.php';
require 'cek.php';

$get1 = mysqli_query($conn,"select * from peminjaman");
$count1 = mysqli_num_rows($get1); //menghitung seluruh colom

//ambil data peminjaman yang statusnya dipinjam 
$get2 = mysqli_query($conn,"select * from peminjaman where status='Dipinjam'");
$count2 = mysqli_num_rows($get2); //menghitung seluruh colom yangg statusnya dipinjam

//ambil data pemninjaman yang statusnya kembali
$get3 = mysqli_query($conn,"select * from peminjaman where status='kembali'");
$count3 = mysqli_num_rows($get3); //menghitung seluruh colom
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Peminjaman Barang</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
          <style>
              .zommable{
                width: 100px;
              }
              .zommable:hover{
                transform: scale(2.5);
                transition: 0.3s ease;
              }
          </style>

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Inventory</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <!-- <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button> -->
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                                Stok Barang
                            </a>

                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                                Barang Masuk
                            </a>

                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-shipping-fast"></i></div>
                                Barang Keluar
                            </a>

                            <a class="nav-link" href="peminjaman.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-hand-holding"></i></div>
                                Peminjaman Barang
                            </a>

                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-cog"></i></div>
                                Kelola Admin
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Peminjaman Barang</h1>

                        <div class="card mb-4">
                            <div class="card-header">
                               
                             <!-- Button to Open the Modal -->
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Data
                              </button>
                              <br>
                              <div class="row mt-4">
                                <div class="col">
                                  <div class="card bg-info text-white" align="center">
                                    Total Data: <?=$count1;?>
                                  </div>
                                </div>
                                <div class="col">
                                  <div class="card bg-danger text-white" align="center">
                                    Total Dipinjam: <?=$count2;?>
                                  </div>
                                </div>
                                <div class="col">
                                  <div class="card bg-success text-white" align="center">
                                    Total Kembali: <?=$count3;?>
                                  </div>
                                </div>
                              </div>
                              <div class="row mt-4">
                              <div class="col">
                              <form method="post" class="form-inline">
                                <input type="date" name="tgl_mulai" class="form-control">
                                <input type="date" name="tgl_selesai" class="form-control ml-3">
                                <button type="submit" name="filter_tgl" class="btn btn-info ml-3">filter</button>
                              </form>
                            </div>
                          </div>
                          </div>

                             <div class="card-body">
                              <div class="table-responsive">
                                <table class="table table-bordered" id="tblkeluar" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Gambar</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Kepada</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        

                                        <?php
                                         if(isset($_POST['filter_tgl'])){
                                          $mulai = $_POST['tgl_mulai'];
                                          $selesai = $_POST['tgl_selesai'];



                                           if($mulai!=null || $selesai=null){

                                            $ambilsemuadatastock = mysqli_query($conn, "select * from peminjaman p, stock s where s.idbarang = p.idbarang and tanggal BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY) order by idpeminjaman DESC");  
                                            }
                                         
                                          
                                          else { $ambilsemuadatastock = mysqli_query($conn, "select * from peminjaman p, stock s where s.idbarang = p.idbarang");}

                                          } else { $ambilsemuadatastock = mysqli_query($conn, "select * from peminjaman p, stock s where s.idbarang = p.idbarang order by idpeminjaman DESC");}

                                        while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                            $idk = $data['idpeminjaman'];
                                            $idb = $data['idbarang'];
                                            $namabarang = $data['namabarang'];
                                            $qty = $data['qty'];
                                            $penerima = $data['peminjam'];
                                            $status = $data['status'];
                                            $tanggalpinjam = $data['tanggalpinjam'];
 
                                            //cek ada gambar atau tidak
                                            $gambar = $data['image']; //ambil gambar
                                            if($gambar==null){
                                                //jika tidak ada gambar
                                                $img = 'No Photo';
                                            }else{
                                                //jika ada gambar
                                                $img = '<img src="images/'.$gambar.'" class="zommable">';
                                            }
                                        
                                        ?>

                                        
                                        <tr>
                                            <td><?=$tanggalpinjam;?></td>
                                            <td><?=$img;?></td>
                                            <td><?=$namabarang;?></td>
                                            <td><?=$qty;?></td>
                                            <td><?=$penerima;?></td>
                                            <td><?=$status;?></td>
                                            <td>

                                            <?php

                                            if ($status=='Dipinjam'){
                                              echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit'.$idk.'">
                                                Selesai
                                            </button>';

                                          } else {

                                          //jika status bukan dipinjam
                                            echo '√';
                                          
                                          }
                                            ?>

                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                      <div class="modal fade" id="edit<?=$idk;?>">
                                         <div class="modal-dialog">
                                          <div class="modal-content">
                                          
                                            <!-- Modal Header -->
                                             <div class="modal-header">
                                              <h4 class="modal-title">Selesaikan</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <form method="post">
                                            <div class="modal-body">
                                             Apakah barang ini sudah selesai dipinjam?
                                             <br>
                                             <input type="hidden" name="idpinjam" value="<?=$idk;?>">
                                            <input type="hidden" name="idbarang" value="<?=$idb;?>">
                                             <button type="submit" class="btn btn-primary" name="barangkembali"> Iya </button>
                                            
                                          </div>
                                     </div>
                                      </div>
                                  </form>
                              </div>
                                      

                                        
                                        <?php
                                            };
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>


    <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Peminjaman </h4>
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
         <input type="text" name="penerima" placeholder="Kepada " class="form-control" required>
         <br>
         <button type="submit" class="btn btn-primary" name="pinjam">Pinjam</button>
        
        </div>
        </form>
        
      </div>
    </div>
  </div>
</html>
