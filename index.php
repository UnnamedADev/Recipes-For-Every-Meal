<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>v0.0.2 - Recipes For Every Meal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <a href="index.php">Strona główna</a>
        <a href="">Wszystkie przepisy</a>
    </nav>
    <section>
        <div class="formHolder">
            <form action="index.php" method="post">
                 <table>
                     <tbody>
                         <tr>
                             <td><img src="img/meal1.png"></td>
                             <td><img src="img/difficulty1.png"></td>
                         </tr>
                         <tr>
                             <td>
                                <div class="customSelect">
                                    <select name="fMeal">
                                         <option value="breakfast">Breakfast</option>
                                         <option value="lunch">Lunch</option>
                                         <option value="dinner">Dinner</option>
                                     </select>
                                </div>
                             </td>
                             <td>
                                 <div class="customSelect">
                                     <select name="fDifficulty">
                                         <option value="newbie">Newbie</option>
                                         <option value="basic">Basic</option>
                                         <option value="nightmare">Nightmare</option>
                                     </select>
                                 </div>
                             </td>
                         </tr>
                     </tbody>
                 </table>

                 <div>
                     <button type="reset" class="negetiveButton">Resetuj</button>
                     <button type="submit" class="positiveButton">Filtruj</button>
                 </div>
                 
            </form>
        </div>
        
        <div class="results">
           <!-- SCRIPT / filter -->
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
                    $meal = $_POST["fMeal"];
                    $difficulty = $_POST["fDifficulty"];
                    
                    echo $meal;
                    echo $difficulty;
                }
            ?>
            results here
        </div>
    </section>
    <footer>
        <h2>Enjoyyy!</h2>
        <p>Site created for all of you!</p>
    </footer>
</body>
</html>