<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "nautical_industry_db"; 

$conn = mysqli_connect($servername, $username, $password, $database); 

if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error()); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_atividade'])) {
    $atividade_nome = $_POST['nome']; 
    $atividade_funcionario = $_POST['funcionario']; 
    $atividade_detalhes = $_POST['detalhes']; 
    $numero = $_POST['numero']; 

    $sql = "UPDATE atividades SET nome = '$atividade_nome', funcionario = '$atividade_funcionario', detalhes = '$atividade_detalhes' WHERE numero = $numero";

    if (mysqli_query($conn, $sql)) {
        header("Location: inicio.php"); 
        exit();
    } else {
        echo "Erro ao editar atividade: " . mysqli_error($conn); 
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['numero'])) {
    $numero = $_GET['numero']; 

    $sql = "SELECT * FROM atividades WHERE numero = $numero"; 
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $atividade = mysqli_fetch_assoc($result); 
    } else {
        die("Erro na consulta SQL: " . mysqli_error($conn)); 
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="/Estilos/estilos.css"> 
    <meta charset="UTF-8"> 
    <title>Editar Atividade</title> 
</head>

<body>
    <h1>Editar Atividade</h1>

    <form action="" method="post">
        <input type="hidden" name="numero" value="<?php echo $atividade['numero']; ?>"> 
        Nome da Atividade: <input type="text" name="nome" value="<?php echo $atividade['nome']; ?>"><br> 
        Funcionário: <input type="text" name="funcionario" value="<?php echo $atividade['funcionario']; ?>"><br> 
        Detalhes: <input type="text" name="detalhes" value="<?php echo $atividade['detalhes']; ?>"><br> 
        <input type="submit" name="editar_atividade" value="Salvar Edições">
    </form>
</body>

</html>