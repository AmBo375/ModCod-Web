<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tableau</title>
        <link rel="stylesheet" href="style.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <style media="all">
            td, th {
                border: 1px solid black;
            }
            table {
                border-collapse: collapse;
            }
        </style>
        <script src="tab.js"></script>
        <script>
            function checkDelete(id) {
                if (confirm('Are you sure you want to delete?')) {
                    urlDel = "CRUD_PEC/deleteRecord.php?id=" + id;
                    location.href = urlDel;
                }
            }
        </script>
    </head>
    <body>
        <button onclick="popup()">New</button>
        <div class="center" style="display: none">
            <button onclick="closePopup()" style="float: right">X</button>
            <form method="post" action="CRUD_PEC/addRecord.php">
                <fieldset>
                    Référence:<br>
                    <label>
                        <input type="text" name="ref">
                    </label>
                    <br>
                    Référence MODCOD:<br>
                    <label>
                        <input type="text" name="refM">
                    </label>
                    <br>
                    Objet:<br>
                    <label>
                        <input type="text" name="obj">
                    </label>
                    <br> Date Limite de Réponse:<br>
                    <label>
                        <input type="datetime-local" name="limit">
                    </label>
                    <br>
                    Caution:<br>
                    <label>
                        <input type="text" name="caution">
                    </label>
                    <br>
                    Délai d'exécution:<br>
                    <label>
                        <input type="text" name="execDelay">
                    </label>
                    <br>
                    Prospectus:<br>
                    <label>
                        <input type="date" name="prosp">
                    </label>
                    <br>
                    Éditeur:<br>
                    <label>
                        <input type="text" name="edit">
                    </label>
                    <br>
                    Contexte:<br>
                    <label>
                        <input type="text" name="context">
                    </label>
                    <br><br>
                    <input type="submit" name="submit" value="Submit">
                </fieldset>
            </form>
        </div>
        <div class="main">
            <p id="center"></p>
            <table>
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Réference MODCOD</th>
                        <th>Objet</th>
                        <th>Date limite de réponse</th>
                        <th>Caution</th>
                        <th>Délai d'exécution</th>
                        <th>Prospectus</th>
                        <th>Éditeur</th>
                        <th>Contexte</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once 'dbConnect.php';
                    $stmt = 'SELECT * FROM pec';
                    $res = $conn->query($stmt);
                    while($row = $res->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>" . $row['ref'] . "</td>";
                        echo "<td>" . $row['refM'] . "</td>";
                        echo "<td>" . $row['obj'] . "</td>";
                        echo "<td>" . $row['dateLimit'] . "</td>";
                        echo "<td>" . $row['caution'] . "</td>";
                        echo "<td>" . $row['execDelay'] . "</td>";
                        echo "<td>" . $row['prosp'] . "</td>";
                        echo "<td>" . $row['edit'] . "</td>";
                        echo "<td>" . $row['context'] . "</td>";
                        echo "<td><a href='CRUD_PEC/updateRecord.php?id=".$row['id']."'>Edit</a> 
                        <a onclick='checkDelete(".$row['id'].")'>Delete</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
