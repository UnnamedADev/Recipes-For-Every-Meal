<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>v0.1.6 - Recipes For Every Meal</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
</head>
<body>

    <nav>
        <a href="index.php">Strona główna</a>
    </nav>
    <section>
            <form action="index.php" method="post">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-3">
                    <div class="customSelect">
                        <select name="fMeal">
                           <option value="0">-- posiłek --</option>
                            <option value="1">śniadanie</option>
                            <option value="2">lunch</option>
                            <option value="3">obiad</option>
                            <option value="4">podwieczorek</option>
                            <option value="5">kolacja</option>
                            <option value="6">przekąska</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="customSelect">
                        <select name="fDifficulty">
                           <option value="0">-- trudność --</option>
                            <option value="1">laik</option>
                            <option value="2">podstawowy</option>
                            <option value="3">koszmar</option>
                            <option value="4">piekło</option>
                        </select>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
            
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                    <div class="customSelect">
                        <select name="fSort">
                           <option value="0">-- sortowanie --</option>
                            <option value="1">A --> Z</option>
                            <option value="2">Z --> A</option>
                            <option value="3">Łatwy --> Trudny</option>
                            <option value="4">Trudny --> Łatwy</option>
                            <option value="5">Śniadanie --> Kolacja</option>
                            <option value="6">Kolacja --> Śniadanie</option>
                        </select>
                    </div>
                </div>
                <div class="col-4"></div>
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
                            switch($meal){
                                case 0:
                                    $qrAddMeal = "%";
                                    break;
                                case 1:
                                    $qrAddMeal = "śniadanie";
                                    break;
                                case 2:
                                    $qrAddMeal = "lunch";
                                    break;
                                case 3:
                                    $qrAddMeal = "obiad";
                                    break;
                                case 4:
                                    $qrAddMeal = "podwieczorek";
                                    break;
                                case 5:
                                    $qrAddMeal = "kolacja";
                                    break;
                                case 6:
                                    $qrAddMeal = "przekąska";
                                    break;
                                default:
                                    $qrAddMeal = "%";
                                    echo "<p class='emergencyAlert'>!INVALID OPTION MEAL - DEFAULT!</p>";
                            }
                            
                            $difficulty = $_POST["fDifficulty"];
                            switch($difficulty){
                                case 0:
                                    $qrAddDifficulty = "%";
                                    break;
                                case 1:
                                    $qrAddDifficulty = "laik";
                                case 2:
                                    $qrAddDifficulty = "podstawowy";
                                    break;
                                case 3:
                                    $qrAddDifficulty = "koszmar";
                                    break;
                                case 4:
                                    $qrAddDifficulty = "piekło";
                                    break;
                                default:
                                    $qrAddMeal = "%";
                                    echo "<p class='emergencyAlert'>!INVALID OPTION DIFFICULTY - DEFAULT!</p>";
                            }
                            
                            $sort = $_POST["fSort"];
                            switch($sort){
                                case 0:
                                    $qrAddSort = "";
                                    break;
                                case 1:
                                    $qrAddSort = "ORDER BY r_title ASC";
                                    break;
                                case 2:
                                    $qrAddSort = "ORDER BY r_title DESC";
                                    break;
                                case 3:
                                    $qrAddSort = "ORDER BY dname ASC";
                                    break;
                                case 4:
                                    $qrAddSort = "ORDER BY dname DESC";
                                    break;
                                case 5:
                                    $qrAddSort = "ORDER BY mname ASC";
                                    break;
                                case 6:
                                    $qrAddSort = "ORDER BY mname DESC";
                                    break;
                                default:
                                    $qrAddSort = "";
                                    echo "<p class='emergencyAlert'>!INVALID OPTION SORT - DEFAULT!</p>";
                            }
                            
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
                            
                            $qr = "SELECT recipes.id AS r_id, 
                            recipes.title AS r_title,
                            meals.name AS mname,
                            difficulties.name AS dname 
                            FROM recipes 
                            INNER JOIN meals 
                            ON recipes.meal_id=meals.id 
                            INNER JOIN difficulties
                            ON recipes.difficulty_id=difficulties.id
                            WHERE meals.name LIKE '".$qrAddMeal."' AND difficulties.name LIKE '".$qrAddDifficulty."' ".$qrAddSort.";";
                            
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
                                    <td>''".$row["r_title"]."''</td>
                                    <td>".$row["mname"]."</td>
                                    <td>".$row["dname"]."</td>
                                    <td><a href='choosen.php?obiekt=".$row["r_id"]."'>Sprawdź</a></td>
                                    </tr>";
                                }
                            }else{
                                echo "<p class='emergencyAlert'>!NO DATA!</p>";
                            }
                            $connection->close();
                            echo "</tbody></table>";
                        }
                    ?>
                </div>
                <div class="col-3"></div>
            </div>
           
        
    </section>
    <footer>
        <h2>Korzystaj!</h2>
        <p>Strona tworzona dla was wszystkich!</p>
    </footer>
</body>
</html>