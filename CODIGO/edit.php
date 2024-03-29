<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $newFileName = $_POST['file_name'];

    $sqlSelect = "SELECT file_name FROM files WHERE id = $id";
    $resultSelect = pg_query($conn, $sqlSelect);
    if ($resultSelect) {
        $row = pg_fetch_assoc($resultSelect);
        $oldFileName = $row['file_name'];

        $oldFilePath = 'uploads/' . $oldFileName;
        $newFilePath = 'uploads/' . $newFileName;
        if (rename($oldFilePath, $newFilePath)) {
            $sqlUpdate = "UPDATE files SET file_name = '$newFileName' WHERE id = $id";
            if(pg_query($conn, $sqlUpdate)) {
                echo "<script>alert('Arquivo editado com sucesso!'); setTimeout(function(){ window.location.href = 'index.php'; }, 1000);</script>";
                exit();
            } 
            else {
                echo "Erro ao atualizar o nome do arquivo no banco de dados.";
            }
        }
         else {
            echo "Erro ao renomear o arquivo no diretório.";
        }
    } 
    else {
        echo "Erro ao selecionar o nome do arquivo do banco de dados.";
    }
} 
elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM files WHERE id = $id";
    $result = pg_query($conn, $sql);
    if(pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>EDIÇÃO</title>
    <style>
        body {
            background-color: #222;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            margin: 30px;
        }

        h2 {
            color: #00ff00;
            margin-top: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        form input[type="text"], form input[type="submit"] {
            background-color: #333;
            border: none;
            color: #fff;
            padding: 10px;
            margin-bottom: 10px;
        }

        form input[type="submit"] {
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>EDIÇÃO DO ARQUIVO</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    NOME: <input type="text" name="file_name" value="<?php echo $row['file_name']; ?>"><br><br>
    <input type="submit" value="SALVAR" name="submit">
</form>

</body>
</html>
<?php
    } else {
        echo "ARQUIVO NÃO EXISTE!";
    }
}
?>
