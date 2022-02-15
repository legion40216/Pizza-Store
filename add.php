<?php
include('config/connection.php');

  $ingredients = '';
  $email = '';
  $title =  '';
$error=['emails'=>'','title'=>'','ingredient'=>[]];



if(isset($_POST['submit']))
{    
    $ingredients =$_POST['ingredients'];
    $email =$_POST['email'];
    $title =$_POST['title'];

    if(empty($_POST['email']))
    {
        $error['emails']= 'eamil is requried <br />';
    }


    else
    {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL ))
    {
      $error['emails']= 'wrong Email Input<br />';
    }

     }    


    if(empty($_POST['title']))
    {
        $error['title']= 'title is requried <br />';
    }

    else{
        
        if(!preg_match('/^([a-zA-z]{3,}+)(\s[a-zA-z]+)*$/',$title))
        {
            $error['title']= 'title must not begin with a space and must be 3 letters long <br>';
        }
    }
    

    if(empty($_POST['ingredients']))
    {
        $error["ingredient"]=["input ingredients"];
    }

    else{
        
      
        if(!preg_match('/^([a-zA-z]{3,}+)(,[a-zA-z]+)*+$/',$ingredients))
        {
            $error["ingredient"]=['must be comma separated items','cannot start with comma','cannot start with space'];
        }
    }

    if(array_filter($error))
{
     //check for errors
} else{
   $query = "INSERT INTO pizza(title,email,ingredients) VALUES('$title','$email','$ingredients')";
   if(mysqli_query($conn,$query))
   {
       //Sucess
       header('Location:index.php');
   }
   else{
       //error
       echo 'query error'.mysqli_error($conn);
   }
    
}

}





?>

<!DOCTYPE html>
<html lang="en">

<?php include('Templates/header.php'); ?>




<section class="container grey-text">
    <h4 class="center" >Add a Pizza</h4>

    <form  class="white z-depth-1"  action="add.php" method="POST">
  
       
        <label for="email">Your Email</label>
        <input type="text" value= "<?= $email  ?>" name="email" placeholder="Email@outlook.com">  
       <div class="error red lighten-4 red-text"><?=   $error['emails']?></div>
     
       
        <label for="">Pizza Title</label>
        <input type="text" name="title"   value= "<?= $title  ?>">
        <div class="error red lighten-4 red-text"><?=$error['title'] ?></div>

        <label for="">Ingredients (comma separated):</label>
        <input type="text" name="ingredients"  value= "<?= $ingredients  ?>">

        <div class="red-text error red lighten-4">
        <ul >
            

        <?php foreach($error['ingredient'] as $errors)  { ?>
      
      
            <li><?=$errors ?></li>
       
        <?php }?>

        </ul>
        </div>
        
        <div class="center">
<input type="submit" name="submit" value="submit" class="btn brand ">
        </div>
    </form>


</section>


<?php include('Templates/footer.php'); ?>    


</body>
</html>