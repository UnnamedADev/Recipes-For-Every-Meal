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
            <form action="index.php" method="post">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-3">
                    <div class="customSelect">
                        <select name="fMeal">
                           <option value="0">-- Choose meal --</option>
                            <option value="breakfast">Breakfast</option>
                            <option value="lunch">Lunch</option>
                            <option value="dinner">Dinner</option>
                            <option value="tea time">Tea Time</option>
                            <option value="supper">Supper</option>
                            <option value="snack">Snack</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="customSelect">
                        <select name="fDifficulty">
                           <option value="0">-- Choose difficulty --</option>
                            <option value="newbie">Newbie</option>
                            <option value="basic">Basic</option>
                            <option value="nightmare">Nightmare</option>
                            <option value="hell">Hell</option>
                        </select>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
            
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                   <button type="reset" class="button buttonNegative">Reset</button>
                    <button type="submit" class="button buttonPositive">Filtruj</button>
                </div>
                <div class="col-3"></div>
            </div>
            </form>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <!-- SCRIPT / filter -->
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $meal = $_POST["fMeal"];
                            $difficulty = $_POST["fDifficulty"];
                            
                            $host = "localhost";
                            $username = "root";
                            $password = "";
                            $db = "recipes-for-every-meal";
                            
                            $connection = new mysqli($host, $username, $password, $db);
                            
                            if($connection->connect_error){
                                die("ERROR 1");
                            }else
                            
                            $qr = "SELECT recipes.id, recipes.title, meals.name AS mname, difficulties.name AS dname FROM recipes 
                            INNER JOIN meals 
                            ON recipes.meal_id=meals.id 
                            INNER JOIN difficulties
                            ON recipes.difficulty_id=difficulties.id
                            WHERE meals.name ='".$meal."' AND difficulties.name='".$difficulty."';";
                            
                            $result = $connection->query($qr);
                            echo "<table class='filtered'><tbody>
                            <tr>
                            <th>Tytuł:</th>
                            <th>Posiłek:</th>
                            <th>Trudność:</th>
                            <th></th>
                            </tr>";
                            if($result->num_rows>0){
                                while($row = $result->fetch_assoc()){
                                    echo "<tr>
                                    <td>".$row["title"]."</td>
                                    <td>".$row["mname"]."</td>
                                    <td>".$row["dname"]."</td>
                                    <td><a href='choosen.php?obiekt=".$row["id"]."'>Sprawdź</a></td>
                                    </tr>";
                                }
                            }else{
                                echo "NO DATA";
                            }
                            echo "</tbody></table>";
                        }
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