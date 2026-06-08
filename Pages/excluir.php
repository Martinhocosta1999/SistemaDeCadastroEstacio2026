<?php
require "../Classes/usuario.php";
$usuario = new Usuario();
$usuario->conectar("sistemacadastroestacio", "localhost", "root", "");

if (isset($_GET['id_usuario'])) {
    $id_usuario = addslashes($_GET['id_usuario']);
    $usuario->excluirUsuario($id_usuario);
}
header("location:listar.php");
?>