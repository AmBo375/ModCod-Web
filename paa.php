<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tableau</title>
        <style media="all">
            td, th {
                border: 1px solid black;
            }
            table {
                border-collapse: collapse;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <main id="main-content">
                <div id="table-container">
                    <?php
                    session_start();
                    $status = $_SESSION['status'];
                    $conn = mysqli_connect("localhost", "root", "", "MODCOD");
                    if (!$conn) {
                        echo "NO CONNECTION";
                    }
                    $stmt = "SELECT ref, refM, obj, dateLimit, prosp, edit, context FROM paa";
                    $res = $conn->query($stmt);
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Référence</th>
                                <th>Réference MODCOD</th>
                                <th>Objet</th>
                                <th>Date limite de réponse</th>
                                <th>Prospectus</th>
                                <th>Éditeur</th>
                                <th>Contexte</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $res->fetch_assoc()) {
                                $i = 0;
                                echo "<tr>";
                                echo "<td>" . $row['ref'] . "</td>";
                                echo "<td>" . $row['refM'] . "</td>";
                                echo "<td>" . $row['obj'] . "</td>";
                                echo "<td>" . $row['dateLimit'] . "</td>";
                                echo "<td>" . $row['prosp'] . "</td>";
                                echo "<td>" . $row['edit'] . "</td>";
                                echo "<td>" . $row['context'] . "</td>";
                                echo "<td><form method='post'><input type='button' name='$i' value='Delete' onclick='deletebtn(this)'/></td>";
                                if (isset($_POST['$i'])) {
                                    echo "Done!";
                                }
                                echo "</tr>";
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <button id="download-button">Add</button>
            </main>
        </div>
    </body>
<script src="tab.js"></script>
</html>
