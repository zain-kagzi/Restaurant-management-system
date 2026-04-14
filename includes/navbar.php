<?php
// includes/navbar.php
// Usage: set $activePage and optionally $showCart before including this file.
// $activePage = 'home' | 'menu' | 'feedback' | 'about'
// $showCart   = true  (only on menu.php)
// Make sure session_start() is called BEFORE including this file.

$activePage = $activePage ?? 'home';
$showCart   = $showCart   ?? false;
?>

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,600;1,400&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">

<style>
  /* ── Root tokens ── */
  :root {
    --gold:       #C9973A;
    --gold-light: #E8B84B;
    --dark:       #111010;
    --dark-2:     #1a1a18;
    --white:      #ffffff;
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  html { scroll-behavior: smooth; }
  body { font-family: 'Jost', sans-serif; padding-top: 70px; }

  /* ── Cart dropdown ── */
  #cartDropdown {
    position: fixed;
    top: 70px;
    right: 1rem;
    width: 290px;
    background: #1a1a18;
    border: 1px solid rgba(201, 151, 58, 0.3);
    border-radius: 6px;
    padding: 1rem;
    z-index: 9999;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
  }

  #cartItemsList {
    list-style: none;
    padding: 0;
    margin: 0 0 0.75rem;
    max-height: 200px;
    overflow-y: auto;
  }

  #cartItemsList li {
    display: flex;
    justify-content: space-between;
    padding: 0.4rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.07);
    font-size: 0.78rem;
    color: rgba(255, 255, 255, 0.72);
  }

  .cart-total-row {
    color: #E8B84B;
    font-size: 0.875rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
    display: block;
  }

  .cart-clear-btn {
    width: 100%;
    border: 1px solid #C9973A;
    color: #C9973A;
    background: transparent;
    font-size: 0.72rem;
    padding: 0.4rem;
    border-radius: 4px;
    margin-bottom: 0.5rem;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
  }
  .cart-clear-btn:hover { background: #C9973A; color: #111010; }

  .cart-checkout-link {
    display: block;
    width: 100%;
    background: white;
    color: #111010;
    font-size: 0.72rem;
    text-align: center;
    padding: 0.4rem;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 500;
    transition: background 0.2s;
  }
  .cart-checkout-link:hover { background: #f3f4f6; }

  /* ════════════════════════════
     NAVBAR
  ════════════════════════════ */
  .nav-main {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 100;
    height: 70px;
    background: rgba(17, 16, 16, 0.88);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-bottom: 1px solid rgba(201, 151, 58, 0.18);
    transition: background 0.3s ease;
  }
  .nav-main.scrolled { background: rgba(17, 16, 16, 0.98); }

  .nav-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 2rem;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
  }

  /* ── Logo ── */
  .nav-logo {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    text-decoration: none;
    flex-shrink: 0;
  }
  .nav-logo img { height: 38px; width: auto; }
  .nav-logo-text {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--white);
    letter-spacing: 0.04em;
  }

  /* ── Desktop Links ── */
  .nav-links {
    display: flex;
    align-items: center;
    gap: 2.5rem;
    list-style: none;
  }
  .nav-links a {
    position: relative;
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    font-size: 0.75rem;
    font-weight: 400;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    padding-bottom: 3px;
    transition: color 0.25s;
  }
  .nav-links a::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0;
    width: 0; height: 1px;
    background: var(--gold);
    transition: width 0.3s ease;
  }
  .nav-links a:hover          { color: var(--gold); }
  .nav-links a:hover::after   { width: 100%; }
  .nav-links a.nav-active     { color: var(--gold); }
  .nav-links a.nav-active::after { width: 100%; }

  /* ── Auth area ── */
  .nav-auth {
    display: flex;
    align-items: center;
    gap: 0.85rem;
  }
  .nav-welcome { color: rgba(255,255,255,0.6); font-size: 0.78rem; letter-spacing: 0.04em; }
  .nav-welcome strong { color: rgba(255,255,255,0.9); }

  /* ── Cart button ── */
  .nav-cart-btn {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    background: var(--gold);
    color: var(--dark);
    font-family: 'Jost', sans-serif;
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    padding: 0.5rem 1rem;
    border-radius: 100px;
    border: none;
    cursor: pointer;
    transition: background 0.25s;
  }
  .nav-cart-btn:hover { background: var(--gold-light); }

  /* ── Buttons ── */
  .btn-nav-gold {
    display: inline-block;
    background: var(--gold);
    color: var(--dark);
    font-family: 'Jost', sans-serif;
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    text-decoration: none;
    padding: 0.5rem 1.3rem;
    border-radius: 100px;
    border: none;
    cursor: pointer;
    transition: background 0.25s, transform 0.2s;
  }
  .btn-nav-gold:hover { background: var(--gold-light); transform: translateY(-1px); }

  .btn-nav-outline {
    display: inline-block;
    background: transparent;
    color: rgba(255,255,255,0.65);
    font-family: 'Jost', sans-serif;
    font-size: 0.72rem;
    font-weight: 400;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    text-decoration: none;
    padding: 0.45rem 1.1rem;
    border-radius: 100px;
    border: 1px solid rgba(255,255,255,0.28);
    transition: border-color 0.25s, color 0.25s;
  }
  .btn-nav-outline:hover { border-color: var(--gold); color: var(--gold); }

  /* ── Hamburger ── */
  .nav-hamburger {
    display: none;
    flex-direction: column;
    justify-content: center;
    gap: 5px;
    width: 36px;
    height: 36px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px;
    flex-shrink: 0;
  }
  .nav-hamburger span {
    display: block;
    width: 24px;
    height: 1.5px;
    background: var(--white);
    transition: transform 0.3s ease, opacity 0.3s ease;
    transform-origin: center;
  }
  .nav-hamburger.open span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
  .nav-hamburger.open span:nth-child(2) { opacity: 0; }
  .nav-hamburger.open span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

  /* ── Mobile cart button ── */
  .mobile-cart-btn {
    display: none;
    align-items: center;
    gap: 0.3rem;
    background: var(--gold);
    color: var(--dark);
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 0.45rem 0.85rem;
    border-radius: 100px;
    border: none;
    cursor: pointer;
    flex-shrink: 0;
    transition: background 0.25s;
  }
  .mobile-cart-btn:hover { background: var(--gold-light); }

  /* ════════════════════════════
     MOBILE DRAWER
  ════════════════════════════ */
  .nav-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.55);
    z-index: 150;
    opacity: 0;
    transition: opacity 0.3s ease;
  }
  .nav-overlay.open    { display: block; }
  .nav-overlay.visible { opacity: 1; }

  .nav-drawer {
    position: fixed;
    top: 0; right: 0;
    width: min(300px, 85vw);
    height: 100vh;
    background: rgba(15,14,14,0.98);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-left: 1px solid rgba(201,151,58,0.2);
    transform: translateX(100%);
    transition: transform 0.35s cubic-bezier(0.4,0,0.2,1);
    z-index: 200;
    padding: 1.75rem 1.5rem;
    display: flex;
    flex-direction: column;
  }
  .nav-drawer.open { transform: translateX(0); }

  .drawer-close-btn {
    background: none;
    border: none;
    color: rgba(255,255,255,0.55);
    font-size: 1.25rem;
    cursor: pointer;
    align-self: flex-end;
    margin-bottom: 2rem;
    padding: 4px;
    transition: color 0.2s;
    line-height: 1;
  }
  .drawer-close-btn:hover { color: var(--white); }

  .drawer-links { list-style: none; flex: 1; }
  .drawer-links li { border-bottom: 1px solid rgba(255,255,255,0.07); }
  .drawer-links a {
    display: block;
    color: rgba(255,255,255,0.65);
    text-decoration: none;
    font-size: 0.8rem;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    padding: 1rem 0;
    transition: color 0.2s;
  }
  .drawer-links a:hover      { color: var(--gold); }
  .drawer-links a.nav-active { color: var(--gold); }

  .drawer-auth {
    margin-top: 2rem;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
  }
  .drawer-welcome { color: rgba(255,255,255,0.55); font-size: 0.82rem; }
  .drawer-welcome strong { color: rgba(255,255,255,0.88); }

  .btn-drawer-gold {
    display: block;
    text-align: center;
    background: var(--gold);
    color: var(--dark);
    font-family: 'Jost', sans-serif;
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    text-decoration: none;
    padding: 0.65rem 1rem;
    border-radius: 100px;
    border: none;
    cursor: pointer;
    transition: background 0.25s;
  }
  .btn-drawer-gold:hover { background: var(--gold-light); }

  .btn-drawer-outline {
    display: block;
    text-align: center;
    background: transparent;
    color: rgba(255,255,255,0.6);
    font-family: 'Jost', sans-serif;
    font-size: 0.72rem;
    font-weight: 400;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    text-decoration: none;
    padding: 0.6rem 1rem;
    border-radius: 100px;
    border: 1px solid rgba(255,255,255,0.25);
    transition: border-color 0.25s, color 0.25s;
  }
  .btn-drawer-outline:hover { border-color: var(--gold); color: var(--gold); }
  .mobile-cart-btn2{
    display:none;
  }

  /* ════════════════════════════
     RESPONSIVE
  ════════════════════════════ */
  @media (max-width: 768px) {
    .nav-links  { display: none; }
    .nav-auth   { display: none; }
    .nav-hamburger   { display: flex; }
    .mobile-cart-btn { display: flex; }
  }

  @media (max-width: 480px) {
    .nav-logo-text { display: none; }
    .nav-inner { padding: 0 1rem; }
    .mobile-cart-btn2{display:flex}
  }
</style>

<!-- OVERLAY -->
<div class="nav-overlay" id="navOverlay"></div>

<!-- ══════════════════════════════════════
     NAVBAR
══════════════════════════════════════ -->
<nav class="nav-main" id="mainNav">
  <div class="nav-inner">

    <!-- Logo -->
    <a href="index.php" class="nav-logo">
      <img src="img/pngegg.png" alt="Restauranters Logo">
      <span class="nav-logo-text">Restauranters</span>
    </a>

    <!-- Desktop links -->
    <ul class="nav-links">
      <li><a href="index.php"    class="<?= $activePage === 'home'     ? 'nav-active' : '' ?>">Home</a></li>
      <li><a href="menu.php"     class="<?= $activePage === 'menu'     ? 'nav-active' : '' ?>">Menu</a></li>
      <li><a href="feedback.php" class="<?= $activePage === 'feedback' ? 'nav-active' : '' ?>">Feedback</a></li>
      <li><a href="about.php"    class="<?= $activePage === 'about'    ? 'nav-active' : '' ?>">About</a></li>
    </ul>

    <!-- Desktop: cart + auth -->
    <div class="nav-auth">
      <?php if ($showCart): ?>
        <button class="nav-cart-btn" id="cartButton">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
          </svg>
          Cart (<span id="cartCount">0</span>)
        </button>
      <?php endif; ?>

      <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
        <span class="nav-welcome">Welcome, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></span>
        <a href="logout.php" class="btn-nav-outline">Logout</a>
      <?php else: ?>
        <a href="login.php" class="btn-nav-gold">Login</a>
      <?php endif; ?>
    </div>

    <!-- Mobile right: cart btn + hamburger -->
    <div style="align-items:center; gap:0.5rem;" class="mobile-cart-btn2">
      <?php if ($showCart): ?>
        <button class="mobile-cart-btn" id="mobileCartBtn">
          🛒 <span id="mobileCartCount">0</span>
        </button>
      <?php endif; ?>
      <button class="nav-hamburger" id="navHamburger" aria-label="Open navigation">
        <span></span><span></span><span></span>
      </button>
    </div>

  </div><!-- end nav-inner -->

  <?php if ($showCart): ?>
  <!-- Cart Dropdown — fixed below navbar, shared by desktop + mobile -->
  <div id="cartDropdown" style="display:none;">
    <ul id="cartItemsList"></ul>
    <span class="cart-total-row">Total: ₹<span id="cartTotal">0.00</span></span>
    <button class="cart-clear-btn" onclick="clearCart()">Clear Cart</button>
    <a href="checkout.php" class="cart-checkout-link">Checkout →</a>
  </div>
  <?php endif; ?>

</nav><!-- end nav -->

<!-- ══════════════════════════════════════
     MOBILE DRAWER
══════════════════════════════════════ -->
<div class="nav-drawer" id="navDrawer">

  <button class="drawer-close-btn" id="drawerCloseBtn" aria-label="Close">✕</button>

  <ul class="drawer-links">
    <li><a href="index.php"    class="<?= $activePage === 'home'     ? 'nav-active' : '' ?>">Home</a></li>
    <li><a href="menu.php"     class="<?= $activePage === 'menu'     ? 'nav-active' : '' ?>">Menu</a></li>
    <li><a href="feedback.php" class="<?= $activePage === 'feedback' ? 'nav-active' : '' ?>">Feedback</a></li>
    <li><a href="about.php"    class="<?= $activePage === 'about'    ? 'nav-active' : '' ?>">About</a></li>
  </ul>

  <div class="drawer-auth">
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
      <p class="drawer-welcome">Welcome, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>
      <a href="logout.php" class="btn-drawer-outline">Logout</a>
    <?php else: ?>
      <a href="login.php" class="btn-drawer-gold">Login</a>
    <?php endif; ?>
  </div>

</div>

<!-- ══════════════════════════════════════
     JAVASCRIPT
══════════════════════════════════════ -->
<script>
document.addEventListener('DOMContentLoaded', function () {

  /* ── Drawer ── */
  const hamburger = document.getElementById('navHamburger');
  const drawer    = document.getElementById('navDrawer');
  const overlay   = document.getElementById('navOverlay');
  const closeBtn  = document.getElementById('drawerCloseBtn');
  const nav       = document.getElementById('mainNav');

  function openDrawer() {
    drawer.classList.add('open');
    overlay.classList.add('open');
    hamburger.classList.add('open');
    document.body.style.overflow = 'hidden';
    setTimeout(() => overlay.classList.add('visible'), 10);
  }

  function closeDrawer() {
    drawer.classList.remove('open');
    overlay.classList.remove('visible');
    hamburger.classList.remove('open');
    document.body.style.overflow = '';
    setTimeout(() => overlay.classList.remove('open'), 300);
  }

  hamburger.addEventListener('click', openDrawer);
  closeBtn.addEventListener('click', closeDrawer);
  overlay.addEventListener('click', closeDrawer);
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeDrawer(); });

  window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 50);
  }, { passive: true });

  /* ── Cart ── */
  /* Guard: if no cart on this page, skip all cart code */
  const cartDropdown  = document.getElementById('cartDropdown');
  if (!cartDropdown) return;

  const cartButton    = document.getElementById('cartButton');
  const mobileCartBtn = document.getElementById('mobileCartBtn');

  let cart = [];
  try { cart = JSON.parse(localStorage.getItem('cart') || '[]'); } catch(e) { cart = []; }

  /* Update all cart UI elements */
  function updateCartUI() {
    const count   = cart.reduce((s, i) => s + i.qty, 0);
    const total   = cart.reduce((s, i) => s + i.price * i.qty, 0);
    const countEl = document.getElementById('cartCount');
    const mobEl   = document.getElementById('mobileCartCount');
    const totalEl = document.getElementById('cartTotal');
    const listEl  = document.getElementById('cartItemsList');

    if (countEl) countEl.textContent = count;
    if (mobEl)   mobEl.textContent   = count;
    if (totalEl) totalEl.textContent = total.toFixed(2);
    if (listEl) {
      listEl.innerHTML = cart.length
        ? cart.map(i =>
            `<li>
              <span>${i.name} &times;${i.qty}</span>
              <span>&#8377;${(i.price * i.qty).toFixed(0)}</span>
            </li>`).join('')
        : '<li style="color:rgba(255,255,255,0.3);font-size:.75rem;padding:.5rem 0;">Cart is empty</li>';
    }
  }

  /* Toggle dropdown */
  function toggleDropdown() {
    cartDropdown.style.display =
      cartDropdown.style.display === 'none' ? 'block' : 'none';
  }

  /* Desktop cart button */
  if (cartButton) {
    cartButton.addEventListener('click', function(e) {
      e.stopPropagation();
      toggleDropdown();
    });
  }

  /* Mobile cart button */
  if (mobileCartBtn) {
    mobileCartBtn.addEventListener('click', function(e) {
      e.stopPropagation();
      toggleDropdown();
    });
  }

  /* Close on outside click */
  document.addEventListener('click', function() {
    cartDropdown.style.display = 'none';
  });
  cartDropdown.addEventListener('click', e => e.stopPropagation());

  /* addToCart — called from menu.php card buttons */
  window.addToCart = function(id, name, price) {
    const loggedIn = <?php echo json_encode(isset($_SESSION['loggedin']) ? (bool)$_SESSION['loggedin'] : false); ?>;
    if (!loggedIn) { window.location.href = 'login.php'; return; }
    const existing = cart.find(i => i.id == id);
    if (existing) { existing.qty++; }
    else { cart.push({ id, name, price: parseFloat(price), qty: 1 }); }
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartUI();
    showToast(name + ' added!');
  };

  /* clearCart — called from dropdown button */
  window.clearCart = function() {
    cart = [];
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartUI();
  };

  /* Toast */
  window.showToast = function(msg) {
    const old = document.querySelector('.nav-toast');
    if (old) old.remove();
    const t = document.createElement('div');
    t.className = 'nav-toast';
    t.style.cssText = 'position:fixed;bottom:1.5rem;left:50%;transform:translateX(-50%);background:#111010;color:#C9973A;border:1px solid rgba(201,151,58,0.4);font-size:.72rem;letter-spacing:.1em;text-transform:uppercase;padding:.65rem 1.3rem;border-radius:100px;box-shadow:0 8px 24px rgba(0,0,0,0.3);z-index:99999;transition:opacity 0.4s;white-space:nowrap;';
    t.textContent = msg;
    document.body.appendChild(t);
    setTimeout(() => { t.style.opacity = '0'; setTimeout(() => t.remove(), 400); }, 2200);
  };

  updateCartUI();

}); // end DOMContentLoaded
</script>