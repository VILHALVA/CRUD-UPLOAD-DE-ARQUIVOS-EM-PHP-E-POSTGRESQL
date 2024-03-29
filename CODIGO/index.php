<!DOCTYPE html>
<html>
<head>
    <title>CRUD DE UPLOAD</title>
    <style>
        body {
            background-color: #222;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            margin: 10px;
        }

        h2 {
            color: #00ff00;
            margin-top: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        form input[type="file"], form input[type="submit"] {
            background-color: #333;
            border: none;
            color: #fff;
            padding: 10px;
            margin-bottom: 10px;
        }

        form input[type="file"] {
            width: 300px;
        }

        form input[type="submit"] {
            cursor: pointer;
        }

        hr {
            border-color: #666;
            margin: 20px 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #444;
        }

        tr:hover {
            background-color: #555;
        }

        a {
            color: #00ff00;
            text-decoration: none;
        }

        a:hover {
            color: #00dd00;
        }
    </style>
</head>
<body>

<h2>ENVIAR ARQUIVOS</h2>
<form action="upload.php" method="post" enctype="multipart/form-data">
    UPLOAD:
    <input type="file" name="fileToUpload" id="fileToUpload"> <br>
    <input type="submit" value="ENVIAR" name="submit">
</form>

<hr>

<h2>ARQUIVOS</h2>
<table>
    <tr>
        <th>ID</th>
        <th>NOME</th>
        <th>TAMANHO</th>
        <th>TIPO</th>
        <th>DATA</th>
        <th>AÇÃO</th>
    </tr>
    <?php
    include 'config.php';
    $sql = "SELECT * FROM files";
    $result = pg_query($conn, $sql);
    
    // Verifica se há registros retornados
    if ($result) {
        while ($row = pg_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['file_name'] . "</td>";
            echo "<td>" . $row['file_size'] . "</td>";
            echo "<td>" . $row['file_type'] . "</td>";
            echo "<td>" . $row['uploaded_at'] . "</td>";
            echo "<td>";
            echo "<a href='view.php?id=" . $row['id'] . "'>VER</a>";
            echo " | <a href='delete.php?id=" . $row['id'] . "'>APAGAR</a>";
            echo " | <a href='edit.php?id=" . $row['id'] . "'>EDITAR</a>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "Nenhum arquivo encontrado.";
    }
    ?>
</table>
</body>
</html>
