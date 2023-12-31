<?php 
session_start();
require 'config/config.php';

if(empty($_SESSION['user_id'] ||  $_SESSION['logged_in'])){
  header('Location: login.php');
}
 $stmt = $pdo->prepare("SELECT * FROM posts where id=".$_GET['id']);
 $stmt->execute();
 $result = $stmt->fetchAll();

 $blog_id = $_GET['id'];
 if($_POST){
  $comment = $_POST['comment'];

      $stmt = $pdo->prepare("INSERT INTO comments (content,author_id,post_id) VALUES (?,?,?)");

      $result =  $stmt->execute(
          array($comment,$_SESSION['user_id'] ,$blog_id)
      );
      if($result){
        header('Location: blogDetails.php?id='.$blog_id);
      };
}

//read comment

$stmt = $pdo->prepare("SELECT * FROM comments where post_id=".$_GET['id']);
$stmt->execute();
$cmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

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




  <!-- Content Wrapper. Contains page content -->
  <div class="">
    <section class="content-header">
            <div class="container-fluid">       
                        <h1 style="text-align: center;">Blog Site</h1>
            </div>
        </section>

       <div class="row">
      <div class="col-md-12">
        <!-- Box Comment -->
        <div class="card card-widget">
          <div class="card-header">
            <div class="user-block">
              <img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Image">
              <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
              <span class="description">Shared publicly - 7:30 PM Today</span>
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
          <!-- /.card-header -->
          <div class="card-body container">
            <img class="img-fluid pad"  src="images/<?php echo $result[0]['image'] ?>"  alt="Photo">

            <p>I took this photo this morning. What do you guys think?</p>
            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
            <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
            <span class="float-right text-muted">127 likes - 3 comments</span>
          </div>
          <!-- /.card-body -->
          <div class="card-footer card-comments">
            <?php foreach($cmt as $comment): ?>
            <div class="card-comment">
              <!-- User image -->
              <img class="img-circle img-sm" src="../dist/img/user3-128x128.jpg" alt="User Image">

              <div class="comment-text">
                <span class="username">
                  Maria Gonzales
                  <span class="text-muted float-right">8:03 PM Today</span>
                </span><!-- /.username -->                
                <?php 
               
                  echo $comment['content'].'<br>' ;
                
                ?>
              </div>
              <!-- /.comment-text -->
            </div>
            <?php endforeach; ?>
          </div>
          <!-- /.card-footer -->
          <div class="card-footer">
            <form action="#" method="post">
              <img class="img-fluid img-circle img-sm" src="../dist/img/user4-128x128.jpg" alt="Alt Text">
              <!-- .img-push is used to add margin to elements next to floating images -->
              <div class="img-push">
                <input name="comment" type="text" class="form-control form-control-sm" placeholder="Press enter to post comment">
              </div>
            </form>
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
     
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

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
