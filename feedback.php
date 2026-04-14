<?php
include('connection.php');
session_start();
error_reporting(0);

$success = false;
if (isset($_POST['submit'])) {
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $name    = mysqli_real_escape_string($con, $_POST['name']);
  $email   = mysqli_real_escape_string($con, $_POST['email']);
  $sql     = "INSERT INTO feedback (name, email, feedback) VALUES ('$name','$email','$comment')";
  if (mysqli_query($con, $sql)) {
    $success = true;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback — Restauranters</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,600;1,400&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Jost', sans-serif; }
    .font-display { font-family: 'Cormorant Garamond', serif; }

    /* Input focus gold ring */
    .gold-input:focus {
      outline: none;
      border-color: #C9973A;
      box-shadow: 0 0 0 3px rgba(201, 151, 58, 0.15);
    }

    /* Decorative background pattern */
    .feedback-bg {
      background-color: #111010;
      background-image:
        radial-gradient(circle at 20% 50%, rgba(201,151,58,0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(201,151,58,0.05) 0%, transparent 40%);
    }

    /* Success checkmark animation */
    @keyframes checkPop {
      0%   { transform: scale(0); opacity: 0; }
      70%  { transform: scale(1.2); }
      100% { transform: scale(1); opacity: 1; }
    }
    .check-anim { animation: checkPop 0.5s cubic-bezier(0.34,1.56,0.64,1) both; }

    /* Fade up */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .fade-up { animation: fadeUp 0.6s ease both; }
    .fade-up-1 { animation-delay: 0.1s; }
    .fade-up-2 { animation-delay: 0.2s; }
    .fade-up-3 { animation-delay: 0.3s; }
    .fade-up-4 { animation-delay: 0.4s; }
    .fade-up-5 { animation-delay: 0.5s; }
  </style>
</head>

<body class="bg-stone-50">

<?php
$activePage = 'feedback';
include('includes/navbar.php');
?>

<!-- ══════════════════════════════════════
     HERO SECTION
══════════════════════════════════════ -->
<section class="feedback-bg relative overflow-hidden">

  <!-- Decorative gold line -->
  <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(to right,transparent,rgba(201,151,58,0.5),transparent);"></div>

  <div class="max-w-7xl mx-auto px-4 py-16 md:py-24 grid md:grid-cols-2 gap-12 items-center">

    <!-- ── Left: Heading + decorative text ── -->
    <div class="text-center md:text-left fade-up fade-up-1">
      <span style="display:inline-block;font-size:0.68rem;font-weight:500;letter-spacing:0.28em;text-transform:uppercase;color:#C9973A;margin-bottom:1rem;">
        Share Your Experience
      </span>
      <h1 class="font-display text-white font-light"
          style="font-size:clamp(3rem,7vw,5.5rem);line-height:1.05;">
        We'd Love to<br>
        Hear Your<br>
        <em style="color:#E8B84B;">Thoughts</em>
      </h1>
      <p style="margin-top:1.5rem;font-size:0.9rem;font-weight:300;color:rgba(255,255,255,0.45);line-height:1.85;max-width:360px;"
         class="mx-auto md:mx-0 fade-up fade-up-2">
        Your feedback helps us grow. Whether it's a compliment, a suggestion,
        or anything in between — we're listening.
      </p>

      <!-- Decorative divider -->
      <div style="display:flex;align-items:center;gap:1rem;margin-top:2.5rem;" class="justify-center md:justify-start fade-up fade-up-3">
        <div style="width:40px;height:1px;background:rgba(201,151,58,0.5);"></div>
        <span style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;color:rgba(201,151,58,0.6);">✦</span>
        <div style="width:40px;height:1px;background:rgba(201,151,58,0.5);"></div>
      </div>

      <!-- Stats -->
      <div class="grid grid-cols-3 gap-4 mt-8 fade-up fade-up-4" style="max-width:360px;" class="mx-auto md:mx-0">
        <div class="text-center">
          <p class="font-display text-white" style="font-size:2rem;font-weight:300;line-height:1;">15K+</p>
          <p style="font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:rgba(255,255,255,0.35);margin-top:0.25rem;">Happy Guests</p>
        </div>
        <div class="text-center">
          <p class="font-display text-white" style="font-size:2rem;font-weight:300;line-height:1;">5★</p>
          <p style="font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:rgba(255,255,255,0.35);margin-top:0.25rem;">Avg Rating</p>
        </div>
        <div class="text-center">
          <p class="font-display text-white" style="font-size:2rem;font-weight:300;line-height:1;">2K+</p>
          <p style="font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:rgba(255,255,255,0.35);margin-top:0.25rem;">Reviews</p>
        </div>
      </div>
    </div>

    <!-- ── Right: Form card ── -->
    <div class="fade-up fade-up-2">
      <div style="background:rgba(255,255,255,0.04);border:1px solid rgba(201,151,58,0.2);border-radius:16px;padding:2.5rem;backdrop-filter:blur(10px);">

        <?php if ($success): ?>
        <!-- Success state -->
        <div class="text-center py-8">
          <div class="check-anim inline-flex items-center justify-center w-16 h-16 rounded-full mb-4"
               style="background:#C9973A;">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
          </div>
          <h2 class="font-display text-white text-3xl font-light mb-3">Thank You!</h2>
          <p style="color:rgba(255,255,255,0.5);font-size:0.9rem;line-height:1.75;margin-bottom:2rem;">
            Your feedback has been submitted successfully.<br>
            We truly appreciate you taking the time.
          </p>
          <a href="index.php"
             style="display:inline-block;background:#C9973A;color:#111010;font-size:0.75rem;font-weight:500;letter-spacing:0.12em;text-transform:uppercase;text-decoration:none;padding:0.75rem 2rem;border-radius:100px;transition:background 0.25s;">
            Back to Home
          </a>
        </div>

        <?php else: ?>
        <!-- Form -->
        <div style="margin-bottom:2rem;">
          <p style="font-size:0.68rem;letter-spacing:0.25em;text-transform:uppercase;color:#C9973A;margin-bottom:0.5rem;">Leave a Review</p>
          <h2 class="font-display text-white" style="font-size:2rem;font-weight:300;">Your Feedback</h2>
        </div>

        <form method="POST" id="feedbackForm" class="space-y-5">

          <!-- Name -->
          <div>
            <label style="display:block;font-size:0.68rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.4);margin-bottom:0.6rem;">
              Full Name
            </label>
            <input
              type="text"
              name="name"
              placeholder="e.g. Rahul Sharma"
              required
              class="gold-input"
              value="<?= htmlspecialchars($_SESSION['username'] ?? '') ?>"
              style="width:100%;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12);border-radius:8px;padding:0.75rem 1rem;color:white;font-family:'Jost',sans-serif;font-size:0.875rem;transition:border-color 0.25s,box-shadow 0.25s;"
            >
          </div>

          <!-- Email -->
          <div>
            <label style="display:block;font-size:0.68rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.4);margin-bottom:0.6rem;">
              Email Address
            </label>
            <input
              type="email"
              name="email"
              placeholder="your@email.com"
              required
              class="gold-input"
              value="<?= htmlspecialchars($_SESSION['useremail'] ?? '') ?>"
              style="width:100%;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12);border-radius:8px;padding:0.75rem 1rem;color:white;font-family:'Jost',sans-serif;font-size:0.875rem;transition:border-color 0.25s,box-shadow 0.25s;"
            >
          </div>

          <!-- Rating -->
          <div>
            <label style="display:block;font-size:0.68rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.4);margin-bottom:0.6rem;">
              Rating
            </label>
            <div id="starRating" style="display:flex;gap:0.5rem;">
              <?php for($i=1;$i<=5;$i++): ?>
              <button type="button" data-star="<?= $i ?>"
                style="background:none;border:none;font-size:1.75rem;cursor:pointer;color:rgba(255,255,255,0.2);transition:color 0.2s;line-height:1;"
                class="star-btn">★</button>
              <?php endfor; ?>
            </div>
            <input type="hidden" name="rating" id="ratingInput" value="0">
          </div>

          <!-- Feedback -->
          <div>
            <label style="display:block;font-size:0.68rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.4);margin-bottom:0.6rem;">
              Your Message
            </label>
            <textarea
              name="comment"
              placeholder="Tell us about your experience..."
              required
              rows="4"
              class="gold-input"
              style="width:100%;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12);border-radius:8px;padding:0.75rem 1rem;color:white;font-family:'Jost',sans-serif;font-size:0.875rem;resize:vertical;transition:border-color 0.25s,box-shadow 0.25s;"
            ></textarea>
          </div>

          <!-- Submit -->
          <button
            type="submit"
            name="submit"
            style="width:100%;background:#C9973A;color:#111010;font-family:'Jost',sans-serif;font-size:0.78rem;font-weight:500;letter-spacing:0.15em;text-transform:uppercase;padding:0.85rem 1rem;border-radius:100px;border:none;cursor:pointer;transition:background 0.25s,transform 0.2s;margin-top:0.5rem;"
            onmouseover="this.style.background='#E8B84B';this.style.transform='translateY(-1px)'"
            onmouseout="this.style.background='#C9973A';this.style.transform='translateY(0)'"
          >
            Submit Feedback →
          </button>

        </form>
        <?php endif; ?>

      </div>
    </div>

  </div><!-- end grid -->

  <!-- Bottom decorative line -->
  <div style="position:absolute;bottom:0;left:0;right:0;height:1px;background:linear-gradient(to right,transparent,rgba(201,151,58,0.3),transparent);"></div>

</section>

<!-- ══════════════════════════════════════
     TESTIMONIALS STRIP
══════════════════════════════════════ -->
<section class="bg-white py-14 px-4">
  <div class="max-w-7xl mx-auto">

    <div class="text-center mb-10">
      <span style="font-size:0.68rem;letter-spacing:0.25em;text-transform:uppercase;color:#C9973A;">What Others Say</span>
      <h2 class="font-display text-gray-800 mt-1" style="font-size:clamp(1.8rem,4vw,2.8rem);font-weight:300;">Guest Reviews</h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

      <?php
      $reviews = [
        ['name'=>'Priya M.',    'text'=>'Absolutely phenomenal food. The pasta was cooked to perfection and the ambience was warm and inviting.', 'stars'=>5],
        ['name'=>'Arjun S.',    'text'=>'Best Italian restaurant in the city. The service was outstanding and every dish exceeded our expectations.', 'stars'=>5],
        ['name'=>'Neha K.',     'text'=>'A wonderful dining experience. The staff made us feel so welcome. Will definitely be coming back soon!', 'stars'=>4],
      ];
      foreach ($reviews as $r):
      ?>
      <div style="background:#f9f7f4;border:1px solid #f0ece4;border-radius:12px;padding:1.75rem;">
        <div style="display:flex;gap:0.2rem;margin-bottom:1rem;">
          <?php for($s=0;$s<5;$s++): ?>
            <span style="color:<?= $s < $r['stars'] ? '#C9973A' : '#e5e7eb' ?>;font-size:1rem;">★</span>
          <?php endfor; ?>
        </div>
        <p style="font-size:0.875rem;color:#6b7280;line-height:1.75;margin-bottom:1.25rem;font-style:italic;">
          "<?= $r['text'] ?>"
        </p>
        <p style="font-size:0.78rem;font-weight:500;color:#374151;letter-spacing:0.04em;">— <?= $r['name'] ?></p>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>

<?php include('includes/footer.php'); ?>

<script>
/* ── Star rating ── */
document.addEventListener('DOMContentLoaded', function () {
  const stars      = document.querySelectorAll('.star-btn');
  const ratingInput = document.getElementById('ratingInput');
  if (!stars.length) return;

  let selected = 0;

  stars.forEach(star => {
    // Hover
    star.addEventListener('mouseenter', function () {
      const val = parseInt(this.dataset.star);
      stars.forEach((s, i) => {
        s.style.color = i < val ? '#C9973A' : 'rgba(255,255,255,0.2)';
      });
    });

    // Mouse leave — revert to selected
    star.addEventListener('mouseleave', function () {
      stars.forEach((s, i) => {
        s.style.color = i < selected ? '#C9973A' : 'rgba(255,255,255,0.2)';
      });
    });

    // Click
    star.addEventListener('click', function () {
      selected = parseInt(this.dataset.star);
      ratingInput.value = selected;
      stars.forEach((s, i) => {
        s.style.color = i < selected ? '#C9973A' : 'rgba(255,255,255,0.2)';
      });
    });
  });
});
</script>

</body>
</html>