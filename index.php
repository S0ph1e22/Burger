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
    <link rel="stylesheet" href="css/style.css">
    <title>Burger</title>
</head>
<body>
    <div class="container site">
        <h1 class="text-logo"> <span class="glyphicon bi-shop"></span> Burger code <span class="glyphicon bi-shop"></span></h1>
        <?php
        require 'admin/database.php';
        echo '<nav>
                <ul class="nav nav-pills" role="tablist">';
        $db=Database::connect();
        $statement = $db->query('SELECT * FROM categories' );
        $categories = $statement-> fetchAll();
        foreach($categories as $category){
            if($category['id']== '1')
                echo '<li class="nav-item" role="presentation"><a class="nav-link active" data-bs-toggle="pill" href="#' . $category['id'] .'" role="tab">'.$category['name'].'</a></li>';
            else 
                echo '<li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="pill" href="#' . $category['id'] .'" role="tab">'.$category['name'].'</a></li>';
        }
        echo     '</ul>
              </nav>';

        echo '<div class="tab-content">';

         foreach($categories as $category){
            if($category['id']== '1')
                echo '<div class="tab-pane active" id="'. $category['id'] .'">';
            else 
                echo '<div class="tab-pane" id="'. $category['id'] .'">';
         
            echo '<div class="row">';

            $statement = $db ->prepare('SELECT * FROM items WHERE items.category=?');
            $statement->execute(array($category['id']));

            while ($item = $statement->fetch()){
                echo '<div class="col-sm-6 col-md-4">
                        <div class="img-thumbnail">
                            <img src="images/'.$item['image'] .'" alt="menu classic">
                            <div class="price">' . number_format($item['price'],2, '.', ''). ' €</div>
                            <div class="caption">
                                <h4>' . $item['name'] . '</h4>
                                <p>' . $item['description'] . '</p>
                                <a href="#" class="btn btn-order" role="button"><span class="bi-cart4"></span> Commander</a>
                            </div>
                        </div>
                    </div>';
            }
            echo      '</div>
                 </div>';
        }
        Database::disconnect();
        echo '</div>';
        ?>      
    </div>
</body>
</html>