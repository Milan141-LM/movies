<?php
$host = "mi-Linux.wlv.ac.uk";
$username = "2410675";
$password = "PROXY@68#[68]";
$database = "db2410675";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$sql = "SELECT Movie_name, Genre, Price, Date_of_release
        FROM movies
        ORDER BY Movie_name";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie List</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            max-width: 900px;
            border-collapse: collapse;
            background-color: white;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #eeeeee;
        }
    </style>
</head>

<body>
    <h1>Movie List</h1>

    <table>
        <thead>
            <tr>
                <th>Movie name</th>
                <th>Genre</th>
                <th>Price</th>
                <th>Date of release</th>
            </tr>
        </thead>

        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($movie = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars($movie["Movie_name"]) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($movie["Genre"]) ?>
                        </td>
                        <td>
                            £<?= number_format((float) $movie["Price"], 2) ?>
                        </td>
                        <td>
                            <?= date(
                                "d/m/Y",
                                strtotime($movie["Date_of_release"])
                            ) ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No movies were found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
