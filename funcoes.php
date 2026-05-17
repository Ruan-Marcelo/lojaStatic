<?php

require_once 'config.php';

function conectar_db() {
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
  }
  return $conn;
}

function executar_sql($sql) {
  $conn = conectar_db();
  $result = $conn->query($sql);
  $conn->close();
  return $result;
}

function obter_usuario_por_email($email) {
  $conn = conectar_db();
  $sql = "SELECT * FROM usuarios WHERE email = '$email'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
  } else {
    $usuario = null;
  }
  $conn->close();
  return $usuario;
}

function obter_produtos() {
  $conn = conectar_db();
  $sql = "SELECT p.*, c.nome AS categoria_nome FROM produtos p LEFT JOIN categorias c ON p.categoria_id = c.id";
  $result = $conn->query($sql);
  $produtos = [];
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $produtos[] = $row;
    }
  }
  $conn->close();
  return $produtos;
}

function obter_produto_por_id($id) {
  $conn = conectar_db();
  $sql = "SELECT p.*, c.nome AS categoria_nome FROM produtos p LEFT JOIN categorias c ON p.categoria_id = c.id WHERE p.id = $id";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $produto = $result->fetch_assoc();
  } else {
    $produto = null;
  }
  $conn->close();
  return $produto;
}

function obter_categorias() {
  $conn = conectar_db();
  $sql = "SELECT * FROM categorias";
  $result = $conn->query($sql);
  $categorias = [];
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $categorias[] = $row;
    }
  }
  $conn->close();
  return $categorias;
}

?>