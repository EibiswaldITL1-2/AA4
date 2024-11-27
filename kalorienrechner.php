<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalorienrechner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .BasicValues, .PALValues {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 1rem;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            box-sizing: border-box; /* Ensures padding doesn't overflow the container */
        }

        input[type="number"]:focus, select:focus {
            border-color: #0056b3;
            outline: none;
        }

        input[type="submit"], button {
            padding: 10px 20px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 10px;
        }

        input[type="submit"]:hover, button:hover {
            background-color: #003d80;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .buttons a button {
            background-color: #ff6347;
        }

        .buttons a button:hover {
            background-color: #e44d35;
        }

        p {
            font-size: 1.2rem;
            margin-top: 20px;
            color: #333;
        }

        b {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Kalorienrechner</h1>
    <div>
        <form>
            <div class="BasicValues">
                <label for="gender">Geschlecht</label>
                <select name="gender" id="gender">
                    <option value="male">Männlich</option>
                    <option value="female">Weiblich</option>
                </select> <br>
                <label for="age">Alter</label> <br>
                <input type="number" name="age" id="age" min="0" required> <br>
                <label for="weight">Gewicht in kg</label><br>
                <input type="number" name="weight" id="weight" min="0" step=".01" required> <br>
                <label for="height">Größe in cm</label><br>
                <input type="number" name="height" id="height" min="0" required><br><br>           
<!--
                <label for="seated">Zeit sitzend</label><br>
                <input type="number" name="seated"><br>
                <label for="office">Zeit im Büro</label><br>
                <input type="number" name="office"><br>
                <label for="standing">Zeit stehend</label><br>
                <input type="number"><br>
//-->
            </div>
            <div class="PALValues">
                <label for="sleep">Schlafen</label>
                <input type="number" name="sleep"><br>
                <label for="first">ausschließlich sitzend/liegend</label><br>
                <input type="number" name="first"><br>
                <label for="second">vorwiegend sitzende Tätigkeit, kaum körperliche Aktivität</label><br>
                <input type="number" name="second"><br>
                <label for="third">überwiegend sitzende Tätigkeit, dazwischen auch stehend/ gehend</label><br>
                <input type="number" name="third"><br>
                <label for="fourth">hauptsächlich stehende und gehende Aktivitäten</label><br>
                <input type="number" name="fourth"><br>
                <label for="fifth">körperlich anstrengende Arbeiten</label><br>
                <input type="number" name="fifth"><br>
            </div>
            <div class="buttons">
                <input type="submit" name="sent" value="Berechnen">
            </div>
        </form>
        <div class="buttons">
            <a href="kalorienrechner.php"><button>Refresh</button></a>
        </div>
    </div>
    <p>
        <?php 
            $calorienopal = 0; $calorietotal = 0;
            if(isset($_GET['sent'])){
                $_GET['sleep'] != "" ? $sleep = $_GET['sleep'] : $sleep = 0;
                $_GET['first'] != "" ? $first = $_GET['first'] : $first = 0;
                $_GET['second'] != "" ? $second = $_GET['second'] : $second = 0;
                $_GET['third'] != "" ? $third = $_GET['third'] : $third = 0;
                $_GET['fourth'] != "" ? $fourth = $_GET['fourth'] : $fourth = 0;
                $_GET['fifth'] != "" ? $fifth = $_GET['fifth'] : $fifth = 0;
    
                if(isset($_REQUEST['sent'])){
                    $calorienopal = $_GET['gender'] == "male" ? 66.47 + (13.7 * $_GET['weight']) + (5 * $_GET['height']) - (6.8 * $_GET['age']) : 655.1 + (9.6 * $_GET['weight']) + (1.8 * $_GET['height']) - (4.7 * $_GET['age']);
                    $sleepTime = $sleep != 0 ? $_GET['sleep'] : 24 - ($first + $second + $third + $fourth + $fifth);
                    $calorietotal = round($calorienopal * (($first*1.2 + $second*1.4 + $third*1.6 + $fourth*1.8 + $fifth*2 + $sleepTime*0.95) / 24));
                }

            }

            echo 'Grundverbrauch:<br>' . $calorienopal . ' kcal';
            echo '<br>';
            echo 'Gesamtverbrauch:<br>' . $calorietotal . ' kcal';
        ?>
    </p>
</body>
</html>