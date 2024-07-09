<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tableau</title>
        <link rel="stylesheet" href="../style.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <style media="all">
            td, th {
                border: 1px solid black;
            }
            table {
                border-collapse: collapse;
            }
        </style>
        <script src="../tab.js"></script>
    </head>
    <body>
    <?php
    include_once '../dbConnect.php';
    $stmt = 'SELECT * FROM pec where id = ?';
    $res = $conn->prepare($stmt);
    $res->bind_param("s", $_GET['id']);
    $res->execute();
    $result = $res->get_result();
    $current = $result->fetch_assoc();
    ?>
        <form method="post" action="">
            <fieldset>
                Référence:
                <label>
                    <input type="text" value="<?=$current['ref']?>" name="ref">
                </label>
                <br>
                Référence MODCOD:
                <label>
                    <input type="text" value="<?=$current['refM']?>" name="refM">
                </label>
                <br>
                Objet:
                <label>
                    <input type="text" value="<?=$current['obj']?>" name="obj">
                </label>
                <br> Date Limite de Réponse:
                <label>
                    <input type="datetime-local" value="<?=$current['dateLimit']?>" name="limit">
                </label>
                <br>
                <br>
                Caution:<br>
                <label>
                    <input type="text" value="<?=$current['caution']?>" name="caution">
                </label>
                <br>
                Délai d'exécution:<br>
                <label>
                    <input type="text" value="<?=$current['execDelay']?>" name="execDelay">
                </label>
                Prospectus:
                <label>
                    <input type="date" value="<?=$current['prosp']?>" name="prosp">
                </label>
                <br>
                Éditeur:
                <label>
                    <input type="text" value="<?=$current['edit']?>" name="edit">
                </label>
                <br>
                Contexte:
                <label>
                    <input type="text" value="<?=$current['context']?>" name="context">
                </label>
                <br><br>
                <input type="submit" name="update" value="Edit">
            </fieldset>
        </form>
    <?php

    if (isset($_POST['update'])){
        $ref = $_POST['ref'];
        $refM = $_POST['refM'];
        $obj = $_POST['obj'];
        $limit  = $_POST['limit'];
        $caution = $_POST['caution'];
        $execDelay = $_POST['execDelay'];
        $prosp = $_POST['prosp'];
        $edit  = $_POST['edit'];
        $context = $_POST['context'];

        $sql = "UPDATE pec SET ref = ?, refM = ?, obj = ?, dateLimit = ?, caution = ?, execDelay = ?, prosp = ?, edit = ?, context = ? WHERE id = ?";
        $stm = $conn->prepare($sql);
        $stm->bind_param("sssssssssi", $ref, $refM, $obj, $limit, $caution, $execDelay, $prosp, $edit, $context, $_GET['id']);
        $success = $stm->execute();
        if ($success) {
            header('location: ../pec.php');
        }
        $stm->close();
    }
    $conn->close();
    ?>
    </body>
</html>