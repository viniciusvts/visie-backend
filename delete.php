<?php
/**
 * Teste - Back-end / Banco de dados
 * Recebe o id do item da tabela e o deleta
 * @package backendvisie
 * @author Vinicius de Santana
 */
// abre conexão
$conn = new PDO('mysql:host=jobs.visie.com.br;'.
        'dbname=viniciussantana',
        'viniciussantana',
        'dmluaWNpdXNz');
// deleta dados
$id = $_POST['id_pessoa'];
$stmt = $conn->prepare('DELETE FROM pessoas WHERE id_pessoa=:id;');
$stmt->bindParam(':id', $id);
$stmt->execute();
// fecha conexão
$conn = null;
// se deletou redireciona
var_dump($stmt->rowCount());
if($stmt->rowCount() > 0){
    header('Location: /index.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro ao deletar</title>
</head>
<body>
    <h1>Houve um erro!</h1>
    <p>Houve um erro ao deletar o item, tente novamente mais tarde</p>
</body>
</html>
<?php
}