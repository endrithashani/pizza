<?php
    include('db_conn.php');

    //get data from database
    $sql ='SELECT * FROM pizzas ORDER BY created';

    //make query & get result
    $result = mysqli_query($conn , $sql);

    //fetch the resulting rows as an array
    $pizza = mysqli_fetch_all($result , MYSQLI_ASSOC);

    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);

    //explode(',',$pizza[0]['ingredients']);
?>


<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php');?>

    <h4 class="center grey-text">Pizzas</h4>
    <div class="container">
        <div class="row">
            <?php 
            foreach($pizza as $pizzaa){?>

                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <img src="images/pizza.svg" class="pizza">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($pizzaa['title']); ?></h6>
                            <?php foreach(explode(',',$pizzaa['ingredients']) as $ing){?>
                                <li><?php echo htmlspecialchars($ing);?></li>
                                <?php } ?>
                        </div>
                        <div class="card-action right-align">
                            <a class="brand-text" href="details.php?id=<?php echo $pizzaa['id'];?>">More Info</a>
                        </div>
                    </div>
                </div>

        <?php } ?>
        </div>
    </div>

    <?php include('templates/footer.php');?>
</html>