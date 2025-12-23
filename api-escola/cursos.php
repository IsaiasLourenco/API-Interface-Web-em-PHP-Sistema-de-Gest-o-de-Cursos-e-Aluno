<?php
require_once 'conexao.php';

header("Content-Type: application-json; charset=UTF-8");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET';
        $query = $pdo->query("SELECT * FROM cursos");
        $result = $query->fetchAll();
        echo json_encode($result);
        break;

    case 'POST':
        $dados = json_decode(file_get_contents("php://input"), true);

        $nome = $dados['nome'] ?? '';
        $descricao = $dados['descricao'] ?? '';
        $carga_horaria = $dados['carga_horaria'] ?? 0;

        $query = $pdo->prepare("INSERT INTO cursos (nome, descricao, carga_horaria) VALUES (?, ?, ?)");
        $query->execute([$nome, $descricao, $carga_horaria]);

        echo json_encode(["status" => "Curso criado com sucesso"]);
        break;

    case 'PUT':
        $dados = json_decode(file_get_contents("php://input"), true);

        $id = $dados['id'] ?? 0;
        $nome = $dados['nome'] ?? '';
        $descricao = $dados['descricao'] ?? '';
        $carga_horaria = $dados['carga_horaria'] ?? 0;

        if (!$id) {
            echo json_encode(["error" => "ID inválido"]);
            exit;
        }

        $query = $pdo->prepare("UPDATE cursos SET nome=?, descricao=?, carga_horaria=? WHERE id=?");
        $query->execute([$nome, $descricao, $carga_horaria, $id]);

        echo json_encode(["status" => "Curso atualizado com sucesso"]);
        break;

    case 'DELETE':
        $dados = json_decode(file_get_contents("php://input"), true);
        $id = $dados['id'] ?? 0;

        if (!$id) {
            echo json_encode(["error" => "ID inválido"]);
            exit;
        }

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM alunos WHERE curso_id=?");
        $stmt->execute([$id]);
        $qtdAlunos = $stmt->fetchColumn();

        if ($qtdAlunos > 0) {
            echo json_encode(["error" => "Não é possível excluir: existem alunos vinculados a este curso"]);
            exit;
        }

        $stmt = $pdo->prepare("DELETE FROM cursos WHERE id=?");
        $stmt->execute([$id]);

        echo json_encode(["status" => "Curso excluído com sucesso"]);
        break;

    default:
        echo json_encode(["error" => "Método não suportado"]);
}
