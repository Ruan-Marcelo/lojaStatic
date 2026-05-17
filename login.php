<?php
session_start();

require_once 'funcoes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $senha = $_POST["password"];

  $usuario = obter_usuario_por_email($email);

  if ($usuario && password_verify($senha, $usuario["senha"])) {
    $_SESSION["usuario_id"] = $usuario["id"];
    header("Location: index.php");
    exit();
  } else {
    $erro = "Email ou senha inválidos";
  }
}
?>
<!doctype html>

<html class="light" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>LUPIÈRE | Login</title>
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
              "on-primary-container": "#819986",
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
      .wolf-watermark {
        opacity: 0.03;
        pointer-events: none;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80vh;
        z-index: 0;
      }
    </style>
  </head>
  <body
    class="bg-background text-on-background min-h-screen flex flex-col font-body-md overflow-x-hidden"
  >
    <!-- TopNavBar -->
    <header
      class="fixed top-0 left-0 right-0 z-50 bg-[#FAF9F4]/95 backdrop-blur-md border-b border-[#1B3022]/10 h-20 flex items-center transition-all duration-300"
    >
      <div
        class="flex justify-between items-center w-full px-6 md:px-16 max-w-[1440px] mx-auto"
      >
        <!-- BOTÃO MENU MOBILE -->
        <button id="menuBtn" class="lg:hidden text-[#1B3022]">
          <span class="material-symbols-outlined">menu</span>
        </button>

        <!-- NAV DESKTOP -->
        <nav class="hidden lg:flex gap-10">
          <a class="nav-link" href="index.html">Inicio</a>
          <a class="nav-link" href="produtos.html">Coleções</a>
          <a class="nav-link" href="acessorios.html">Acessórios</a>
          <a class="nav-link" href="sobre.html">Nossa história</a>
        </nav>

        <!-- LOGO -->
        <div
          class="text-xl md:text-2xl font-headline-lg tracking-[0.4em] text-[#1B3022]"
        >
          LUPIÈRE
        </div>

        <!-- ICONES -->
        <div class="flex items-center gap-5 md:gap-8 text-[#1B3022]">
          <a href="carrinho.html" class="icon-btn">
            <span class="material-symbols-outlined">shopping_bag</span>
          </a>
          <a href="/login.html" class="icon-btn">
            <span class="material-symbols-outlined">person</span>
          </a>
        </div>
      </div>
    </header>
    <!-- MENU MOBILE -->
    <div
      id="mobileMenu"
      class="fixed top-0 left-[-100%] w-72 h-full bg-[#FAF9F4] z-50 transition-all duration-300 shadow-xl p-8 flex flex-col gap-8"
    >
      <div class="flex justify-between items-center">
        <span class="font-label-caps text-sm tracking-widest">MENU</span>
        <button id="closeMenu">
          <span class="material-symbols-outlined">close</span>
        </button>
      </div>

      <a class="nav-link" href="index.html">Inicio</a>
      <a class="nav-link" href="produtos.html">Coleções</a>
      <a class="nav-link" href="acessorios.html">Acessórios</a>
      <a class="nav-link" href="sobre.html">Nossa história</a>
    </div>
    <main
      class="flex-grow flex items-center justify-center relative px-margin-edge py-section-gap"
    >
      <!-- Wolf Watermark Logo Symbol -->
      <div class="wolf-watermark">
        <span class="material-symbols-outlined text-[40rem]" data-icon="wolf"
          >owl</span
        >
      </div>
      <!-- Central Login Card -->
      <div class="relative z-10 w-full max-w-[480px]">
        <div class="text-center mb-12">
          <h1
            class="font-headline-lg text-headline-lg text-primary-container mb-2"
          >
            Welcome Back
          </h1>
          <p
            class="font-body-md text-body-md text-on-surface-variant uppercase tracking-widest text-[10px]"
          >
            Access your bespoke world.
          </p>
        </div>
        <div
          class="bg-surface-container-lowest p-10 md:p-12 border border-outline-variant/30 shadow-sm"
        >
          <form class="space-y-8" method="post">
            <!-- Email Field -->
            <div class="space-y-2">
              <label
                class="font-label-caps text-label-caps text-on-surface-variant block"
                >EMAIL ADDRESS</label
              >
              <input
                class="w-full bg-transparent border-b border-outline-variant py-3 focus:outline-none focus:border-secondary transition-colors font-body-md placeholder:text-outline-variant/50"
                placeholder="email@example.com"
                type="email"
                name="email"
                required
              />
            </div>
            <!-- Password Field -->
            <div class="space-y-2">
              <div class="flex justify-between items-end">
                <label
                  class="font-label-caps text-label-caps text-on-surface-variant block"
                  >PASSWORD</label
                >
                <a
                  class="font-label-caps text-[10px] text-secondary hover:text-primary transition-colors"
                  href="#"
                  >FORGOT PASSWORD?</a
                >
              </div>
              <input
                class="w-full bg-transparent border-b border-outline-variant py-3 focus:outline-none focus:border-secondary transition-colors font-body-md placeholder:text-outline-variant/50"
                placeholder="••••••••"
                type="password"
                name="password"
                required
              />
            </div>
            <!-- Sign In Button -->
            <button
              class="w-full bg-primary-container text-white py-5 font-label-caps text-label-caps tracking-[0.2em] hover:bg-primary transition-all duration-300 active:opacity-80"
              type="submit"
            >
              SIGN IN
            </button>
          </form>
          <?php if (isset($erro)): ?>
        <p class="text-red-500"><?php echo $erro; ?></p>
        <?php endif; ?>
            <div class="absolute inset-0 flex items-center">
              <span class="w-full border-t border-outline-variant/30"></span>
            </div>
            <span
              class="relative bg-surface-container-lowest px-4 font-label-caps text-[10px] text-outline-variant"
              >OR CONTINUE WITH</span
            >
          </div>
          <!-- Social Logins -->
          <div class="grid grid-cols-2 gap-4">
            <button
              class="w-full border border-outline/30 text-primary py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-surface-container-low transition-all duration-300 flex items-center justify-center gap-3"
              type="button"
            >
              <img
                src="https://developers.google.com/identity/images/g-logo.png"
                alt="Google"
                class="w-5 h-5"
              />
              Continue com Google
            </button>
            <button
              class="w-full border border-outline/30 text-primary py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-surface-container-low transition-all duration-300 flex items-center justify-center gap-3"
              type="button"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="w-5 h-5"
              >
                <path
                  d="M16.365 1.43c0 1.14-.463 2.21-1.24 3.02-.81.84-2.14 1.48-3.28 1.39-.14-1.12.41-2.25 1.16-3.06.77-.84 2.09-1.45 3.36-1.35zm4.3 16.11c-.68 1.55-1.5 2.98-2.76 2.99-1.23.02-1.63-.79-3.05-.79-1.42 0-1.87.77-3.02.81-1.22.05-2.16-1.6-2.86-3.14-1.38-3.02-2.44-8.55 1.92-11.06 1.08-.63 2.3-.99 3.58-.99 1.4 0 2.62.9 3.42.9.8 0 2.3-1.11 3.88-.95.66.03 2.5.27 3.69 2.01-.1.06-2.2 1.28-2.18 3.82.02 3.03 2.66 4.03 2.69 4.05-.02.07-.42 1.44-1.33 2.35z"
                />
              </svg>
              Continue com Apple
            </button>
          </div>
          <div class="mt-10 text-center">
            <p class="font-body-md text-on-surface-variant text-[12px]">
              Não tem uma conta?
              <a
                class="text-primary font-semibold hover:underline underline-offset-4 ml-1"
                href="registrar.html"
                >Solicite um convite.</a
              >
            </p>
          </div>
        </div>
      </div>
    </main>
    <!-- Footer -->
    <footer
      class="bg-[#FAF9F4] w-full py-24 px-8 md:px-16 border-t border-[#1B3022]/10"
    >
      <div
        class="max-w-[1440px] mx-auto grid grid-cols-1 md:grid-cols-4 gap-12"
      >
        <div class="col-span-1 md:col-span-1">
          <div
            class="text-2xl font-headline-lg tracking-[0.3em] text-[#1B3022] uppercase mb-8"
          >
            LUPIÈRE
          </div>
          <p class="font-body-md text-[#1B3022]/60 max-w-xs">
            Elevando a alfaiataria clássica para o homem contemporâneo. Rigor,
            tradição e personalidade.
          </p>
        </div>
        <div class="flex flex-col gap-4">
          <h4
            class="font-label-caps text-[12px] text-[#1B3022] uppercase tracking-widest mb-4"
          >
            Explorar
          </h4>
          <a
            class="font-body-md text-[#1B3022]/60 hover:text-[#1B3022] transition-colors"
            href="#"
            >Inicio</a
          >
          <a
            class="font-body-md text-[#1B3022]/60 hover:text-[#1B3022] transition-colors"
            href="#"
            >Coleções</a
          >
          <a
            class="font-body-md text-[#1B3022]/60 hover:text-[#1B3022] transition-colors"
            href="#"
            >Acessórios</a
          >
        </div>
        <div class="flex flex-col gap-4">
          <h4
            class="font-label-caps text-[12px] text-[#1B3022] uppercase tracking-widest mb-4"
          >
            Atendimento ao Cliente
          </h4>
          <a
            class="font-body-md text-[#1B3022]/60 hover:text-[#1B3022] transition-colors"
            href="#"
            >Envio &amp; Devoluções</a
          >
          <a
            class="font-body-md text-[#1B3022]/60 hover:text-[#1B3022] transition-colors"
            href="#"
            >Política de Privacidade</a
          >
        </div>
        <div class="flex flex-col gap-4">
          <h4
            class="font-label-caps text-[12px] text-[#1B3022] uppercase tracking-widest mb-4"
          >
            Atelier
          </h4>
          <p class="font-body-md text-[#1B3022]/60">
            Avenida da Liberdade, 110<br />
            1250-146 Lisboa, Portugal
          </p>
          <div class="mt-4 flex gap-6">
            <a
              class="text-[#1B3022]/60 hover:text-[#1B3022]"
              href="https://www.instagram.com/uselupiere/"
              target="_blank"
            >
              <span class="material-symbols-outlined text-[20px]">
                photo_camera
              </span>
            </a>
            <a
              class="text-[#1B3022]/60 hover:text-[#1B3022]"
              href="mailto:info@lupiere.com"
              target="_blank"
            >
              <span class="material-symbols-outlined text-[20px]">mail</span></a
            >
          </div>
        </div>
      </div>
      <div
        class="max-w-[1440px] mx-auto mt-24 pt-12 border-t border-[#1B3022]/5 flex flex-col md:flex-row justify-between items-center gap-6"
      >
        <div
          class="font-label-caps text-[10px] tracking-[0.2em] text-[#1B3022]/40 uppercase"
        >
          © 2026 LUPIÈRE TAILORS. ALL RIGHTS RESERVED.
        </div>
        <div class="flex gap-8">
          <a
            class="font-label-caps text-[10px] tracking-[0.2em] text-[#1B3022]/40 uppercase hover:text-[#1B3022] transition-colors"
            href="#"
            >Termos</a
          >
          <a
            class="font-label-caps text-[10px] tracking-[0.2em] text-[#1B3022]/40 uppercase hover:text-[#1B3022] transition-colors"
            href="#"
            >Cookies</a
          >
        </div>
      </div>
    </footer>
    <!-- Decorative Image Section (Hidden on mobile for focus) -->
    <!-- <div
      class="hidden lg:block fixed right-0 top-0 bottom-0 w-1/3 bg-surface-container"
    >
      <img
        class="w-full h-full object-cover grayscale brightness-90 hover:grayscale-0 transition-all duration-700"
        data-alt="A macro photography shot of high-quality wool fabric being measured by a professional tailor in a sun-drenched atelier. The lighting is high-contrast and editorial, highlighting the intricate texture of the charcoal grey suit material. The overall aesthetic is one of quiet, minimalist luxury and artisanal craftsmanship, consistent with a high-end bespoke fashion brand's identity. The atmosphere is serene and focused, evoking a sense of heritage and precision."
        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAEPnB4MRjWEUoOu4BwW5dCYVHQCfJL-CVe9sD05-hddvldTXOu2zsSBQ-qtmwScA5QRPTa0fmdXVZ9cI0Pe2XAZUZye2kwOWsKitnMzh6nHqcPyASNjvnr4Y1HhrV1ah6JXoZvQtvx9P8FUkrgu2A29uG9OjPfUryD9mOg0Anl6buRGfokEn8E_Y8S0x4jYO8I3X5rzO_CLhwyopWzop1PecSu6VDwD16exurUihlR9ar1MGjKOaNsQb_c0Hak150C6Yw0m48QctrF"
      />
    </div> -->
  </body>
</html>
