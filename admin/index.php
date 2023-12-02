<?php 

session_start();
require '../config/config.php';

if(empty($_SESSION['user_id'] ||  $_SESSION['logged_in'])){
  header('Location: login.php');
}
include('header.php');
?>

  
        <?php 
          if(!empty($_GET['pageno'])){
            $pageno = $_GET['pageno'];
          }else{
            $pageno = 1;
          }
          $numberOfRec = 2;
          $offset = ($pageno-1) * $numberOfRec;
              
          if(!empty($_POST['search']) ){

             //for search
             $searchKey = $_POST['search'];
             $stmt = $pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$searchKey' ORDER BY id desc");
             $stmt->execute();
             $rawResult = $stmt->fetchAll();
             $total_pages = ceil(count($rawResult)/$numberOfRec);
 
             $stmt = $pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$searchKey' ORDER BY id DESC LIMIT $offset,$numberOfRec"); //start, how many wnna show
             $stmt->execute();
             $result = $stmt->fetchAll();
          }
          else{
             //for pagination
             $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id desc");
             $stmt->execute();
             $rawResult = $stmt->fetchAll();
             $total_pages = ceil(count($rawResult)/$numberOfRec);
 
             $stmt = $pdo->prepare("SELECT * FROM posts ORDER by id DESC LIMIT $offset,$numberOfRec"); //start, how many wnna show
             $stmt->execute();
             $result = $stmt->fetchAll();
          }
        ?>
        <!-- Main content --> 
        <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Bordered Table</h3>
                  </div>

                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th style="width: 40px">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach($result as $data): ?>
                        <tr>
                          <td> <?php echo $i++ ?></td>
                          <td> <?php echo $data['title'] ?> </td>
                          <td>
                            <div class=""><?php echo substr($data['content'],0,50) ?></div>
                          </td>
                          <td>
                            <di class="btn-group">
                              <div class="container">
                                <a href="edit.php?id=<?php echo $data['id'] ?>" class="btn btn-info">Edit</a>
                              </div>
                              <div class="container">
                                <a href="delete.php?id=<?php echo $data['id'] ?>"  class="btn btn-danger"
                                onclick="return confirm('U wnna delete ?')"
                                  >Delete</a
                                >
                              </div>
                            </di>
                          </td>
                          <?php endforeach; ?>
                        </tr>
                      </tbody>
                    </table>
                    <br>
                    <nav aria-label="Page navigation example" style="float: right;">
                      <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                        <li class="page-item <?php if($pageno<=1){echo 'disabled';} ?> ">
                        <a class="page-link" href="<?php if($pageno<=1){echo '#';}else{echo"?pageno=".($pageno-1);} ?>">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#"><?php echo $pageno;  ?></a></li>
                        <li class="page-item <?php if($pageno>= $total_pages){echo 'disabled';} ?> ">
                          <a class="page-link"  href="<?php if($pageno>=$total_pages){echo '#';}else{echo"?pageno=".($pageno+1);} ?>">Next</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages ?>">Last</a></li>
                      </ul>
                    </nav>
                  </div>
           
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong
          >Copyright &copy; 2014-2023
          <a href="https://adminlte.io">AdminLTE.io</a>.</strong
        >
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
        <a href="logout.php" class="btn btn-danger"
            >Logout</a
          >
        </div>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins//jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge("uibutton", $.ui.button);
    </script>
    <!-- Bootstrap 4 -->
    <script src="../plugins//bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins//chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins//sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../plugins//jqvmap/jquery.vmap.min.js"></script>
    <script src="../plugins//jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../plugins//jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../plugins//moment/moment.min.js"></script>
    <script src="../plugins//daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../plugins//tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../plugins//summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../plugins//overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard.js"></script>
  </body>
</html>
