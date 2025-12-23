<?php
require_once 'conexao.php';

//Define o tipo de resposta com JSON
header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $stmt = $pdo->query("SELECT alunos.id, alunos.nome, alunos.email, cursos.nome AS curso
                                FROM alunos
                                JOIN cursos ON alunos.curso_id = cursos.id; ");
        $alunos = $stmt->fetchAll();
        echo json_encode($alunos);
        break;

    case 'POST':
        $dados = json_decode(file_get_contents("php://input"), true);

        $nome = $dados['nome'] ?? '';
        $email = $dados['email'] ?? '';
        $curso_id = $dados['curso_id'] ?? 0;

        $stmt = $pdo->prepare("INSERT INTO alunos (nome, email, curso_id) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $email, $curso_id]);

        echo json_encode(["status" => "Aluno criado com sucesso"]);
        break;

    case 'PUT':
        $dados = json_decode(file_get_contents("php://input"), true);

        $id = $dados['id'] ?? 0;
        $nome = $dados['nome'] ?? '';
        $email = $dados['email'] ?? '';
        $curso_id = $dados['curso_id'] ?? 0;

        if (!$id) {
            echo json_encode(["error" => "ID inválido"]);
            exit;
        }

        $stmt = $pdo->prepare("UPDATE alunos SET nome=?, email=?, curso_id=? WHERE id=?");
        $stmt->execute([$nome, $email, $curso_id, $id]);

        echo json_encode(["status" => "Aluno atualizado com sucesso"]);
        break;

    case 'DELETE':
        $dados = json_decode(file_get_contents("php://input"), true);

        $id = $dados['id'] ?? 0;

        $stmt = $pdo->prepare("DELETE FROM alunos WHERE id=?");
        $stmt->execute([$id]);

        echo json_encode(["status" => "Aluno excluído com sucesso"]);
        break;

    default:
        echo json_encode(["error" => "Método não suportado"]);
}
