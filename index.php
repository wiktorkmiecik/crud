<!DOCTYPE html>
<html>
    <head>
        <title>Produkty</title>
        <meta charset="UTF-8" />
    </head>
    
<body>

    <h1>Lista rekordów</h1>
    
    <?php
    
        include('db_connect.php');
        
        if($result = $mysqli->query("SELECT * FROM products ORDER BY id")){
            
            if($result->num_rows > 0){
                
                echo "<table border='1' cellpadding='10'>";
                
                echo "<tr><th>ID</th><th>Nazwa</th><th>Kategoria</th></tr>";
                
                while($row = $result->fetch_object()){
                    echo "<tr>";
                    echo "<td>" . $row->id . "</td>";
                    echo "<td>" . $row->name. "</td>";
                    echo "<td>" . $row->category . "</td>";
                    echo "<td><a href='records.php?id=" . $row->id . "'>Edytuj</a></td>";
                    echo "<td><a href='delete.php?id=" . $row->id . "'>Usuń</a></td>";
                    echo "</tr>";
                }
                
                echo "</table>";
                
            } else {
                echo "Brak rekordów";
            }
            
        } else {
            echo "Błąd: " . $mysqli->error;
        }
        
        $mysqli->close();
    
    ?>
    
    <a href="records.php">Dodaj nowy produkt</a>

</body>

</html>