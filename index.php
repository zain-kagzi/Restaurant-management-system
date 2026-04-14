<?php
session_start();
include('connection.php');
error_reporting(0);
?>
<!-- your page content -->

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Restauranters — Fine Dining</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">

<style>
  :root {
    --gold: #C9973A;
    --gold-light: #E8B84B;
    --dark: #111010;
    --dark-2: #1a1a18;
    --cream: #F5EFE4;
    --text-muted: #888880;
    --white: #ffffff;
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  html { scroll-behavior: smooth; }

  body {
    font-family: 'Jost', sans-serif;
    background: var(--cream);
    color: var(--dark);
    overflow-x: hidden;
  }

  /* ── NAVBAR ── */
 .btn-gold {
    display: inline-block;
    background: var(--gold);
    color: var(--dark);
    font-family: 'Jost', sans-serif;
    font-size: 0.78rem;
    font-weight: 500;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    text-decoration: none;
    padding: 0.55rem 1.4rem;
    border-radius: 2px;
    border: none;
    cursor: pointer;
    transition: background 0.25s, transform 0.2s;
  }

  .btn-gold:hover {
    background: var(--gold-light);
    transform: translateY(-1px);
  }

  .btn-outline {
    display: inline-block;
    background: transparent;
    color: rgba(255,255,255,0.75);
    font-family: 'Jost', sans-serif;
    font-size: 0.78rem;
    font-weight: 400;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    text-decoration: none;
    padding: 0.5rem 1.2rem;
    border-radius: 2px;
    border: 1px solid rgba(255,255,255,0.3);
    transition: border-color 0.25s, color 0.25s;
  }

  .btn-outline:hover {
    border-color: var(--gold);
    color: var(--gold);
  }

  /* ── HERO ── */
  .hero {
    position: relative;
    height: 100vh;
    min-height: 560px;
    overflow: hidden;
  }

  .hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
  }

  .hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
      to bottom,
      rgba(17,16,16,0.35) 0%,
      rgba(17,16,16,0.1) 40%,
      rgba(17,16,16,0.65) 100%
    );
  }

  .hero-content {
    position: absolute;
    bottom: 10%;
    left: 0; right: 0;
    text-align: center;
    color: var(--white);
    padding: 0 1.5rem;
    animation: heroFadeUp 1.1s cubic-bezier(0.22,1,0.36,1) both;
    animation-delay: 0.2s;
  }

  @keyframes heroFadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .hero-eyebrow {
    display: inline-block;
    font-size: 0.72rem;
    font-weight: 400;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 1rem;
  }

  .hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(3rem, 8vw, 7rem);
    font-weight: 300;
    line-height: 1.05;
    letter-spacing: 0.01em;
    margin-bottom: 1.5rem;
  }

  .hero-title em {
    font-style: italic;
    color: var(--gold-light);
  }

  .hero-cta {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--gold);
    color: var(--dark);
    font-family: 'Jost', sans-serif;
    font-size: 0.78rem;
    font-weight: 500;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    text-decoration: none;
    padding: 0.8rem 2rem;
    border-radius: 2px;
    transition: background 0.25s, transform 0.2s;
  }

  .hero-cta:hover {
    background: var(--gold-light);
    transform: translateY(-2px);
  }

  .hero-scroll {
    position: absolute;
    bottom: 2.5rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    color: rgba(255,255,255,0.5);
    font-size: 0.65rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    animation: bounce 2s infinite;
  }

  .hero-scroll::after {
    content: '';
    width: 1px;
    height: 40px;
    background: linear-gradient(to bottom, rgba(255,255,255,0.5), transparent);
  }

  @keyframes bounce {
    0%, 100% { transform: translateX(-50%) translateY(0); }
    50% { transform: translateX(-50%) translateY(6px); }
  }

  /* ── DIVIDER ── */
  .gold-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    padding: 3rem 1.5rem;
  }

  .gold-divider::before,
  .gold-divider::after {
    content: '';
    flex: 1;
    max-width: 180px;
    height: 1px;
    background: linear-gradient(to right, transparent, var(--gold), transparent);
  }

  .gold-divider span {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.5rem;
    color: var(--gold);
    line-height: 1;
  }

  /* ── SECTION: STORY ── */
  .section-story {
    max-width: 1280px;
    margin: 0 auto;
    padding: 4rem 2rem 6rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 5rem;
    align-items: center;
  }

  .section-label {
    display: inline-block;
    font-size: 0.68rem;
    font-weight: 500;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 1rem;
  }

  .section-heading {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2.4rem, 5vw, 4rem);
    font-weight: 300;
    line-height: 1.12;
    color: var(--dark);
    margin-bottom: 1.5rem;
  }

  .section-heading em {
    font-style: italic;
    color: var(--gold);
  }

  .section-body {
    font-size: 0.95rem;
    font-weight: 300;
    line-height: 1.85;
    color: #555550;
    max-width: 420px;
    margin-bottom: 2rem;
  }

  .section-img-wrap {
    position: relative;
  }

  .section-img-wrap img {
    width: 100%;
    height: 460px;
    object-fit: cover;
    display: block;
    border-radius: 2px;
  }

  .section-img-accent {
    position: absolute;
    bottom: -1.5rem;
    right: -1.5rem;
    width: 60%;
    height: 60%;
    border: 2px solid rgba(201,151,58,0.35);
    border-radius: 2px;
    z-index: -1;
  }

  /* ── FULL-WIDTH FOOD IMAGE ── */
  .food-banner {
    position: relative;
    width: 100%;
    height: clamp(280px, 42vw, 560px);
    overflow: hidden;
  }

  .food-banner img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transform: scale(1.04);
    transition: transform 8s ease;
  }

  .food-banner:hover img { transform: scale(1); }

  .food-banner-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(17,16,16,0.18), rgba(17,16,16,0.38));
  }

  /* ── SECTION: MENU ── */
  .section-menu {
    max-width: 1280px;
    margin: 0 auto;
    padding: 6rem 2rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 5rem;
    align-items: center;
  }

  /* ── STATS STRIP ── */
  .stats-strip {
    background: var(--dark);
    padding: 3rem 2rem;
  }

  .stats-inner {
    max-width: 1280px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    text-align: center;
  }

  .stat-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 300;
    color: var(--gold);
    line-height: 1;
  }

  .stat-label {
    font-size: 0.72rem;
    font-weight: 300;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.45);
    margin-top: 0.4rem;
  }

  /* ── FOOTER ── */
  footer {
    background: var(--dark-2);
    color: var(--white);
    border-top: 1px solid rgba(201,151,58,0.2);
  }

  .footer-cta {
    text-align: center;
    padding: 5rem 1.5rem 4rem;
    border-bottom: 1px solid rgba(255,255,255,0.07);
  }

  .footer-cta-eyebrow {
    font-size: 0.72rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 1rem;
  }

  .footer-cta-heading {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 300;
    margin-bottom: 2rem;
  }

  .footer-grid {
    max-width: 1280px;
    margin: 0 auto;
    padding: 3rem 2rem;
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    gap: 3rem;
  }

  .footer-brand-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.5rem;
    font-weight: 300;
    letter-spacing: 0.05em;
    margin-bottom: 0.75rem;
  }

  .footer-brand-desc {
    font-size: 0.82rem;
    font-weight: 300;
    color: rgba(255,255,255,0.45);
    line-height: 1.75;
    max-width: 260px;
  }

  .footer-col-title {
    font-size: 0.68rem;
    font-weight: 500;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 1.2rem;
  }

  .footer-col p {
    font-size: 0.82rem;
    font-weight: 300;
    color: rgba(255,255,255,0.55);
    line-height: 2;
  }

  .footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.07);
    padding: 1.5rem 2rem;
    text-align: center;
    font-size: 0.75rem;
    color: rgba(255,255,255,0.3);
    letter-spacing: 0.05em;
  }

  /* ── RESPONSIVE ── */
  @media (max-width: 900px) {
    .section-story,
    .section-menu {
      grid-template-columns: 1fr;
      gap: 2.5rem;
      padding: 3rem 1.5rem 4rem;
    }

    .section-menu .section-img-wrap { order: -1; }

    .section-img-wrap img { height: 320px; }

    .footer-grid {
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
    }

    .footer-brand { grid-column: 1 / -1; }

    .stats-inner { grid-template-columns: repeat(3, 1fr); gap: 0.5rem; }
  }

  @media (max-width: 768px) {
    .nav-links, .nav-auth { display: none; }
    .hamburger { display: flex; }
    .mobile-drawer, .drawer-overlay { display: block; }

    .hero-title { font-size: clamp(2.2rem, 10vw, 4rem); }

    .stats-inner { grid-template-columns: 1fr 1fr 1fr; }
  }

  @media (max-width: 540px) {
    .footer-grid {
      grid-template-columns: 1fr;
    }

    .stats-inner {
      grid-template-columns: 1fr;
      gap: 2rem;
    }
  }

  /* ── ANIMATIONS ── */
  .reveal {
    opacity: 0;
    transform: translateY(28px);
    transition: opacity 0.8s cubic-bezier(0.22,1,0.36,1), transform 0.8s cubic-bezier(0.22,1,0.36,1);
  }

  .reveal.visible {
    opacity: 1;
    transform: translateY(0);
  }

  .reveal-delay-1 { transition-delay: 0.15s; }
  .reveal-delay-2 { transition-delay: 0.3s; }
  .reveal-delay-3 { transition-delay: 0.45s; }
</style>
</head>

<body>


<!-- ── NAVBAR ── -->
<?php
include('includes/navbar.php');
?>

<!-- ── HERO ── -->
<section class="hero">
  <img src="img/dinesh-ramaswamy-p-sEkj6-hAM-unsplash.jpg" alt="Restaurant interior" class="hero-img">
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <span class="hero-eyebrow">Est. 2020 · Italian Fine Dining</span>
    <h1 class="hero-title">Where Every Dish<br>Tells a <em>Story</em></h1>
    <a href="menu.php" class="hero-cta">Explore Our Menu →</a>
  </div>
  <div class="hero-scroll">Scroll</div>
</section>

<!-- ── DIVIDER ── -->
<div class="gold-divider"><span>✦</span></div>

<!-- ── SECTION: OUR STORY ── -->
<section class="section-story">
  <div class="reveal">
    <span class="section-label">Our Story</span>
    <h2 class="section-heading">Discover the<br><em>Heart</em> Behind<br>Every Plate</h2>
    <p class="section-body">
      We believe great food is more than sustenance — it's an act of love. Every dish
      that leaves our kitchen carries with it the care, passion, and craft of our team.
      Our mission is simple: to make you feel seen, welcome, and deeply satisfied.
    </p>
    <a href="about.php" class="btn-gold">About Us</a>
  </div>

  <div class="section-img-wrap reveal reveal-delay-2">
    <img src="img/high-angle-chicken-meal.jpg" alt="Signature dish">
    <div class="section-img-accent"></div>
  </div>
</section>

<!-- ── FOOD BANNER ── -->
<div class="food-banner">
  <img src="img/front-view-first-second-main-course-lentil-soup-salad-cutlets-with-pasta-soft-drink-table.jpg" alt="Full course meal spread">
  <div class="food-banner-overlay"></div>
</div>

<!-- ── STATS STRIP ── -->
<div class="stats-strip">
  <div class="stats-inner">
    <div class="reveal">
      <div class="stat-num">120+</div>
      <div class="stat-label">Menu Items</div>
    </div>
    <div class="reveal reveal-delay-1">
      <div class="stat-num">15K</div>
      <div class="stat-label">Happy Guests</div>
    </div>
    <div class="reveal reveal-delay-2">
      <div class="stat-num">5★</div>
      <div class="stat-label">Average Rating</div>
    </div>
  </div>
</div>

<!-- ── SECTION: MENU ── -->
<section class="section-menu">
  <div class="section-img-wrap reveal">
    <img src="img/knocksense_2022-05_152898db-9c7b-420e-9155-7302af32ad9b_DSC_9815.avif" alt="Menu spread">
    <div class="section-img-accent"></div>
  </div>

  <div class="reveal reveal-delay-2">
    <span class="section-label">Tasteful Menu</span>
    <h2 class="section-heading">A <em>Symphony</em><br>of Flavours</h2>
    <p class="section-body">
      From handcrafted pastas to wood-fired classics, our menu is a love letter to
      Italian tradition — reimagined for the modern palate. Each ingredient is sourced
      with intention; each recipe perfected with time.
    </p>
    <a href="menu.php" class="btn-gold">View Menu</a>
  </div>
</section>

<!-- ── FOOD BANNER 2 ── -->
<div class="food-banner">
  <img src="img/gourmet-beef-curry-taco-with-fresh-guacamole-generated-by-ai.jpg" alt="Gourmet dish">
  <div class="food-banner-overlay"></div>
</div>

<!-- ── FOOTER ── -->
<?php
$footerType = 'home'; 
include('includes/footer.php'); ?>

<script>
  // ── Scroll Reveal ──
  const reveals = document.querySelectorAll('.reveal');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('visible');
        observer.unobserve(e.target);
      }
    });
  }, { threshold: 0.12 });

  reveals.forEach(el => observer.observe(el));
</script>

</body>
</html>