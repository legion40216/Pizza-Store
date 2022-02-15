<?php
// connect to database
$conn= mysqli_connect('localhost','root','','pizza_data');

// check connection
if(!$conn)
{
echo 'connection errror'.mysqli_connect_error();
}

// write query from all pizza
$qery= 'SELECT * FROM pizza';

//make query and get result

$result = mysqli_query($conn,$qery);

//fetch data
$pizzas = mysqli_fetch_all($result,MYSQLI_ASSOC);

//free memory 
mysqli_free_result($result);
//close database connection
mysqli_close($conn);

 $pizzaschunks =array_chunk($pizzas,2);
//print_r($pizzaschunks[0][1]['title']);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('Templates/header.php'); ?>


<div class="container"> 
<h4 class="center grey-text">Pizzas!</h4>  
    <div class="row grid">
    

<?php foreach($pizzas as $pizza)  :?>
   
    <div class="col s12 m6">
                <div class="card z-depth-0">
                    <img src="img/pizza.svg" alt="">
                  <div class="card-content center">
                      <h5><?=$pizza['title']; ?></h5>
      
                      <ul>
                          <?php foreach(explode(",",$pizza['ingredients']) as $ingredient)  :?>
                           <li class="grey-text text-darken-2"><?=$ingredient;?></li>
                           <?php endforeach; ?>
                      </ul>


                </div>
                      <div class="card-action right-align">
                          <a class="brand-text" href="details.php?id=<?php echo $pizza['id'];?>">More Info</a >
                      </div>

                </div>
           </div>

<?php endforeach; ?>          
        
</div>
</div>

<?php include('Templates/footer.php'); ?>    
</html>