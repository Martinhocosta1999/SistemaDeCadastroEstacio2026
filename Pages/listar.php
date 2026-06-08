<?php
require "../Classes/usuario.php";
$usuario = new Usuario();
$usuario->conectar("sistemacadastroestacio", "localhost", "root", "");

$dados = $usuario->listarUsuario();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Ususario</title>
</head>

<body>
    <h2 class="titlo-page">LISTAR USUARIO</h2>
    <a href="cadastro.php"><button>Cadastrar Usuários</button></a>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php
        foreach ($dados as $pessoa) {
            ?>
            <tbody>
                <tr>
                    <td>
                        <!--Id do usuário -->
                        <?php echo $pessoa['id_usuario'] ?>
                    </td>
                    <td>
                        <!--nome do usuário -->
                        <?php echo $pessoa['nome'] ?>
                    </td>
                    <td>
                        <!--telefone do usuário -->
                        <?php echo $pessoa['telefone'] ?>
                    </td>
                    <td>
                        <!--email do usuário -->
                        <?php echo $pessoa['email'] ?>
                    </td>
                    <td>
                        <!--Açoes do usuário -->
                        <a href="editar.php?id_usuario=<?php echo $pessoa['id_usuario'] ?>">Editar</a>
                        <a href="excluir.php?id_usuario=<?php echo $pessoa['id_usuario'] ?>">Excluir</a>
                    </td>
                </tr>
            </tbody>
            <?php
        }
        ?>
    </table>

</body>

</html>