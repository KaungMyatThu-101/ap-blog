<?php 
session_start();
require '../config/config.php';

if(empty($_SESSION['user_id'] || $_SESSION['logged_in']) ){
    header('Location: login.php');
    exit;
}   
// var_dump($_POST);

if($_POST){

    $title = $_POST['title'];
    $content = $_POST['content'];
    $id = $_POST['id'];

    if($_FILES['image']['name'] != null){
        $file = '../images/'.($_FILES['image']['name']);
        $imageType = pathinfo($file,PATHINFO_EXTENSION);

        if($imageType != 'png' && $imageType!= 'jpg' && $imageType !='jpeg'  ){
            echo "<script>alert('Image must be png, jpg, jpeg')</script>";
        }
        else{
            $image = $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],$file);

            $stmt = $pdo->prepare("UPDATE posts set title='$title', content='$content',image='$image' where id='$id' ");
            $result = $stmt->execute();

            if($result) {
                echo "<script>alert('Successfully updated');</script>";
                header("Location: index.php"); // Redirect after successful addition
            }
        }
    }
    else{
        $stmt = $pdo->prepare("UPDATE posts set title='$title', content='$content' where id='$id' ");
        $result = $stmt->execute();

        if($result) {
            echo "<script>alert('Successfully updated'); window.location.href='index.php'</script>";
            // header("Location: index.php"); // Redirect after successful addition
    }
}
}

 $stmt = $pdo->prepare("SELECT * FROM posts where id=".$_GET['id']);
 $stmt->execute();
 $result = $stmt->fetchAll();


include('header.php'); 
?>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $result[0]['id']  ?>">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input value="<?php echo $result[0]['title']  ?>" type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea value="" class="form-control"  name="content" required><?php echo $result[0]['content']  ?>
                            </textarea>
                        </div>
          
                        <div class="form-group">
                            <label for="image">Image</label>
                            <img src="../images/<?php echo $result[0]['image'] ?>" width="150" height="150" alt=""> <br>
                            <input type="file" class="form-control" name="image" >
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="index.php" class="btn btn-warning">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>
