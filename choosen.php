<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>v0.1.8 - Recipes For Every Meal</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="zoom.css">
    <script src="jquery-3.2.1.min.js"></script>
    <script src="difficulty.js"></script>
    <script src="zoom.js"></script>
</head>
<body>

    <nav>
        <a href="index.php">wróć na Stronę Główną</a>
    </nav>
    <section>
            
                    <!-- SCRIPT / obj -->
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
                        
                        $connection->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
                        $connection->query("SET CHARSET utf8");
                        
                        $qr = "SELECT 
                        recipes.title AS r_title, 
                        recipes.ingredients AS r_ingredients,
                        recipes.measures AS r_measures,
                        recipes.instruction AS r_instruction,
                        recipes.addnotation AS r_addnotation,
                        recipes.href AS r_href,
                        meals.name AS m_name,
                        difficulties.name AS d_name,
                        difficulties.description AS d_description,
                        recipes.time AS r_time
                        FROM recipes 
                        INNER JOIN meals 
                        ON recipes.meal_id=meals.id 
                        INNER JOIN difficulties
                        ON recipes.difficulty_id=difficulties.id
                        WHERE recipes.id=".$obj.";";
                        
                        $result = $connection->query($qr);
                        
                        if($result->num_rows>0){
                                while($row = $result->fetch_assoc()){
                                    
                                    $r_title = $row["r_title"];
                                    $r_ingredients = $row["r_ingredients"];
                                    $r_measures = $row["r_measures"];
                                    $r_instruction = $row["r_instruction"];
                                    $r_addnotation = $row["r_addnotation"];
                                    $r_href = $row["r_href"];
                                    
                                    $m_name = $row["m_name"];
                                    
                                    $d_name = $row["d_name"];
                                    $r_time = $row["r_time"];
                                    $d_description = $row["d_description"];
                                }
                            }else{
                                echo "<p class='emergencyAlert'>NO DATA</p>";
                            }
                        $connection->close();
                    ?>
            <div class="row myRecipe">
                <div class="col-2"></div>
                <div class="col-8">
                    <h1 class="recipeTitle"><?php echo $r_title; ?></h1>
                    <p class="recipeSubtitle">Masz to zjeśc jako: <?php echo $m_name;?></p>
                    <h3 id="difficulty">Czas przygotowania: <?php echo $r_time;?></h3>
                    <h3 id="difficulty">Poziom trudności: <?php echo $d_name;?></h3>
                    <table>
                        <tbody>
                            <tr>
                                <td>25%</td>
                                <td>50%</td>
                                <td>75%</td>
                                <td>100%</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="difficultyMeter">
                        <div id="difficultyBar"></div>
                    </div>
                    
                    <h2>Co musisz znaleźć w kuchni:</h2>
                    <p><?php echo $r_ingredients; ?></p>
                    
                    <h2>Zdecydowany? To weź tyle...</h2>
                    <p><?php echo $r_measures; ?></p>
                    
                    <h2>Co z tym zrobić i jak zrobić?</h2>
                    <p><?php echo $r_instruction; ?></p>
                    
                    <h2 class="advices">Rady z dobrego serca</h2>
                    <p class="advices"><?php echo $r_addnotation; ?></p>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="row myRecipe print">
                <div class="col-2"></div>
                <div class="col-8">
                    <h2>Wersja do druku</h2>
                    
                    <img id="recipeImg" src="<?php echo "cache/recipes/przepis-".$r_href.".png"; ?>">
                    <p>Podgląd (kliknij obrazek by powiększyć)</p>
                    <a href="<?php echo "cache/recipes/przepis-".$r_href.".png"; ?>" download>Pobierz .png</a>
                    <a href="<?php echo "cache/recipes/przepis-".$r_href.".odt"; ?>" download>Pobierz .odt</a>
                </div>
                <div class="col-2"></div>
            </div>
           
        
    </section>
    <footer>
        <h2>Korzystaj!</h2>
        <p>Strona tworzona dla was wszystkich!</p>
    </footer>
</body>
</html>