<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
//CONFIGURAÇÕES BANCO DE DADOS

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agendamento_cabelo";

// CONEXÃO BANCO DE DADOS

$conn = new mysqli($servername,$username,$password,$dbname);

// VERIFICA SE A CONEXÃO FOI ESTABELECIDA CORRETAMENTE
if($conn->connect_error){
    die("Erro na conexão com banco de dados:" . $conn-> connect_error);

//PROCESSA O FORMULARIO QUANDO FOR ENVIADO

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $dataAgendamento = $_POST["data_agendamento"];
    $horario = $_POST["horario"];
}
 // Prepara a declaração SQL para inserção
 $sql = "INSERT INTO agendamentos (nome, email, telefone, data_agendamento, horario) VALUES (?, ?, ?, ?, ?)";
    
 // Prepara e executa a declaração SQL
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("sssss", $nome, $email, $telefone, $dataAgendamento, $horario);
 
 if ($stmt->execute()) {
     // Redireciona para uma página de confirmação
     header("Location: confirmacao.html");
     exit();
 } else {
     echo "Erro ao agendar o corte de cabelo: " . $stmt->error;
 }

 // Fecha a declaração e a conexão
 $stmt->close();
 $conn->close();
}
?>