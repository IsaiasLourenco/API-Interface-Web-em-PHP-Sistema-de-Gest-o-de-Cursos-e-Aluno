# 📘 API Escola – Gestão de Cursos e Alunos
Este projeto é uma aplicação simples e funcional para gestão de cursos e alunos, construída com:
- PHP (API REST)
- MySQL (PDO)
- HTML + CSS + JavaScript (Frontend)
- Fetch API (consumo da API)
- Modais para edição (UI moderna)
O objetivo é fornecer uma base sólida para CRUDs e servir como API externa para integração com o Moodle.

## 🚀 Funcionalidades
### ✔ Cursos
- Listar cursos
- Adicionar curso
- Editar curso (com modal)
- Excluir curso
- Validação para impedir exclusão se houver alunos vinculados
### ✔ Alunos
- Listar alunos
- Adicionar aluno
- Editar aluno (com modal)
- Excluir aluno
- Select dinâmico com cursos disponíveis
- Exibição do nome do curso via JOIN

## 📂 Estrutura de Pastas
api-escola/<br>
│<br>
├── index.html              # Gestão de cursos<br>
├── alunos.html             # Gestão de alunos<br>
├── style.css               # Estilos gerais<br>
│<br>
├── cursos.php              # API REST de cursos<br>
├── alunos.php              # API REST de alunos<br>
├── conexao.php             # Conexão PDO com MySQL<br>
│<br>
└── README.md               # Este arquivo<br>



## 🛠️ Tecnologias Utilizadas
- PHP 8+
- MySQL
- PDO
- HTML5
- CSS3
- JavaScript (ES6+)
- Fetch API

## 🗄️ Configuração do Banco de Dados
Crie um banco chamado escola:
```
CREATE DATABASE escola;
USE escola;
```

Tabela cursos:
```
CREATE TABLE cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    carga_horaria INT NOT NULL
);
```

Tabela alunos:
```
CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    curso_id INT NOT NULL,
    FOREIGN KEY (curso_id) REFERENCES cursos(id)
);
```

## 🔌 Configuração da Conexão (conexao.php)
$host = 'localhost';<br>
$dbname = 'escola';<br>
$user = 'root';<br>
$senha = '';<br>
$charset = 'utf8mb4';


Ajuste conforme seu ambiente.

## 🌐 Endpoints da API
### 📘 Cursos – /cursos.php
| Método | Descrição | Corpo da Requisição |
|--------|-----------|----------------------|
| **GET** | Lista todos os cursos | — |
| **POST** | Cria um novo curso | `{ "nome": "", "descricao": "", "carga_horaria": 0 }` |
| **PUT** | Atualiza um curso existente | `{ "id": 0, "nome": "", "descricao": "", "carga_horaria": 0 }` |
| **DELETE** | Remove um curso (se não houver alunos vinculados) | `{ "id": 0 }` |

### 📗 Alunos – /alunos.php
| Método | Descrição | Corpo da Requisição |
|--------|-----------|----------------------|
| **GET** | Lista todos os alunos com nome do curso | — |
| **POST** | Cria um novo aluno | `{ "nome": "", "email": "", "curso_id": 0 }` |
| **PUT** | Atualiza um aluno existente | `{ "id": 0, "nome": "", "email": "", "curso_id": 0 }` |
| **DELETE** | Remove um aluno | `{ "id": 0 }` |




## 🖥️ Frontend
### O frontend é totalmente estático e utiliza:
- Fetch API para consumir a API
- Modais para edição
- Select dinâmico para cursos
- UI moderna com CSS customizado
### Exemplos de telas:
- Cadastro de cursos
- Cadastro de alunos
- Listagem com botões de ação
- Modal de edição com ESC para fechar

### 🔄 Fluxo de Funcionamento
- O usuário acessa index.html ou alunos.html
- O JavaScript carrega dados da API via fetch()
- O usuário pode adicionar, editar ou excluir
- A API responde em JSON
- A interface atualiza automaticamente

## 🎯 Objetivo Futuro
### Este projeto será utilizado como API externa para integração com o Moodle, permitindo:
- Sincronização de cursos
- Sincronização de alunos
- Criação automática de usuários no Moodle
- Integração via plugin local

## 🤝 Contribuição
Sinta-se à vontade para melhorar o layout, adicionar autenticação, logs, paginação ou qualquer outro recurso.

## 📄 Licença
Uso livre para estudos e projetos pessoais.

## Feito por

- **Isaias Lourenço**  
© Vetor256 — [https://vetor256.com](https://vetor256.com)