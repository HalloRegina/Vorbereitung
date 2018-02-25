<a href="index.php">Back</a>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form method="post">
            <input type="text" name="Schauspieler" placeholder="Bitte suchen sie nach den gewünschten Schauspieler" />
            <input type="submit" value="Suchen" name="submit" />
        </form>
        <?php
        include 'config.php';
        if (isset($_POST['submit'])) {
            try {
                echo '<table border = "1px">';
                echo '<tr><td>Titel</td><td>Bezeichnung</td><td>Vorname</td><td>Nachname</td></tr>';
                $person = '%' . $_POST['Schauspieler'] . '%';
                $query = ("select titel, Bezeichnung, Vorname, Nachname from produktionsfirma natural join film natural join Schauspieler_has_Film natural join Schauspieler where Vorname like :person or Nachname like :person;");
                $stmt = $con->prepare($query);
                $stmt->bindValue(':person', $person, PDO::PARAM_STR);
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
                    echo $row['Vorname'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['Nachname'];
                    echo '</td>';
                    echo '</tr>';
                }
            } catch (PDOException $ex) {
                echo "Something messed up!"; //Some user friendly message
                write_error_to_log($ex->getMessage()); //This is a function which you can create yourself to write errors to an external log file.
            }
        }
        ?>
    </body>
</html>
