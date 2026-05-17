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
      href="../index.php"
      class="flex items-center px-4 py-3 text-sm font-label-caps text-label-caps tracking-[0.2em] hover:bg-primary/20 transition-colors"
    >
      <span class="material-symbols-outlined">home</span>
      <span class="ml-3">Início</span>
    </a>
    <a
      href="../produtos.php"
      class="flex items-center px-4 py-3 text-sm font-label-caps text-label-caps tracking-[0.2em] hover:bg-primary/20 transition-colors"
    >
      <span class="material-symbols-outlined">inventory_2</span>
      <span class="ml-3">Produtos</span>
    </a>
    <a
      href="perfil.php"
      class="flex items-center px-4 py-3 text-sm font-label-caps text-label-caps tracking-[0.2em] bg-primary/20 hover:bg-primary/30 transition-colors"
    >
      <span class="material-symbols-outlined">person</span>
      <span class="ml-3">Perfil</span>
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
        <?php echo isset($titulo_pagina) ? $titulo_pagina : 'Página Inicial'; ?>
      </div>

      <!-- ICONES -->
      <div class="flex items-center gap-5 md:gap-8 text-[#1B3022]">
        <a href="../perfil.php" class="icon-btn">
          <span class="material-symbols-outlined">person</span>
        </a>
      </div>
    </div>
  </header>