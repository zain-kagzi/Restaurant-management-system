<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout — Restauranters</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,600;1,400&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">

  <style>
    :root {
      --gold: #C9973A;
      --gold-light: #E8B84B;
      --dark: #111010;
    }
    body { font-family: 'Jost', sans-serif; }
    .font-display { font-family: 'Cormorant Garamond', serif; }

    /* Qty button hover */
    .qty-btn { transition: background 0.2s, color 0.2s; }
    .qty-btn:hover { background: #C9973A; color: #111010; }

    /* Row fade-in */
    @keyframes rowIn {
      from { opacity: 0; transform: translateX(-10px); }
      to   { opacity: 1; transform: translateX(0); }
    }
    .cart-row { animation: rowIn 0.35s ease both; }

    input:focus { outline: none; border-color: #C9973A !important; box-shadow: 0 0 0 3px rgba(201,151,58,0.15); }
  </style>
</head>

<body class="bg-stone-50 min-h-screen">

  <!-- ── Simple top bar ── -->
  <div class="bg-gray-900 border-b border-yellow-700/20 py-4 px-6 flex items-center justify-between">
    <a href="index.php" class="font-display text-white text-xl font-semibold tracking-wide">Restauranters</a>
    <a href="menu.php" class="text-yellow-500 hover:text-yellow-400 text-xs tracking-widest uppercase transition-colors">← Back to Menu</a>
  </div>

  <div class="max-w-5xl mx-auto px-4 py-12">

    <!-- Page heading -->
    <div class="mb-10 text-center">
      <span class="text-xs tracking-[0.25em] uppercase text-yellow-600">Almost there</span>
      <h1 class="font-display text-4xl md:text-5xl font-light mt-1">Your Order</h1>
    </div>

    <div class="grid md:grid-cols-5 gap-8 items-start">

      <!-- ══════════════════════
           LEFT: CART ITEMS
      ══════════════════════ -->
      <div class="md:col-span-3 bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
          <h2 class="font-display text-2xl font-light">Cart Items</h2>
          <button onclick="clearCart()"
            class="text-xs tracking-wider uppercase text-gray-400 hover:text-red-500 transition-colors">
            Clear All
          </button>
        </div>

        <!-- Empty state -->
        <div id="emptyCart" class="hidden px-6 py-16 text-center">
          <p class="font-display italic text-gray-300 text-2xl mb-4">Your cart is empty</p>
          <a href="menu.php" class="inline-block bg-yellow-500 hover:bg-yellow-400 text-gray-900 text-xs font-medium tracking-widest uppercase px-6 py-2.5 rounded-full transition-colors">
            Browse Menu
          </a>
        </div>

        <!-- Cart rows -->
        <ul id="cartList" class="divide-y divide-gray-50 px-6"></ul>

        <!-- Cart footer -->
        <div id="cartFooter" class="px-6 py-4 bg-gray-50 border-t border-gray-100">
          <div class="flex items-center justify-between mb-1">
            <span class="text-xs tracking-widest uppercase text-gray-400">Subtotal</span>
            <span class="text-sm font-medium text-gray-700">₹<span id="subtotal">0.00</span></span>
          </div>
          <div class="flex items-center justify-between mb-1">
            <span class="text-xs tracking-widest uppercase text-gray-400">Tax (5%)</span>
            <span class="text-sm font-medium text-gray-700">₹<span id="taxAmt">0.00</span></span>
          </div>
          <div class="flex items-center justify-between pt-3 border-t border-gray-200 mt-3">
            <span class="text-xs tracking-widest uppercase font-medium text-gray-700">Total</span>
            <span class="font-display text-2xl text-yellow-600">₹<span id="grandTotal">0.00</span></span>
          </div>
        </div>

      </div>

      <!-- ══════════════════════
           RIGHT: CHECKOUT FORM
      ══════════════════════ -->
      <div class="md:col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-100">
          <h2 class="font-display text-2xl font-light">Your Details</h2>
        </div>

        <form action="process.php" method="POST" class="px-6 py-6 space-y-4" id="checkoutForm">

          <!-- Hidden: cart data sent to server -->
          <input type="hidden" name="cart_data" id="cartDataInput">

          <!-- Name -->
          <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-1.5">Full Name</label>
            <input type="text" name="customer_name"
              value="<?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>"
              placeholder="Your name"
              required
              class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-800 transition-all">
          </div>

          <!-- Email -->
          <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-1.5">Email</label>
            <input type="email" name="customer_email"
              value="<?php echo htmlspecialchars($_SESSION['useremail'] ?? ''); ?>"
              placeholder="your@email.com"
              required
              class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-800 transition-all">
          </div>

          <!-- Table number -->
          <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-1.5">Table Number</label>
            <input type="text" name="table_no"
              placeholder="e.g. 7"
              required
              class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-800 transition-all">
          </div>

          <!-- Special instructions -->
          <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-1.5">Special Instructions <span class="normal-case text-gray-300">(optional)</span></label>
            <textarea name="instructions" rows="3"
              placeholder="Allergies, preferences..."
              class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-800 transition-all resize-none"></textarea>
          </div>

          <!-- Submit -->
          <button type="submit" id="placeOrderBtn"
            class="w-full bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-medium text-sm tracking-widest uppercase py-3 rounded-full transition-colors mt-2 disabled:opacity-40 disabled:cursor-not-allowed">
            Place Order →
          </button>

          <p class="text-center text-xs text-gray-300 tracking-wide">Secure order · No payment needed now</p>

        </form>
      </div>

    </div>
  </div>

  <!-- ══════════════════════════════════════
       JAVASCRIPT — Cart read from localStorage
  ══════════════════════════════════════ -->
  <script>
  document.addEventListener('DOMContentLoaded', function () {

    let cart = [];
    try { cart = JSON.parse(localStorage.getItem('cart') || '[]'); } catch(e) { cart = []; }

    const cartList    = document.getElementById('cartList');
    const emptyCart   = document.getElementById('emptyCart');
    const cartFooter  = document.getElementById('cartFooter');
    const subtotalEl  = document.getElementById('subtotal');
    const taxEl       = document.getElementById('taxAmt');
    const grandEl     = document.getElementById('grandTotal');
    const placeBtn    = document.getElementById('placeOrderBtn');
    const cartInput   = document.getElementById('cartDataInput');

    // ── Render cart ──
    function renderCart() {
      cartList.innerHTML = '';

      if (!cart.length) {
        emptyCart.classList.remove('hidden');
        cartFooter.classList.add('hidden');
        placeBtn.disabled = true;
        cartInput.value = '[]';
        return;
      }

      emptyCart.classList.add('hidden');
      cartFooter.classList.remove('hidden');
      placeBtn.disabled = false;
      cartInput.value = JSON.stringify(cart);

      cart.forEach((item, index) => {
        const li = document.createElement('li');
        li.className = 'cart-row flex items-center gap-4 py-4';
        li.style.animationDelay = `${index * 60}ms`;
        li.innerHTML = `
          <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-800 truncate">${item.name}</p>
            <p class="text-xs text-gray-400 mt-0.5">₹${parseFloat(item.price).toFixed(0)} each</p>
          </div>

          <!-- Qty controls -->
          <div class="flex items-center gap-1 shrink-0">
            <button onclick="changeQty(${index}, -1)"
              class="qty-btn w-7 h-7 rounded-full border border-gray-200 text-gray-500 text-sm flex items-center justify-center">
              −
            </button>
            <span class="w-6 text-center text-sm font-medium text-gray-800">${item.qty}</span>
            <button onclick="changeQty(${index}, 1)"
              class="qty-btn w-7 h-7 rounded-full border border-gray-200 text-gray-500 text-sm flex items-center justify-center">
              +
            </button>
          </div>

          <!-- Item total -->
          <div class="text-sm font-medium text-yellow-600 w-16 text-right shrink-0">
            ₹${(item.price * item.qty).toFixed(0)}
          </div>

          <!-- Remove -->
          <button onclick="removeItem(${index})"
            class="text-gray-300 hover:text-red-400 transition-colors shrink-0 text-lg leading-none ml-1">
            ×
          </button>
        `;
        cartList.appendChild(li);
      });

      updateTotals();
    }

    // ── Totals ──
    function updateTotals() {
      const subtotal = cart.reduce((s, i) => s + i.price * i.qty, 0);
      const tax      = subtotal * 0.05;
      const grand    = subtotal + tax;
      subtotalEl.textContent = subtotal.toFixed(2);
      taxEl.textContent      = tax.toFixed(2);
      grandEl.textContent    = grand.toFixed(2);
    }

    // ── Change quantity ──
    window.changeQty = function(index, delta) {
      cart[index].qty += delta;
      if (cart[index].qty <= 0) {
        cart.splice(index, 1);
      }
      save();
      renderCart();
    };

    // ── Remove item ──
    window.removeItem = function(index) {
      cart.splice(index, 1);
      save();
      renderCart();
    };

    // ── Clear cart ──
    window.clearCart = function() {
      cart = [];
      save();
      renderCart();
    };

    // ── Save to localStorage ──
    function save() {
      localStorage.setItem('cart', JSON.stringify(cart));
    }

    // Initial render
    renderCart();
  });
  </script>

</body>
</html>