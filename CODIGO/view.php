<!DOCTYPE html>
<html>
<head>
    <title>VIZUALIZAR</title>
    <style>
        body {
            background-color: #222;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 10px;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
        }

        img {
            max-width: 100%;
            height: auto;
            border: 1px solid #555;
            margin-bottom: 20px;
        }

        .back-button {
            background-color: #333;
            border: none;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    include 'config.php';

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT file_name FROM files WHERE id = $id";
        $result = pg_query($conn, $sql);
        if(pg_num_rows($result) > 0) {
            $row = pg_fetch_assoc($result);
            $filePath = 'uploads/' . $row['file_name'];
            echo "<img src='$filePath' alt='File Image'>";
        } else {
            echo "File not found.";
        }
    }
    ?>
    <br>
    <a href="index.php" class="back-button">VOLTAR</a>
</div>

</body>
</html>
