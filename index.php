<?php 
session_start();
require 'config/config.php';

if(empty($_SESSION['user_id'] ||  $_SESSION['logged_in'])){
  header('Location: login.php');
  exit();
}

 $stmt = $pdo->prepare("SELECT * from posts");
 $stmt->execute();
 $result = $stmt->fetchall(PDO::FETCH_ASSOC);

//  var_dump($result);


  // foreach($result as $data){
  //   // echo $data['title'];
  // }



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Widgets</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">





  <div class="">
    <section class="content-header">
        <div class="container-fluid">       
                    <h1 style="text-align: center;">Blog Site</h1>
        </div>
    </section>
    <div style="display: block;">
       <div class="row">
          <!-- /1 -->
            <?php foreach($result as $data): ?>
              <div class="col-md-4">
                    <!-- Box Comment -->
                    <div class="card card-widget">
                  
                    <div class="card-header">
                        <div class="user-block">
                        <img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Image">
                        <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                        <span class="description"><?php echo $data['created_at']; ?></span>
                        </div>
                    
                        <!-- /.user-block -->
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" title="Mark as read">
                            <i class="far fa-circle"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-header">
                        <div style="text-align:center">
                            <h4><?php echo $data['title']; ?></h4>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="blogDetails.php?id=<?php echo $data['id'] ?>">
                      <div class="container mb-2">
                      <img class="img-fluid pad" style="height: 200px !important;" src="images/<?php echo $data['image'] ?>"  />
                      </div>
                        </a>

                        <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
                        <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
                        <span class="float-right text-muted">127 likes - 3 comments</span>
                    </div>
            
                    </div>
                    <!-- /.card -->
                </div>
              <?php endforeach; ?>

          
                <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
                  <i class="fas fa-chevron-up"></i>
                </a>
         </div>
        <!-- pagination -->
        <nav style="float: right !important" aria-label="Page navigation example">
      <ul class="pagination">
          <li class="page-item"><a class="page-link" href="#">Previous</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">Next</a></li>
      </ul>
  </nav>
  <!-- pagination -->

  <div style="display: block !important">
      <footer class="main-footer" style="margin-left: 0px !important">
          <div class="float-right d-none d-sm-block">
              <b>Version</b> 3.2.0
          </div>
          <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
      </footer>
  </div>

      

      

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
