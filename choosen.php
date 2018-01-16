<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>v0.0.3 - Recipes For Every Meal</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
</head>
<body>

    <nav>
        <a href="index.php">Strona główna</a>
        <a href="">Wszystkie przepisy</a>
    </nav>
    <section>
            
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <!-- SCRIPT / filter -->
                    <?php
                        $obj = $_GET["obiekt"];
                        
                        $host = "localhost";
                        $username = "root";
                        $password = "";
                        $db = "recipes-for-every-meal";
                            
                        $connection = new mysqli($host, $username, $password, $db);
                            
                        if($connection->connect_error){
                                die("ERROR 1");
                        }else
                    ?>
                </div>
                <div class="col-3"></div>
            </div>
           
        
    </section>
    <footer>
        <h2>Enjoyyy!</h2>
        <p>Site created for all of you!</p>
    </footer>
</body>
</html>