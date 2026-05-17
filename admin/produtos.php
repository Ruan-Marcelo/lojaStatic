<?php
session_start();
require_once '../funcoes.php';

// Verificar se o usuário está logado
if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}

// Processar ações de produtos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'create') {
            // Criar novo produto
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $preco = floatval($_POST['preco']);
            $categoria_id = intval($_POST['categoria_id']);
            $estoque = intval($_POST['estoque']);
            $imagem = $_POST['imagem'] ?? 'https://via.placeholder.com/400';

            $conn = conectar_db();
            $sql = "INSERT INTO produtos (nome, descricao, preco, categoria_id, imagem, estoque)
                    VALUES ('$nome', '$descricao', $preco, $categoria_id, '$imagem', $estoque)";
            if ($conn->query($sql) === TRUE) {
                $sucesso = "Produto criado com sucesso!";
            } else {
                $erro = "Erro ao criar produto: " . $conn->error;
            }
            $conn->close();
        } elseif ($_POST['action'] == 'update') {
            // Atualizar produto existente
            $id = intval($_POST['id']);
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $preco = floatval($_POST['preco']);
            $categoria_id = intval($_POST['categoria_id']);
            $estoque = intval($_POST['estoque']);
            $imagem = $_POST['imagem'] ?? 'https://via.placeholder.com/400';

            $conn = conectar_db();
            $sql = "UPDATE produtos SET nome='$nome', descricao='$descricao', preco=$preco,
                    categoria_id=$categoria_id, imagem='$imagem', estoque=$estoque WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                $sucesso = "Produto atualizado com sucesso!";
            } else {
                $erro = "Erro ao atualizar produto: " . $conn->error;
            }
            $conn->close();
        }
    }
}

// Buscar produto para edição se ID for fornecido
$produto_editar = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $produto_editar = obter_produto_por_id($id);
}

// Buscar todos os produtos e categorias
$produtos = obter_produtos();
$categorias = obter_categorias();
?>
<!doctype html>
<html class="light" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>LUPIÈRE | Gerenciar Produtos</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&amp;family=Noto+Serif:wght@400;700&amp;display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
      rel="stylesheet"
    />
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "on-error": "#ffffff",
              "surface-container-high": "#e9e8e3",
              "surface-container": "#efeee9",
              surface: "#faf9f4",
              "on-secondary-container": "#745c00",
              "secondary-container": "#fed65b",
              "on-primary-container": "#819986",
              "on-tertiary": "#ffffff",
              "error-container": "#ffdad6",
              error: "#ba1a1a",
              background: "#faf9f4",
              "primary-fixed-dim": "#b4cdb8",
              "surface-container-low": "#f5f4ef",
              "surface-container-highest": "#e3e3de",
              "secondary-fixed-dim": "#e9c349",
              "on-tertiary-fixed-variant": "#474747",
              "outline-variant": "#c3c8c1",
              "primary-container": "#1b3022",
              "on-tertiary-container": "#939292",
              "surface-variant": "#e3e3de",
              "on-surface-variant": "#434843",
              "on-tertiary-fixed": "#1b1c1c",
              "on-secondary": "#ffffff",
              "surface-container-lowest": "#ffffff",
              tertiary: "#161717",
              "inverse-surface": "#30312e",
              "tertiary-container": "#2b2b2b",
              secondary: "#735c00",
              primary: "#061b0e",
              "on-secondary-fixed-variant": "#574500",
              "surface-bright": "#faf9f4",
              "on-background": "#1b1c19",
              "primary-fixed": "#d0e9d4",
              "tertiary-fixed": "#e4e2e1",
              "on-surface": "#1b1c19",
              "inverse-primary": "#b4cdb8",
              "on-primary": "#ffffff",
              "on-error-container": "#93000a",
              "secondary-fixed": "#ffe088",
              outline: "#737973",
              "on-primary-fixed": "#0b2013",
              "surface-tint": "#4d6453",
              "inverse-on-surface": "#f2f1ec",
              "tertiary-fixed-dim": "#c8c6c5",
              "on-primary-fixed-variant": "#364c3c",
              "on-secondary-fixed": "#241a00",
              "surface-dim": "#dbdad5",
            },
            borderRadius: {
              DEFAULT: "0.25rem",
              lg: "0.5rem",
              xl: "0.75rem",
              full: "9999px",
            },
            spacing: {
              gutter: "24px",
              unit: "8px",
              "margin-edge": "40px",
              "container-max": "1280px",
              "section-gap": "120px",
            },
            fontFamily: {
              "body-md": ["Manrope"],
              "headline-lg": ["Noto Serif"],
              "body-lg": ["Manrope"],
              "label-caps": ["Manrope"],
              "headline-md": ["Noto Serif"],
              "headline-display": ["Noto Serif"],
            },
            fontSize: {
              "body-md": ["16px", { lineHeight: "1.6", fontWeight: "400" }],
              "headline-lg": [
                "40px",
                {
                  lineHeight: "1.2",
                  letterSpacing: "-0.01em",
                  fontWeight: "400",
                },
              ],
              "body-lg": ["18px", { lineHeight: "1.6", fontWeight: "400" }],
              "label-caps": [
                "12px",
                {
                  lineHeight: "1.2",
                  letterSpacing: "0.15em",
                  fontWeight: "600",
                },
              ],
              "headline-md": ["32px", { lineHeight: "1.3", fontWeight: "400" }],
              "headline-display": [
                "64px",
                {
                  lineHeight: "1.1",
                  letterSpacing: "-0.02em",
                  fontWeight: "400",
                },
              ],
            },
          },
        },
      };
    </script>
    <style>
      .material-symbols-outlined {
        font-variation-settings:
          "FILL" 0,
          "wght" 300,
          "GRAD" 0,
          "opsz" 24;
      }
      .form-input-bespoke {
        border: none;
        border-bottom: 1px solid rgba(27, 48, 34, 0.2);
        background: transparent;
        border-radius: 0;
        padding-left: 0;
        padding-right: 0;
      }
      .form-input-bespoke:focus {
        border-bottom: 1px solid #735c00;
        box-shadow: none;
        outline: none;
      }
    </style>
  </head>
  <body
    class="bg-background text-on-surface font-body-md min-h-screen flex flex-col"
  >
    <!-- Sidebar -->
    <aside
      class="fixed top-0 left-0 h-full w-64 bg-primary text-on-primary z-40 flex flex-col"
    >
      <div class="flex items-center justify-center py-8">
        <div
          class="text-xl font-headline-lg tracking-[0.4em] text-white"
        >
          LUPIÈRE
        </div>
      </div>
      <nav class="flex-1 flex-col pt-6 space-y-4">
        <a
          href="index.php"
          class="flex items-center px-4 py-3 text-sm font-label-caps text-label-caps tracking-[0.2em] hover:bg-primary/20 transition-colors"
        >
          <span class="material-symbols-outlined">dashboard</span>
          <span class="ml-3">Dashboard</span>
        </a>
        <a
          href="produtos.php"
          class="flex items-center px-4 py-3 text-sm font-label-caps text-label-caps tracking-[0.2em] bg-primary/20 hover:bg-primary/30 transition-colors"
        >
          <span class="material-symbols-outlined">inventory_2</span>
          <span class="ml-3">Produtos</span>
        </a>
        <a
          href="categorias.php"
          class="flex items-center px-4 py-3 text-sm font-label-caps text-label-caps tracking-[0.2em] hover:bg-primary/20 transition-colors"
        >
          <span class="material-symbols-outiled">category</span>
          <span class="ml-3">Categorias</span>
        </a>
        <a
          href="../logout.php"
          class="flex items-center px-4 py-3 text-sm font-label-caps text-label-caps tracking-[0.2em] hover:bg-primary/20 transition-colors mt-auto"
        >
          <span class="material-symbols-outlined">logout</span>
          <span class="ml-3">Sair</span>
        </a>
      </nav>
    </aside>
    <!-- Main Content -->
    <main
      class="flex-grow ml-64 flex flex-col"
    >
      <!-- TopNavBar -->
      <header
        class="fixed top-0 left-64 right-0 z-50 bg-[#FAF9F4]/95 backdrop-blur-md border-b border-[#1B3022]/10 h-16 flex items-center"
      >
        <div
          class="flex justify-between items-center w-full px-6 md:px-16 max-w-[1440px] mx-auto"
        >
          <!-- LOGO -->
          <div
            class="text-xl md:text-2xl font-headline-lg tracking-[0.4em] text-[#1B3022]"
          >
            Gerenciar Produtos
          </div>

          <!-- ICONES -->
          <div class="flex items-center gap-5 md:gap-8 text-[#1B3022]">
            <a href="../perfil.php" class="icon-btn">
              <span class="material-symbols-outlined">person</span>
            </a>
          </div>
        </div>
      </header>
      <div class="flex-grow flex items-center justify-center py-section-gap px-gutter">
        <div class="max-w-container-max w-full">
          <?php if (isset($sucesso)): ?>
            <div class="mb-6 p-4 bg-green-500/20 text-green-600 rounded-lg">
              <?php echo $sucesso; ?>
            </div>
          <?php endif; ?>
          <?php if (isset($erro)): ?>
            <div class="mb-6 p-4 bg-red-500/20 text-red-600 rounded-lg">
              <?php echo $erro; ?>
            </div>
          <?php endif; ?>

          <div class="space-y-8">
            <!-- Formulário de produto -->
            <div class="bg-surface rounded-lg border border-outline/20 p-6">
              <h2 class="font-headline-md text-headline-md text-primary mb-4">
                <?php echo $produto_editar ? 'Editar Produto' : 'Adicionar Novo Produto'; ?>
              </h2>
              <form action="produtos.php" method="post">
                <input type="hidden" name="action" value="<?php echo $produto_editar ? 'update' : 'create'; ?>">
                <?php if ($produto_editar): ?>
                  <input type="hidden" name="id" value="<?php echo $produto_editar['id']; ?>">
                <?php endif; ?>

                <div class="space-y-4">
                  <div>
                    <label class="block font-label-caps text-label-caps mb-2">Nome do Produto:</label>
                    <input
                      type="text"
                      name="nome"
                      value="<?php echo htmlspecialchars($produto_editar['nome'] ?? ''); ?>"
                      class="w-full form-input-bespoke py-3 text-body-md font-body-md text-primary"
                      required
                    >
                  </div>

                  <div>
                    <label class="block font-label-caps text-label-caps mb-2">Descrição:</label>
                    <textarea
                      name="descricao"
                      rows="4"
                      class="w-full form-input-bespoke py-3 text-body-md font-body-md text-primary"
                      required
                    ><?php echo htmlspecialchars($produto_editar['descricao'] ?? ''); ?></textarea>
                  </div>

                  <div>
                    <label class="block font-label-caps text-label-caps mb-2">Preço (R$):</label>
                    <input
                      type="number"
                      name="preco"
                      step="0.01"
                      value="<?php echo htmlspecialchars($produto_editar['preco'] ?? ''); ?>"
                      class="w-full form-input-bespoke py-3 text-body-md font-body-md text-primary"
                      required
                    >
                  </div>

                  <div>
                    <label class="block font-label-caps text-label-caps mb-2">Categoria:</label>
                    <select
                      name="categoria_id"
                      class="w-full form-input-bespoke py-3 text-body-md font-body-md text-primary"
                      required
                    >
                      <option value="">Selecione uma categoria</option>
                      <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo $categoria['id']; ?>"
                                <?php echo ($produto_editar && $produto_editar['categoria_id'] == $categoria['id']) ? 'selected' : ''; ?>>
                          <?php echo htmlspecialchars($categoria['nome']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div>
                    <label class="block font-label-caps text-label-caps mb-2">Estoque:</label>
                    <input
                      type="number"
                      name="estoque"
                      value="<?php echo htmlspecialchars($produto_editar['estoque'] ?? ''); ?>"
                      class="w-full form-input-bespoke py-3 text-body-md font-body-md text-primary"
                      required
                    >
                  </div>

                  <div>
                    <label class="block font-label-caps text-label-caps mb-2">URL da Imagem:</label>
                    <input
                      type="text"
                      name="imagem"
                      value="<?php echo htmlspecialchars($produto_editar['imagem'] ?? 'https://via.placeholder.com/400'); ?>"
                      class="w-full form-input-bespoke py-3 text-body-md font-body-md text-primary"
                    >
                  </div>

                  <div class="flex justify-end">
                    <button
                      type="submit"
                      class="bg-primary-container text-white py-3 px-6 font-label-caps text-label-caps tracking-[0.2em] hover:bg-primary transition-all duration-300"
                    >
                      <?php echo $produto_editar ? 'Atualizar Produto' : 'Adicionar Produto'; ?>
                    </button>
                    <?php if ($produto_editar): ?>
                      <a
                        href="produtos.php"
                        class="ml-4 border border-outline/30 text-primary py-3 px-6 font-label-caps text-label-caps tracking-[0.2em] hover:bg-surface-container-low transition-all duration-300"
                      >
                        Cancelar
                      </a>
                    <?php endif; ?>
                  </div>
                </form>
              </div>

              <!-- Lista de produtos -->
              <div class="bg-surface rounded-lg border border-outline/20 p-6">
                <h2 class="font-headline-md text-headline-md text-primary mb-4">
                  Lista de Produtos
                </h2>
                <?php if (empty($produtos)): ?>
                  <p class="text-center text-on-surface-variant py-8">Nenhum produto encontrado</p>
                <?php else: ?>
                  <div class="overflow-x-auto">
                    <table
                      class="w-full text-sm text-left text-on-surface-variant"
                    >
                      <thead class="bg-primary/10">
                        <tr>
                          <th class="px-4 py-3 font-label-caps text-label-caps tracking-[0.2em] w-20">ID</th>
                          <th class="px-4 py-3 font-label-caps text-label-caps tracking-[0.2em]">Nome</th>
                          <th class="px-4 py-3 font-label-caps text-label-caps tracking-[0.2em]">Preço</th>
                          <th class="px-4 py-3 font-label-caps text-label-caps tracking-[0.2em]">Categoria</th>
                          <th class="px-4 py-3 font-label-caps text-label-caps tracking-[0.2em] w-20">Estoque</th>
                          <th class="px-4 py-3 font-label-caps text-label-caps tracking-[0.2em]">Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($produtos as $produto): ?>
                          <tr class="border-t border-outline/20">
                            <td class="px-4 py-3"><?php echo $produto['id']; ?></td>
                            <td class="px-4 py-3"><?php echo htmlspecialchars($produto['nome']); ?></td>
                            <td class="px-4 py-3">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                            <td class="px-4 py-3"><?php echo htmlspecialchars($produto['categoria_nome'] ?: 'Sem categoria'); ?></td>
                            <td class="px-4 py-3"><?php echo $produto['estoque']; ?></td>
                            <td class="px-4 py-3 flex gap-2">
                              <a
                                href="produtos.php?id=<?php echo $produto['id']; ?>"
                                class="px-3 py-1 bg-primary/20 text-primary text-xs rounded hover:bg-primary/30 transition-colors"
                              >
                                Editar
                              </a>
                              <form
                                action="produtos.php"
                                method="post"
                                onsubmit="return confirm('Tem certeza que deseja excluir este produto?');"
                              >
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
                                <button
                                  type="submit"
                                  class="px-3 py-1 bg-red-500/20 text-red-600 text-xs rounded hover:bg-red-500/30 transition-colors"
                                >
                                  Excluir
                                </button>
                              </form>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Footer -->
    <footer
      class="mt-auto w-full border-t border-outline/20 bg-surface-container flex items-center justify-center py-8"
    >
      <div class="text-center text-on-surface-variant/60 font-body-md">
        &copy; <?php echo date("Y"); ?> LUPIÈRE. Todos os direitos reservados.
      </div>
    </footer>

    <script>
      // Sidebar mobile behavior would go here if needed
    </script>
  </body>
</html>