# Lupiere - E-commerce PHP Refatorado

Este é o projeto Lupiere refatorado seguindo padrões profissionais de segurança, organização e desempenho.

## Estrutura de Pastas

```
/lupiere
│
├── /admin                 # Painel administrativo
│   ├── index.php          # Dashboard
│   ├── produtos.php       # CRUD de produtos
│   ├── categorias.php     # CRUD de categorias
│   ├── pedidos.php        # Visualização de pedidos
│   └── ...                # Outros arquivos admin
│
├ /assets
│   ├── /css               # CSS customizado
│   ├── /js                # JavaScript customizado
│   └── /img               # Imagens estáticas (logos, ícones)
│
├ /includes                # Componentes reutilizáveis
│   ├── header.php
│   ├── footer.php
│   └── navbar.php
│
├ /uploads                 # Uploads de imagens (produtos)
│
├ config.php               # Configuração de banco de dados (PDO)
├ funcoes.php              # Funções helper e de acesso ao banco
├ index.php                # Página inicial (dinâmica)
├ produtos.php             # Lista de produtos (com busca, filtro, paginação)
├ produto.php              # Página de produto único
├ sobre.php                # Página sobre
├ contato.php              # Página de contato
├ carrinho.php             # Visualização do carrinho
├ adicionar_carrinho.php   # Adicionar produto ao carrinho (AJAX)
├ checkout.php             # Página de checkout
├ finalizar.php            # Processar finalização da compra
├ historico.php            # Histórico de pedidos do usuário
├ perfil.php               # Edição de perfil do usuário
├ login.php                # Autenticação
├ registrar.php            # Cadastro de novos usuários
├ logout.php               # Logout
└── .htaccess              # Regras de rewrite (opcional)
```

## Principais Melhorias

1. **Segurança**
   - Todas as queries utilizam prepared statements (PDO)
   - Validação e sanitização de inputs
   - Proteção contra SQL Injection e XSS
   - Senhas armazenadas com `password_hash`
   - Verificação de sessão e privilégios de admin

2. **Organização**
   - Separação de componentes (header, footer, navbar)
   - Pastas padronizadas para assets, uploads, includes
   - Código PHP limpo e comentado

3. **Funcionalidades**
   - Sistema completo de pedidos com histórico
   - Upload de imagens com validação
   - Busca, filtro por categoria e paginação
   - Páginas estáticas convertidas para dinâmicas
   - Carrinho de compras armazenado em sessão

4. **Responsividade**
   - Layout baseado em Tailwind CSS
   - Adaptado para mobile e tablet

## Instalação

1. Importe o banco de dados usando o arquivo `database.sql` (fornecido separadamente)
2. Configure o acesso ao banco em `config.php` (se necessário)
3. Coloque o projeto no diretório raíz do servidor (ex: `htdocs/lupiere`)
4. Acesse `http://localhost/lupiere`

## Créditos

Projeto refatorado por arquiteto Full Stack sênior.