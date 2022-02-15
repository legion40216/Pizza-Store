<?php
include('config/connection.php');

if(isset($_POST['delete']))

{
$id_delete = mysqli_real_escape_string($conn, $_POST['id_delete']);

$query = "DELETE FROM pizza WHERE id = $id_delete";

if(mysqli_query($conn,$query))
{
   header('location: index.php');
    //success
} else {
   echo 'query error:'.mysqli_error($conn);

}

}


if(isset($_GET['id']))
{
    $id=mysqli_real_escape_string($conn,$_GET['id']);

    $sql ="SELECT * FROM pizza WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    $pizza_details= mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    


}

if (isset($_POST['edit']))
{
    $ingredients =$_POST['ingredients'];
    $email =$_POST['email'];
    $title =$_POST['title'];
   
   $sql = "UPDATE `pizza` SET `title`='$title',`ingredients`='$ingredients',`email`='$email' WHERE `id` = $id";

   if(mysqli_query($conn,$sql))
   {
       //Sucess
       header('Location:index.php');
   }
   else{
       //error
       echo 'query error'.mysqli_error($conn);
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('Templates/header.php'); ?>

<div class="container center">
<?php if($pizza_details):?>
    <h4><?= $pizza_details['title'] ?></h4>
    <p>Created by: <?=$pizza_details['email'] ?> </p>
    <p><?= date($pizza_details['created_at'])?></p>
    <h4>Ingredients</h4>
    <p><?= $pizza_details['ingredients'] ?>
   <?php else: ?>
    <h4>No such pizza exist !</h5>
<?php endif ?>

<form action="details.php" method="post">
<input type="hidden" name="id_delete" value="<?php echo $pizza_details['id'] ?>">
<input type="submit" name='delete' value='Delete' class='waves-effect waves-light btn-large brand'>
</form>

<div class="btn-floating btn-large cyan" onclick="edit()"><a  href="#section2"><i class="material-icons">edit</i></a></div>

</div>

<form id="section2" class="white z-depth-1 center edit_form enable" action="details.php?id=<?php echo $pizza_details['id'] ?>" method="post">
<span>Edit</span>
    <label for="email">Email</label>    
    <input type="email" name="email" value="<?php echo $pizza_details['email'] ?>">

    <label for="title">Title</label>
    <input type="text" name="title" value="<?php echo $pizza_details['title'] ?>"> 
    
    <label for="ingredients">Ingredients(comma seprated)</label>
    <input type="text" name="ingredients" value="<?php echo $pizza_details['ingredients'] ?>">
    
    <input type="submit" name="edit" value="Submit" class="btn brand ">
 
</form>

<script>
    var edit_form=document.querySelector(".edit_form");
console.log(edit_form);
function edit(){
    
    edit_form.classList.toggle("enable");
}
</script>
<?php include('Templates/footer.php'); ?>    



</html>