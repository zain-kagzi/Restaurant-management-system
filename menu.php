<?php
include('connection.php');
session_start();
$showCart = true;
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu — Restauranters</title>

  <!-- Tailwind CDN — add your CDN script tag here -->
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,600;1,400&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Jost', sans-serif; }
    .font-display { font-family: 'Cormorant Garamond', serif; }


    /* Category underline */
    .cat-tab { position: relative; cursor: pointer; transition: color 0.25s; }
    .cat-tab::after {
      content: '';
      position: absolute;
      bottom: 0; left: 0;
      width: 0; height: 2px;
      background: #C9973A;
      transition: width 0.3s ease;
    }
    .cat-tab.active { color: #C9973A; }
    .cat-tab.active::after { width: 100%; }

    /* Dish card hover */
    .dish-card { transition: transform 0.25s ease, box-shadow 0.25s ease; }
    .dish-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,0.10); }

    

    /* Reveal */
    .reveal { opacity: 0; transform: translateY(18px); transition: opacity 0.65s ease, transform 0.65s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    /* Toast */
    .toast-enter { animation: toastIn 0.3s ease forwards; }
    @keyframes toastIn { from { opacity:0; transform:translateX(-50%) translateY(10px); } to { opacity:1; transform:translateX(-50%) translateY(0); } }

    /* Loading pulse */
    @keyframes pulse { 0%,100% { opacity:1; } 50% { opacity:.5; } }
    .skeleton { animation: pulse 1.5s ease-in-out infinite; }

    /* Scrollbar hide on category tabs */
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
  </style>
</head>
<body class="bg-stone-50 text-gray-900">

<!-- Overlay -->
<div id="drawerOverlay" class="fixed inset-0 bg-black/50 z-40 hidden opacity-0 transition-opacity duration-300"></div>

<!-- ══════════════════════ NAVBAR ══════════════════════ -->
<?php
$activePage = 'menu';
include('includes/navbar.php');
?>
<!-- ══════════════════════ HERO ══════════════════════ -->
<div class="relative w-full overflow-hidden" style="height: clamp(320px, 55vh, 580px);">
  <img src="img/the menu.jpg" alt="The Menu" class="w-full h-full object-cover object-center">
  <div class="absolute inset-0 bg-gradient-to-b from-black/25 via-transparent to-black/65"></div>
  <!-- Title positioned bottom-right like screenshot -->
</div>


<!-- ══════════════════════ CATEGORY TABS ══════════════════════ -->
<div class="sticky top-[70px] z-30 bg-white border-b border-gray-100 shadow-sm">
  <div class="max-w-7xl mx-auto px-4">
    <ul id="categoryTabs" class="flex justify-center overflow-x-auto scrollbar-hide list-none">
      <li>
        <span data-cat="best"
          class="cat-tab active block !px-6 !py-4 text-sm font-medium tracking-wider whitespace-nowrap cursor-pointer">
          Best
        </span>
      </li>
      <li>
        <span data-cat="salads"
          class="cat-tab block !px-6 !py-4 text-sm font-medium tracking-wider text-gray-500 whitespace-nowrap cursor-pointer">
          Salads
        </span>
      </li>
      <li>
        <span data-cat="sandwich"
          class="cat-tab block !px-6 !py-4 text-sm font-medium tracking-wider text-gray-500 whitespace-nowrap cursor-pointer">
          Sandwich
        </span>
      </li>
      <li>
        <span data-cat="dishes"
          class="cat-tab block !px-6 !py-4 text-sm font-medium tracking-wider text-gray-500 whitespace-nowrap cursor-pointer">
          Dishes
        </span>
      </li>
    </ul>
  </div>
</div>


<!-- ══════════════════════ MENU GRID ══════════════════════ -->
<main class="max-w-7xl mx-auto px-4 py-10 min-h-[50vh]">

  <!-- Skeleton loader -->
  <div id="loadingState" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
    <?php for($i=0;$i<5;$i++): ?>
    <div class="bg-white rounded-lg overflow-hidden border border-gray-100 skeleton">
      <div class="bg-gray-200 w-full aspect-square"></div>
      <div class="p-3 space-y-2">
        <div class="bg-gray-200 h-3 rounded w-3/4"></div>
        <div class="bg-gray-200 h-2 rounded w-1/2"></div>
        <div class="bg-gray-200 h-8 rounded w-full"></div>
      </div>
    </div>
    <?php endfor; ?>
  </div>

  <!-- Menu items injected here -->
  <div id="menuContainer" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 hidden"></div>

  <!-- Empty state -->
  <div id="emptyState" class="hidden text-center py-24">
    <p class="font-display italic text-gray-300 text-3xl">No items in this category.</p>
  </div>

</main>


<!-- ══════════════════════ FOOTER ══════════════════════ -->
<?php 
$footerType = "menu";
include('includes/footer.php');
?>

<!-- ══════════════════════ SCRIPTS ══════════════════════ -->
<script>
const sessionLoggedIn = <?php echo json_encode(isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : false); ?>;





function showToast(msg) {
  const t = document.createElement('div');
  t.className = 'toast-enter fixed bottom-6 left-1/2 -translate-x-1/2 bg-gray-900 text-yellow-400 border border-yellow-500/40 text-xs tracking-wide uppercase px-5 py-3 rounded-full shadow-xl z-[9999]';
  t.style.transform = 'translateX(-50%)';
  t.textContent = msg;
  document.body.appendChild(t);
  setTimeout(() => { t.style.opacity = '0'; t.style.transition = 'opacity 0.4s'; setTimeout(() => t.remove(), 400); }, 2200);
}



/* ── Category tabs ── */
const tabs = document.querySelectorAll('#categoryTabs .cat-tab');

if (tabs.length > 0) {
  tabs.forEach(tab => {
    tab.addEventListener('click', function () {

      tabs.forEach(t => {
        t.classList.remove('active');
        t.classList.add('text-gray-500');
      });

      this.classList.add('active');
      this.classList.remove('text-gray-500');

      // Safe call
      if (typeof fetchMenuItems === "function") {
        fetchMenuItems(this.dataset.cat);
      } else {
        console.log("Category:", this.dataset.cat);
      }
    });
  });
}

/* ── Fetch menu ── */
function fetchMenuItems(category) {
  document.getElementById('loadingState').classList.remove('hidden');
  document.getElementById('menuContainer').classList.add('hidden');
  document.getElementById('emptyState').classList.add('hidden');

  fetch(`fetch.php?category=${encodeURIComponent(category)}`)
    .then(r => r.text())
    .then(text => {
      try { displayMenuItems(JSON.parse(text.trim())); }
      catch(e) { console.error('JSON error:', e.message, text); displayMenuItems([]); }
    })
    .catch(err => { console.error(err); displayMenuItems([]); });
}

function displayMenuItems(items) {
  document.getElementById('loadingState').classList.add('hidden');
  const container = document.getElementById('menuContainer');
  container.innerHTML = '';

  if (!items.length) {
    document.getElementById('emptyState').classList.remove('hidden');
    return;
  }

  container.classList.remove('hidden');

  items.forEach((item, i) => {
    const card = document.createElement('div');
    card.className = 'dish-card bg-white rounded-lg overflow-hidden border border-gray-100 shadow-sm reveal';
    card.style.transitionDelay = `${i * 55}ms`;
    card.dataset.id    = item.id;
    card.dataset.name  = item.name;
    card.dataset.price = item.price;
    card.innerHTML = `
      <div class="w-full aspect-square overflow-hidden bg-gray-100">
        <img src="${item.image_path}" alt="${item.name}"
             class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
             loading="lazy">
      </div>
      <div class="p-3">
        <p class="text-sm font-medium text-gray-800 leading-snug mb-1 truncate">${item.name}</p>
        <div class="border-t border-yellow-400/50 my-2"></div>
        <p class="text-xs text-gray-500 tracking-wider uppercase mb-3">
          PRICE — <span class="text-yellow-600 font-medium">₹${item.price}</span>
        </p>
        <button
          onclick="addToCart('${item.id}', '${item.name.replace(/'/g,"\\'")}', '${item.price}')"
          class="w-full border border-yellow-500 text-yellow-600 hover:bg-yellow-500 hover:text-white text-xs font-medium tracking-wide uppercase py-2 rounded-full transition-colors">
          Add to Order
        </button>
      </div>
    `;
    container.appendChild(card);

    // Trigger reveal with stagger
    requestAnimationFrame(() => {
      setTimeout(() => card.classList.add('visible'), i * 55 + 60);
    });
  });
}

// Load default
fetchMenuItems('best');

/* ── Scroll reveal ── */
const io = new IntersectionObserver(entries => {
  entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }});
}, { threshold: 0.08 });
document.querySelectorAll('.reveal').forEach(el => io.observe(el));
</script>
<script src="js/main.js"></script>
</body>
</html>