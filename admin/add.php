<?php 
session_start();
require '../config/config.php';

if(empty($_SESSION['user_id'] || $_SESSION['logged_in']) ){
    header('Location: login.php');
    exit;
}   
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $file = '../images/'.($_FILES['image']['name']);
    $imageType = pathinfo($file,PATHINFO_EXTENSION);

    if($imageType != 'png' && $imageType!= 'jpg' && $imageType !='jpeg'  ){
        echo "<script>alert('Image must be png, jpg, jpeg')</script>";
    }
    else{
        $title = $_POST['title'];
        $content = $_POST['content'];
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],$file);

        // $stmt =  $pdo->prepare("INSERT INTO posts (tilte,content,image) VALUES (:title,:content,:image) ");
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, image,author_id) VALUES (:title, :content, :image,:author_id)");

        $result =  $stmt->execute(
            array(':title'=>$title,':content'=>$content,':image'=>$image,':author_id'=>$_SESSION['user_id'])
        );
        // if($result){
        //     echo "<script>alert('Successfully added ')</script>";
        // }
        if($result) {
            echo "<script>alert('Successfully added'); window.location.href='index.php'</script>";
            // header("Location: index.php"); // Redirect after successful addition
        }
    }
}

include('header.php'); 
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form action="add.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control"  name="content" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
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
