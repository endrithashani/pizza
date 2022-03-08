<?php
    include('db_conn.php');
    $title = $email = $ingredients= '';
    $errors = array('email'=>'','title'=>'','ingredients'=>'');
    if(isset($_POST['submit'])){
        //CHECK EMAIL
        if(empty($_POST['email'])){
            $errors['email'] ='Email is required <br/>';
        }
        else{
            $email = $_POST['email'];
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errors['email'] ='Email must be a valid email address';
            }
        }
        //check title
        if(empty($_POST['title'])){
            $errors['title']='Title is required <br/>';
        }
        else{
            $title = $_POST['title'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
            $errors['title']='Titles must be letters and spaces only';
            }

        }
        //check ingredients
        if(empty($_POST['ingredients'])){
            $errors['ingredients']='Ingredients are required <br/>';
        }
        else{
            $ingredients = $_POST['ingredients'];
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
            $errors['ingredients']='Ingredients must be letters and comma seperated ';
            }
        }
            if(array_filter($errors)){
            }else{
                $email=mysqli_real_escape_string($conn,$_POST['email']);
                $title=mysqli_real_escape_string($conn,$_POST['title']);
                $ingredients=mysqli_real_escape_string($conn,$_POST['ingredients']);

                //create sql
                $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES ('$title','$email','$ingredients')";

                //save to db and check
                if(mysqli_query($conn,$sql)){

                }else{
                    //errors
                    echo 'query error' . mysqli_error($conn);
                }
                header('Location:index.php');
            }
        } //end of POST check
      

?>
<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php');?>

    <section class="container grey-text">
        <form action="add.php" class="white" method="POST">
        <h4 class="center">Add a Pizza</h4>
            <label >Your Email:</label>
            <input type="text" name="email" value="<?php echo $email; ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <label >Pizza Title:</label>
            <input type="text" name="title" value="<?php echo $title ;?>">
            <div class="red-text"><?php echo $errors['title'];?></div>
            <label >Ingredients (comma seperated):</label>
            <input type="text" name="ingredients" value="<?php echo $ingredients; ?>">
            <div class="red-text"><?php echo $errors['ingredients'];?></div>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
    <?php include('templates/footer.php');?>
</html>