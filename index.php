<?php
/**
 * Teste - Back-end / Banco de dados
 * Lista as informações da tabela
 * @package backendvisie
 * @author Vinicius de Santana
 */
// abre conexão
$conn = new PDO('mysql:host=jobs.visie.com.br;'.
        'dbname=viniciussantana',
        'viniciussantana',
        'dmluaWNpdXNz');
// obtém dados
$stmt = $conn->prepare('SELECT id_pessoa,nome,data_admissao FROM pessoas;');
$stmt->execute();
$pessoas = $stmt->fetchAll(PDO::FETCH_ASSOC);
// fecha conexão
$conn = null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de pessoas</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <div class="d-flex w-100">
        <h1 class="m-md-auto">Lista de pessoas</h1>
    </div>
    <div class="d-flex w-100">
        <table class="m-md-auto lista">
            <thead>
                <th>Nome</th>
                <th>Data de admissão</th>
                <th>Opções</th>
            </thead>
            <?php
            foreach ($pessoas as $pessoa) {
                $primeiroNome = explode(' ', $pessoa['nome'])[0];
                $dateObj = new DateTime($pessoa['data_admissao']);
                $dataAdmBR = date('d/m/Y', $dateObj->getTimestamp());
            ?>
            <tbody>
                <td><?php echo $primeiroNome; ?></td>
                <td><?php echo $dataAdmBR;?></td>
                <td>
                    <form action="/delete.php" method="post">
                        <input type="hidden" name="id_pessoa" value="<?php echo $pessoa['id_pessoa']; ?>">
                        <input type="submit" value="Apagar">
                    </form>
                </td>
            </tbody>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="d-flex w-100">
        <h2 class="m-md-auto">Adicione uma pessoa</h2>
    </div>
    <div class="d-flex w-100">
        <form class="m-md-auto" action="/insert.php" method="post">
            <table>
                <tbody>
                    <td>
                        <label for="nome">Nome</label>
                    </td>
                    <td>
                        <input type="text" name="nome" id="nome">
                    </td>
                </tbody>
                <tbody>
                    <td>
                        <label for="rg">RG</label>
                    </td>
                    <td>
                        <input type="text" name="rg" id="rg">
                    </td>
                </tbody>
                <tbody>
                    <td>
                        <label for="cpf">CPF</label>
                    </td>
                    <td>
                        <input type="text" name="cpf" id="cpf">
                    </td>
                </tbody>
                <tbody>
                    <td>
                        <label for="data_nascimento">Data de nascimento</label>
                    </td>
                    <td>
                        <input type="date" name="data_nascimento" id="data_nascimento">
                    </td>
                </tbody>
                <tbody>
                    <td>
                        <label for="data_admissao">Data de admissão</label>
                    </td>
                    <td>
                        <input type="date" name="data_admissao" id="data_admissao">
                    </td>
                </tbody>
                <tbody>
                    <td>
                        <label for="funcao">Função</label>
                    </td>
                    <td>
                        <input type="text" name="funcao" id="funcao">
                    </td>
                </tbody>
            </table>
            <input type="submit" value="Criar novo">
        </form>
    </div>
</body>
</html>