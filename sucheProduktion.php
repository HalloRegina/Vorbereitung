<a href="index.php">Back</a>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form method="post">
            <br><input type="text" name="company" Placeholder="Please insert your search" /><br>
            <input type="submit" value="Search" name="submit"/>
            <button type="button" value="Cancel" name="cancel"><a href= index.php>Abbrechen</a></button>           
        </form>



        <?php
        if (isset($_POST["submit"])) {
            try {
                if ($_POST['company'] == '') {
                    echo 'Leeeeeeeeeeeeeer';
                } else {
                    include 'config.php';
                    echo '<table border = "1px">';
                    echo '<tr><td>Titel</td><td>Bezeichnung</td><td>Date</td></tr>';
                    $company = '%' . $_POST['company'] . '%';
                    $query = ("select titel, Bezeichnung, Date from produktionsfirma natural join film where Bezeichnung like :company;");
                    $stmt = $con->prepare($query);
                    $stmt->bindValue(':company', $company, PDO::PARAM_STR);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>';
                        echo $row['titel'];
                        echo '</td>';
                        echo '<td>';
                        echo $row['Bezeichnung'];
                        echo '</td>';
                        echo '<td>';
                        echo $row['Date'];
                        echo '</td>';
                        echo '</tr>';
                        $com = $row['Bezeichnung'];
                    }
                    if ($stmt->rowCount() == 0) {
                        echo 'Es wurde kein Film gefunden, leider';
                    } else {
                        echo 'Es wurden ' . $stmt->rowCount() . ' Filme gefunden';
                        echo "<br>";
                        echo 'Es wurde nach ' . $_POST["company"] . ' gesucht';
                        echo "<br>";
                        echo 'Es wurde ' . $com . ' gefunden';
                        echo "<br>";
                    }
                }
            } catch (PDOException $ex) {
                echo "Something messed up!"; //Some user friendly message
                write_error_to_log($ex->getMessage());
            }
        }
        ?>
    </table>
</body>
</html>
