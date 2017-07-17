<Doctype! html>
<html>
<head>
    <title>Produkty</title>
    <meta charset="utf-8" />
</head>

<body>

    <h1>Lista rekordów</h1>
    
    <?php
    
        include('db_connect.php');
        
        $records_per_page = 3;
        
        if($result = $mysqli->query("SELECT * FROM products ORDER BY id")){
            if($result->num_rows != 0){
                $total_records = $result->num_rows;
                $total_pages = ceil($total_records / $records_per_page);
                
                if(isset($_GET['page']) && is_numeric($_GET['page'])){
                    
                    $show_page = $_GET['page'];
                    
                    if($show_page > 0 && $show_page <= $total_pages){
                        $start = ($show_page-1) * $records_per_page;
                        $end = $start + $records_per_page;
                    } else {
                        $start = 0;
                        $end = $records_per_page;
                    }
                } else {
                    $start = 0;
                    $end = $records_per_page;
                }
                echo "<p><a href='index.php'>Zobacz wszystko</a> | Zobacz stronę: ";
                for($i = 1; $i <= $total_pages; $i++){
                        if(isset($_GET['page']) && $_GET['page'] == $i){
                            echo $i . " ";
                        } else {
                            echo "<a href='index_p.php?page=$i'>" . $i . "</a>";
                        }
                    }
                echo "</p>";
                
                echo "<table border='1' cellpadding='10'>";
                echo "<tr><th>ID</th><th>Nazwa</th><th>Kategoria</th></tr>";
                for($i = $start; $i < $end; $i++){
                    if($i == $total_records) {break;}
                    
                    $result->data_seek($i);
                    $row = $result->fetch_row();
                    "<tr>";
                    echo "<td>" . $row[0] . "</td>";
                    echo "<td>" . $row[1] . "</td>";
                    echo "<td>" . $row[2] . "</td>";
                    echo "<td><a href='records.php?id='" . $row[0] . "'>Edytuj</a></td>";
                    echo "<td><a href='delete.php?id='" . $row[0] . "'>Usuń</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
                    
                
                
            } else {
                echo "Brak rekordów";
            }
        } else {
            echo "Błąd zapytania";
        }
        
        $mysqli->close();
    
    ?>
    
    <a href="records.php">Dodaj nowy produkt</a>

</body>
</html>