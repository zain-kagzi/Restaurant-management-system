<?php
// includes/footer.php
// Usage: include('includes/footer.php'); at the bottom of any page.
// Make sure session_start() is called BEFORE including this file.
?>

<style>
  /* ════════════════════════════
     FOOTER
  ════════════════════════════ */
  .site-footer {
    background: var(--dark-2, #1a1a18);
    color: var(--white, #ffffff);
    border-top: 1px solid rgba(201, 151, 58, 0.2);
    margin-top: auto;
  }

  /* ── CTA strip ── */
  .footer-cta {
    text-align: center;
    padding: 5rem 1.5rem 4rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.07);
  }

  .footer-cta-eyebrow {
    display: inline-block;
    font-size: 0.7rem;
    font-weight: 400;
    letter-spacing: 0.28em;
    text-transform: uppercase;
    color: var(--gold, #C9973A);
    margin-bottom: 1rem;
  }

  .footer-cta-heading {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 300;
    line-height: 1.1;
    color: var(--white, #ffffff);
    margin-bottom: 2rem;
  }

  .footer-cta-btn {
    display: inline-block;
    background: var(--gold, #C9973A);
    color: var(--dark, #111010);
    font-family: 'Jost', sans-serif;
    font-size: 0.75rem;
    font-weight: 500;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    text-decoration: none;
    padding: 0.85rem 2.2rem;
    border-radius: 100px;
    transition: background 0.25s ease, transform 0.2s ease;
  }

  .footer-cta-btn:hover {
    background: var(--gold-light, #E8B84B);
    transform: translateY(-2px);
  }

  /* ── Info grid ── */
  .footer-grid {
    max-width: 1280px;
    margin: 0 auto;
    padding: 3.5rem 2rem;
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    gap: 3rem;
  }

  .footer-brand-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.5rem;
    font-weight: 300;
    letter-spacing: 0.05em;
    color: var(--white, #ffffff);
    margin-bottom: 0.75rem;
  }

  .footer-brand-desc {
    font-size: 0.82rem;
    font-weight: 300;
    color: rgba(255, 255, 255, 0.42);
    line-height: 1.8;
    max-width: 260px;
  }

  .footer-col-title {
    font-size: 0.65rem;
    font-weight: 500;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--gold, #C9973A);
    margin-bottom: 1.1rem;
  }

  .footer-col p,
  .footer-col address {
    font-size: 0.82rem;
    font-weight: 300;
    font-style: normal;
    color: rgba(255, 255, 255, 0.48);
    line-height: 2;
  }

  .footer-col a {
    color: rgba(255, 255, 255, 0.48);
    text-decoration: none;
    transition: color 0.2s;
  }

  .footer-col a:hover { color: var(--gold, #C9973A); }

  /* ── Bottom bar ── */
  .footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.07);
    padding: 1.5rem 2rem;
    text-align: center;
    font-size: 0.72rem;
    font-weight: 300;
    letter-spacing: 0.06em;
    color: rgba(255, 255, 255, 0.25);
  }

  /* ── Responsive ── */
  @media (max-width: 900px) {
    .footer-grid {
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      padding: 2.5rem 1.5rem;
    }

    .footer-brand { grid-column: 1 / -1; }
    .footer-brand-desc { max-width: 100%; }
  }

  @media (max-width: 540px) {
    .footer-grid {
      grid-template-columns: 1fr;
      gap: 2rem;
    }

    .footer-cta { padding: 3rem 1.5rem 2.5rem; }
  }
</style>

<!-- ══════════════════════════════════════
     FOOTER
══════════════════════════════════════ -->
<footer class="site-footer">

  <!-- CTA -->
  <div class="footer-cta">
<?php
if (!isset($footerType)) {
    $footerType = "default"; // fallback
}

if ($footerType === "home") {
?>
    <span class="footer-cta-eyebrow">Reserve Your Evening</span>
    <h2 class="footer-cta-heading reveal">Ready to Order?</h2>
    <a href="menu.php" class="footer-cta-btn reveal">Explore the Menu →</a>

<?php
} elseif ($footerType === "menu") {
?>
    <span class="footer-cta-eyebrow">Your order is waiting</span>
    <h2 class="footer-cta-heading reveal">Added Your Order?</h2>
    <a href="checkout.php" class="footer-cta-btn reveal">Proceed →</a>

<?php
} else {
?>
    <span class="footer-cta-eyebrow">Welcome</span>
    <h2 class="footer-cta-heading reveal">Explore More</h2>
    <a href="menu.php" class="footer-cta-btn reveal">View Menu →</a>
<?php
}
?>
</div>

  <!-- Info grid -->
  <div class="footer-grid">

    <!-- Brand -->
    <div class="footer-brand">
      <p class="footer-brand-name">Restauranters</p>
      <p class="footer-brand-desc">
        A celebration of Italian culinary heritage, crafted with love
        and served with warmth. Fine dining, without pretension.
      </p>
    </div>

    <!-- Contact -->
    <div class="footer-col">
      <p class="footer-col-title">Contact</p>
      <address>
        Phone: <a href="tel:1234567890">1234567890</a><br>
        Email: <a href="mailto:123@gmail.com">123@gmail.com</a><br>
        Kioto-street, 2100002
      </address>
    </div>

    <!-- News -->
    <div class="footer-col">
      <p class="footer-col-title">Latest News</p>
      <p>
        Restaurant of the Year 2025<br>
        Best Italian — City Guide<br>
        Chef's Table Award 2024
      </p>
    </div>

  </div>

  <!-- Bottom bar -->
  <div class="footer-bottom">
    &copy; <?= date('Y') ?> Restauranters &middot; All rights reserved &middot; Italian Fine Dining
  </div>

</footer>
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



