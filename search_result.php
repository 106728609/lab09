<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
</head>
<body>

    <h1>Search Results</h1>

    <?php
    require_once "settings.php";

    $conn = mysqli_connect($host, $user, $pwd, $sql_db);

    if ($conn) {
        if (isset($_GET['model']) && trim($_GET['model']) != "") {

            $model = mysqli_real_escape_string($conn, trim($_GET['model']));

            $sql = "SELECT * FROM cars WHERE model LIKE '%$model%'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {

                    echo "<table border='1' cellpadding='5'>";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Make</th>";
                    echo "<th>Model</th>";
                    echo "<th>Price</th>";
                    echo "<th>Year</th>";
                    echo "</tr>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row['make'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row['model'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row['yom'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "</tr>";
                    }

                    echo "</table>";

                } else {
                    echo "<p>No matching cars found.</p>";
                }

                mysqli_free_result($result);

            } else {
                echo "<p>Error executing the search query.</p>";
            }

        } else {
            echo "<p>Please enter a model to search.</p>";
        }

        mysqli_close($conn);

    } else {
        echo "<p>Unable to connect to the database.</p>";
    }
    ?>

    <br>
    <a href="search_form.php">Back to Search</a>

</body>
</html>