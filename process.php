<?php
include('connection.php');
session_start();

$customer_name  = $_POST['customer_name'];
$customer_email = $_POST['customer_email'];
$table_no       = $_POST['table_no'];
$instructions   = $_POST['instructions'] ?? '';

// ── Read cart from localStorage (sent via hidden input) ──
$cart_data = $_POST['cart_data'] ?? '[]';
$cart      = json_decode($cart_data, true);
if (!$cart) $cart = [];

// ── Build items list + totals ──
$items_list  = [];
$subtotal    = 0;
$date        = date("Y-m-d");
date_default_timezone_set("Asia/Kolkata");
$date2       = date("h:i A");
$ref_number  = strtoupper(uniqid('ORD'));

foreach ($cart as $item) {
  $dish_name  = mysqli_real_escape_string($con, $item['name']);
  $dish_qty   = (int)$item['qty'];
  $dish_price = (float)$item['price'];
  $item_total = $dish_price * $dish_qty;
  $subtotal  += $item_total;
  $items_list[] = [
    'name'  => $dish_name,
    'qty'   => $dish_qty,
    'price' => $dish_price,
    'total' => $item_total,
  ];
}

$tax       = round($subtotal * 0.05, 2);
$grand     = round($subtotal + $tax, 2);

// ── Build items string for DB ──
$items_str_db = implode(', ', array_map(fn($i) => "{$i['name']} x{$i['qty']}", $items_list));

// ── Insert into DB ──
$name_esc  = mysqli_real_escape_string($con, $customer_name);
$email_esc = mysqli_real_escape_string($con, $customer_email);
$table_esc = mysqli_real_escape_string($con, $table_no);
$inst_esc  = mysqli_real_escape_string($con, $instructions);

$sql = "INSERT INTO orders (name_dish, name_cust, email, table_no, price, date)
        VALUES ('$items_str_db','$name_esc','$email_esc','$table_esc','$grand','$date')";
$con->query($sql);

// ── Clear session cart if used ──
unset($_SESSION['cart']);
$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Confirmed — Restauranters</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,600;1,400&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Jost', sans-serif; }
    .font-display { font-family: 'Cormorant Garamond', serif; }

    @keyframes checkPop {
      0%   { transform: scale(0) rotate(-15deg); opacity: 0; }
      70%  { transform: scale(1.15) rotate(3deg); }
      100% { transform: scale(1) rotate(0deg); opacity: 1; }
    }
    .check-anim { animation: checkPop 0.6s cubic-bezier(0.34,1.56,0.64,1) 0.2s both; }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(16px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .fade-up { animation: fadeUp 0.5s ease both; }

    @keyframes rowIn {
      from { opacity: 0; transform: translateX(-8px); }
      to   { opacity: 1; transform: translateX(0); }
    }
    .row-in { animation: rowIn 0.4s ease both; }

    /* Print styles */
    @media print {
      .no-print { display: none !important; }
      body { background: white !important; }
      .print-card { box-shadow: none !important; border: 1px solid #ddd !important; }
    }
  </style>
</head>

<body class="bg-stone-100 min-h-screen py-10 px-4">

  <!-- Top bar -->
  <div class="no-print max-w-2xl mx-auto mb-6 flex items-center justify-between">
    <a href="index.php" class="font-display text-gray-700 text-xl font-semibold tracking-wide">Restauranters</a>
    <button onclick="window.print()"
      class="text-xs tracking-widest uppercase text-gray-500 hover:text-yellow-600 transition-colors flex items-center gap-1.5">
      🖨 Print Receipt
    </button>
  </div>

  <!-- ══════════════════════════════════
       RECEIPT CARD
  ══════════════════════════════════ -->
  <div class="print-card max-w-2xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

    <!-- Header -->
    <div class="bg-gray-900 px-8 pt-10 pb-8 text-center">
      <div class="check-anim inline-flex items-center justify-center w-16 h-16 rounded-full bg-yellow-500 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
        </svg>
      </div>
      <h1 class="font-display text-white text-4xl font-light fade-up" style="animation-delay:0.3s">Order Confirmed!</h1>
      <p class="text-white/50 text-sm mt-2 fade-up tracking-wide" style="animation-delay:0.4s">
        Thank you, <strong class="text-white/80"><?= htmlspecialchars($customer_name) ?></strong>. Your order is being prepared.
      </p>
    </div>

    <!-- Ref strip -->
    <div class="bg-yellow-500 px-8 py-3 flex items-center justify-between fade-up" style="animation-delay:0.5s">
      <span class="text-xs tracking-widest uppercase text-gray-800 font-medium">Reference</span>
      <span class="font-mono text-sm font-semibold text-gray-900"><?= $ref_number ?></span>
    </div>

    <div class="px-6 md:px-8 py-8 space-y-8">

      <!-- ── Order details ── -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 fade-up" style="animation-delay:0.55s">

        <div class="bg-stone-50 rounded-xl p-4 text-center">
          <p class="text-xs tracking-widest uppercase text-gray-400 mb-1">Table</p>
          <p class="font-display text-2xl font-semibold text-gray-800"><?= htmlspecialchars($table_no) ?></p>
        </div>

        <div class="bg-stone-50 rounded-xl p-4 text-center">
          <p class="text-xs tracking-widest uppercase text-gray-400 mb-1">Date</p>
          <p class="text-sm font-medium text-gray-700"><?= $date ?></p>
        </div>

        <div class="bg-stone-50 rounded-xl p-4 text-center">
          <p class="text-xs tracking-widest uppercase text-gray-400 mb-1">Time</p>
          <p class="text-sm font-medium text-gray-700"><?= $date2 ?></p>
        </div>

        <div class="bg-stone-50 rounded-xl p-4 text-center">
          <p class="text-xs tracking-widest uppercase text-gray-400 mb-1">Items</p>
          <p class="font-display text-2xl font-semibold text-gray-800"><?= count($items_list) ?></p>
        </div>

      </div>

      <!-- ── Bill / Items ── -->
      <div class="fade-up" style="animation-delay:0.6s">
        <h2 class="font-display text-2xl font-light mb-4 text-gray-800">Bill Summary</h2>

        <!-- Item rows -->
        <div class="border border-gray-100 rounded-xl overflow-hidden">

          <!-- Header row -->
          <div class="grid grid-cols-12 bg-gray-50 px-4 py-2.5 text-xs tracking-widest uppercase text-gray-400 border-b border-gray-100">
            <span class="col-span-5">Item</span>
            <span class="col-span-2 text-center">Qty</span>
            <span class="col-span-2 text-right">Price</span>
            <span class="col-span-3 text-right">Amount</span>
          </div>

          <!-- Items -->
          <?php foreach ($items_list as $i => $item): ?>
          <div class="row-in grid grid-cols-12 px-4 py-3.5 border-b border-gray-50 hover:bg-stone-50 transition-colors"
               style="animation-delay: <?= $i * 60 ?>ms">
            <span class="col-span-5 text-sm font-medium text-gray-800"><?= htmlspecialchars($item['name']) ?></span>
            <span class="col-span-2 text-center">
              <span class="inline-block bg-yellow-100 text-yellow-700 text-xs font-semibold px-2 py-0.5 rounded-full">
                ×<?= $item['qty'] ?>
              </span>
            </span>
            <span class="col-span-2 text-right text-sm text-gray-500">₹<?= number_format($item['price'], 0) ?></span>
            <span class="col-span-3 text-right text-sm font-medium text-gray-800">₹<?= number_format($item['total'], 0) ?></span>
          </div>
          <?php endforeach; ?>

          <!-- Totals -->
          <div class="px-4 py-4 bg-gray-50 space-y-2">

            <div class="flex items-center justify-between text-sm text-gray-500">
              <span class="tracking-wide">Subtotal</span>
              <span>₹<?= number_format($subtotal, 2) ?></span>
            </div>

            <div class="flex items-center justify-between text-sm text-gray-500">
              <span class="tracking-wide">GST (5%)</span>
              <span>₹<?= number_format($tax, 2) ?></span>
            </div>

            <?php if ($instructions): ?>
            <div class="pt-2 border-t border-gray-200">
              <p class="text-xs text-gray-400 tracking-wide">Note: <?= htmlspecialchars($instructions) ?></p>
            </div>
            <?php endif; ?>

            <div class="flex items-center justify-between pt-3 border-t border-gray-200">
              <span class="text-sm font-semibold tracking-widest uppercase text-gray-700">Grand Total</span>
              <span class="font-display text-3xl text-yellow-600 font-semibold">₹<?= number_format($grand, 2) ?></span>
            </div>

          </div>
        </div>
      </div>

      <!-- ── Customer info ── -->
      <div class="fade-up grid grid-cols-1 md:grid-cols-2 gap-4" style="animation-delay:0.65s">
        <div class="bg-stone-50 rounded-xl p-4">
          <p class="text-xs tracking-widest uppercase text-gray-400 mb-2">Customer</p>
          <p class="text-sm font-medium text-gray-800"><?= htmlspecialchars($customer_name) ?></p>
          <p class="text-xs text-gray-400 mt-0.5"><?= htmlspecialchars($customer_email) ?></p>
        </div>
        <div class="bg-stone-50 rounded-xl p-4">
          <p class="text-xs tracking-widest uppercase text-gray-400 mb-2">Status</p>
          <span class="inline-flex items-center gap-1.5 text-sm font-medium text-green-700 bg-green-50 px-3 py-1 rounded-full">
            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse inline-block"></span>
            Being Prepared
          </span>
        </div>
      </div>

      <!-- ── Actions ── -->
      <div class="no-print fade-up flex flex-col sm:flex-row gap-3" style="animation-delay:0.7s">
        <a href="menu.php"
           onclick="localStorage.removeItem('cart')"
           class="flex-1 text-center bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-medium text-sm tracking-widest uppercase py-3 rounded-full transition-colors">
          Return to Menu
        </a>
        <a href="index.php"
           class="flex-1 text-center border border-gray-200 text-gray-600 hover:border-gray-400 font-medium text-sm tracking-widest uppercase py-3 rounded-full transition-colors">
          Go to Home
        </a>
      </div>

    </div>

    <!-- Footer of receipt -->
    <div class="bg-gray-900 px-8 py-5 text-center">
      <p class="font-display text-white/60 text-sm italic">Thank you for dining with Restauranters</p>
      <p class="text-white/30 text-xs mt-1 tracking-wide">Kioto-street, 2100002 · 1234567890</p>
    </div>

  </div>

  <p class="no-print text-center text-gray-400 text-xs mt-6 tracking-wide">
    A confirmation has been sent to <?= htmlspecialchars($customer_email) ?>
  </p>

  <script>
    // Clear localStorage cart after order is placed
    localStorage.removeItem('cart');
  </script>

</body>
</html>