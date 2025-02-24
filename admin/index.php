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
            <h1> <strong> Liste des items </strong> <a href="insert.php" class ="btn btn-success btn-lg"><span class="glyphicon bi-plus"></span> Ajouter </a></h1>
        <table class ="table table-striped table-bordered">
            <thead>
                <tr>
                    <th> Nom </th>
                    <th> Description </th>
                    <th> Prix </th>
                    <th> Catégorie </th>
                    <th> Action </th>
                </tr>   
            </thead>
            <tbody>

                <?php
                require "database.php";
                $db= Database::connect();
                $statement=$db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category
                                       FROM items LEFT JOIN categories ON items.category=categories.id
                                       ORDER BY items.id DESC');
    
                while ($item=$statement->fetch()){
                    echo '<tr>';
                    echo '<td>' . $item['name'] .'</td>';
                    echo '<td>' . $item['description'] . '</td>';
                    echo '<td>' . number_format((float)$item['price'], 2, '.','' )  . '</td>';
                    echo '<td>' . $item['category'] .'</td>';
                    echo '<td width=340>'; 
                    echo '<a class="btn btn-secondary" href="view.php?id=' .$item['id']. '"> <span class="glyphicon bi-eye"></span> Voir </a>';
                    echo ' ';
                    echo '<a class="btn btn-primary" href="update.php?id=' .$item['id']. '"> <span class="glyphicon bi-pencil"></span> Modifier </a>';
                    echo ' ';
                    echo '<a class="btn btn-danger" href="delete.php?id=' .$item['id']. '"> <span class="glyphicon bi-x"></span> Supprimer </a>';
                    echo '</td>';
                    echo '</tr>';
                }
                Database::disconnect();

                ?>

                
            </tbody>

        </table>
        
        
        </div>
    </div>

</body>

</html>