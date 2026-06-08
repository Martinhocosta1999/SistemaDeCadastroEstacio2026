<?php

class Usuario
{
    private $pdo;
    public $msgErro = "";

    public function conectar($nome, $host, $usuario, $senha)
    {
        global $pdo;
        try {
            $pdo = new PDO("mysql:dbname=" . $nome . ";host=" . $host, $usuario, $senha);
        } catch (PDOExeption $erro) {
            $msErro = $erro->getMessage();
        }
    }
    public function cadastrarUsuario($nome, $email, $telefone, $senha)
    {
        global $pdo;

        $usuario = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        $usuario->bindValue(":e", $email);
        $usuario->execute();

        if ($usuario->rowCount() > 0) {
            return false;
        } else {

            $usuario = $pdo->prepare(
                "INSERT INTO usuarios (nome, telefone, email, senha)
             VALUES (:n, :t, :e, :s)"
            );

            $usuario->bindValue(":n", $nome);
            $usuario->bindValue(":t", $telefone);
            $usuario->bindValue(":e", $email);
            $usuario->bindValue(":s", $senha);

            $usuario->execute();

            return true;
        }
    }
    public function listarUsuario()
    {
        $dados_usuarios = array();
        global $pdo;

        $sql = $pdo->prepare("SELECT * FROM usuarios ORDER BY nome");
        $sql->execute();

        $dados_usuarios = $sql->fetchALL(PDO::FETCH_ASSOC);

        return $dados_usuarios;
    }

    public function excluirUsuario($id_usuario)
    {
        global $pdo;
        $sql = $pdo->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
        $sql->bindValue(":id", $id_usuario);
        $sql->execute();

    }

    public function buscarDadosUsuario($id_usuario)
    {
        $dados_usuario = array();
        global $pdo;

        $sql = $pdo->prepare("SELECT * FROM  usuarios WHERE id_usuario = :id");
        $sql->bindValue(":id", $id_usuario);
        $sql->execute();

        $dados_usuario = $sql->fetch(PDO::FETCH_ASSOC);
        return $dados_usuario;
    }

    public function atualizarDadosUsuario($id_usuario, $nome, $email, $telefone)
    {
        global $pdo;
        $sql = $pdo->prepare("UPDATE usuarios SET nome = :n, email = :e, telefone = :t WHERE id_usuario = :id");
        $sql->bindValue(":n", $nome);
        $sql->bindValue(":e", $email);
        $sql->bindValue(":t", $telefone);
        $sql->bindValue("id", $id_usuario);
        $sql->execute();
    }

}


?>