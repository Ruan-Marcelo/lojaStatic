<?php
$titulo_pagina = 'Início';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>
<div class="flex-grow flex items-center justify-center py-section-gap px-gutter">
  <div class="max-w-container-max w-full">
    <!-- Hero Section -->
    <section class="mb-16">
      <div class="text-center">
        <h1 class="font-headline-display text-headline-display mb-6">LUPIÈRE</h1>
        <p class="body-lg text-body-lg max-w-xl mx-auto">
          Moda sofisticada com conforto incomparável. Descubra nossa coleção premium de peças únicas.
        </p>
        <a href="produtos.php" class="btn-primary-inline mt-8 py-4 px-6 font-label-caps text-label-caps tracking-[0.2em] bg-primary-container text-white hover:bg-primary transition-all duration-300">
          Coleção Completa
        </a>
      </div>
    </section>

    <!-- Destaques -->
    <section class="mb-16">
      <h2 class="font-headline-md text-headline-md mb-8 text-center">Destaques da Semana</h2>
      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <?php
        $produtos_destaque = obter_produtos(4, 0); // 4 produtos mais recentes
        if (!empty($produtos_destaque)):
          foreach ($produtos_destaque as $produto):
        ?>
          <div class="bg-surface rounded-lg border border-outline/20 p-6 hover:shadow-md transition-shadow duration-300">
            <?php if ($produto['imagem'] && file_exists('../uploads/' . $produto['imagem'])): ?>
              <img src="../uploads/<?php echo escapar($produto['imagem']); ?>" alt="<?php echo escapar($produto['nome']); ?>" class="w-full h-48 object-contain mb-4">
            <?php else: ?>
              <div class="w-full h-48 bg-surface-container flex items-center justify-center mb-4 rounded-lg">
                <span class="material-symbols-outlined">inventory_2</span>
              </div>
            <?php endif; ?>
            <h3 class="font-headline-sm text-headline-sm mb-3 line-clamp-2"><?php echo escapar($produto['nome']); ?></h3>
            <p class="body-sm text-body-sm mb-4 line-clamp-3"><?php echo escapar($produto['descricao']); ?></p>
            <div class="flex justify-between items-center">
              <span class="font-label-caps text-label-caps"><?php echo formatar_moeda($produto['preco']); ?></span>
              <a href="produto.php?id=<?php echo $produto['id']; ?>" class="text-primary hover:underline">Ver detalhes →</a>
            </div>
          </div>
        <?php
          endforeach;
        else:
        ?>
          <p class="text-center text-on-surface-variant/60">Nenhum produto cadastrado ainda.</p>
        <?php
        endif;
        ?>
      </div>
    </section>

    <!-- Sobre -->
    <section class="mb-16">
      <div class="max-w-2xl mx-auto text-center">
        <h2 class="font-headline-md text-headline-md mb-6">Sobre a LUPIÈRE</h2>
        <p class="body-lg text-body-lg">
          A LUPIÈRE nasce da fusão entre tradição e inovação na moda. Cada peça é cuidadosamente projetada para oferecer elegância atemporal com conforto moderno, usando materiais premium e atenção aos detalhes.
        </p>
      </div>
    </section>
  </div>
</div>
<?php
require_once 'includes/footer.php';
?>