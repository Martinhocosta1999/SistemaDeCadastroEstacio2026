<?php
require '../Classes/usuario.php';
$usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2 class="titlo-page">CADASTRO DE USUARIO</h2>
    <a href="listar.php"><button>Listar Usuários</button></a>
    <form method="post">
        <input type="text" name="nome" id="" class="input-forms" placeholder="Digite seu nome.">
        <input type="tel" name="telefone" id="" class="input-forms" placeholder="Digite seu telefone.">
        <input type="email" name="email" id="" class="input-forms" placeholder="Digite seu email.">
        <input type="password" name="senha" id="" class="input-forms" placeholder="Digite seu senha.">
        <input type="password" name="confsenha" id="" class="input-forms" placeholder="Confirme sua senha.">
        <input type="submit" value="CADASTRAR">
        <P>Já é Cadastrado? Clique <a href="login.php">Aqui</a> para Acessar.</P>

    </form>

    <?php
    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $senha = $_POST['senha'];
        $confsenha = addslashes($_POST['confsenha']);

        if (!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha) && !empty($confsenha)) {
            $usuario->conectar("sistemacadastroestacio", "localhost", "root", "");
            if ($usuario->msgErro == "") {
                echo "conectou";
                if ($senha == $confsenha) {
                    if ($usuario->cadastrarUsuario($nome, $email, $telefone, $senha)) {
                        ?>
                        <div class="msg-usuario">
                            <p>Usuario Cadastrado com Sucesso!</p>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="msg-usuario">
                            <p>Usuario já esta Cadastrado!</p>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="msg-usuario">
                        <p>Senha e Comfirmar senha nao comfere!</p>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="msg-usuario">
                    <p>Erro de Conexão.</p>
                    <?php
                    echo "Erro: " . $usuario->msgErro;
                    ?>
                </div>

                <?php

            }
        } else {
            ?>
            <div class="msg-usuario">
                <p>Preencha Todos os Campos!</p>
            </div>

            <?php
        }

    }



    ?>

</body>

</html>