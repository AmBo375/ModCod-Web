<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau</title>
    <link rel="stylesheet" href="style_tab.css">
</head>
<body>

<div class="container">

    <main id="main-content">
        <div id="table-container">
            <?php
            require 'xl/vendor/autoload.php';

            use PhpOffice\PhpSpreadsheet\IOFactory;

            $spreadsheet = IOFactory::load('tab.xlsx');
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();

            echo '<table>';
            // Affichage des entêtes de colonnes
            echo '<tr>';
            $headers = [];
            foreach ($sheet->getRowIterator() as $row) {
                foreach ($row->getCellIterator() as $cell) {
                    $headerValue = htmlspecialchars($cell->getValue());
                    $headers[] = $headerValue;
                    echo '<th>' . $headerValue . '</th>';
                }
                break; // Sortir après la première ligne pour les entêtes
            }
            
            
            // Affichage des données
            foreach ($data as $rowIndex => $row) {
                echo '<tr>';
                foreach ($row as $cell) {
                    echo '<td>' . htmlspecialchars($cell) . '</td>';
                }
                echo '<td class="actions">';
                echo '<button class="edit" data-row="' . $rowIndex . '">Edit</button>';
                echo '<button class="delete" data-row="' . $rowIndex . '">Delete</button>';
                echo '<button class="view" data-row="' . $rowIndex . '">View</button>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
            ?>
        </div>
        <button id="download-button">Télécharger le fichier mis à jour</button>
        <div id="details-container"></div>
    </main>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script src="script_tab.js"></script>
</body>
</html>
