<?php
    require 'database.php';
    if(!empty ($_GET['id'])){
        $id=checkInput($_GET['id']);
    }

    $db = Database:: connect();
    $statement = $db-> prepare('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category
                                       FROM items LEFT JOIN categories ON items.category=categories.id
                                       WHERE items.id = ?');
    $statement->execute(array($id));
    $item = $statement->fetch();
    Database::disconnect();

    function checkInput($data){
        $data= trim($data);
        $data = stripslashes ($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&family=Jacquard+12&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Limelight&family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Burger</title>
</head>

<body>
    <h1 class="text-logo"> <span class="glyphicon bi-shop"></span> Burger code <span class="glyphicon bi-shop"></span></h1>
    <div class="container admin">
        <div class="row">
            <div class ="col-sm-6">
               <h1> <strong> Voir un item </strong></h1> 
               <br>
               <form>
                <div class="form-group">
                    <label> <strong> Nom: </strong> </label> <?php echo ' '. $item['name'];?>
                </div>
                <br>
                <div class="form-group">
                    <label> <strong> Description:</strong> </label> <?php echo ' '. $item['description'];?>
                </div>
                <br>
                <div class="form-group">
                    <label> <strong> Prix:</strong> </label> <?php echo ' '. number_format((float)$item['price'], 2, '.','' ). '€';?>
                </div>
                <br>
                <div class="form-group">
                    <label> <strong> Catégorie:</strong> </label> <?php echo ' '. $item['category'];?>
                </div>
                <br>
                <div class="form-group">
                    <label> <strong> Image:</strong> </label> <?php echo ' '. $item['image'];?>
                </div>
               </form>
               <br>
               <div class="form-actions">
                    <a class="btn btn-primary" href ="index.php"><span class ="glyphicon bi-arrow-left"></span>Retour</a>
               </div>
            </div>
            <div class="col-md-6 site">
                <div class="img-thumbnail">
                    <img src="<?php echo '../images/' .$item['image'] ;?>" class="img-fluid" alt="menu classic">
                    <div class="price"><?php echo number_format((float)$item['price'], 2, '.','' ); ?></div>
                    <div class="caption">
                        <h4> <?php echo $item['name']; ?></h4>
                        <p><?php echo $item['description']; ?></p>
                        <a href="#" class="btn btn-order" role="button"><span class="bi-cart4"></span> Commander</a>
                    </div>
                </div> 
            </div>
            
       
        
        
        </div>
    </div>

</body>

</html>