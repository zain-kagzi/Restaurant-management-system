<?php
include('connection.php');
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            primary: '#c8a96e',
                            dark:    '#1a1a1a',
                            light:   '#f9f5ef',
                        }
                    },
                    fontFamily: {
                        display: ['"Playfair Display"', 'Georgia', 'serif'],
                        body:    ['"Lato"', 'sans-serif'],
                    },
                    keyframes: {
                        fadeUp: {
                            '0%':   { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    },
                    animation: {
                        'fade-up': 'fadeUp 0.8s ease forwards',
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        .hero-overlay { background: linear-gradient(to bottom, rgba(0,0,0,0.35) 0%, rgba(0,0,0,0.55) 100%); }
        .gold-divider  { background: linear-gradient(90deg, transparent, #c8a96e, transparent); }
        .team-card:hover .team-img { transform: scale(1.05); }
        .team-img { transition: transform 0.4s ease; }
        .section-animate { opacity: 0; animation: fadeUp 0.8s ease forwards; }
    </style>
</head>
<body class="font-body bg-brand-light text-brand-dark antialiased">

<!-- ─── NAVBAR ─────────────────────────────────────────────────────────────── -->
<?php
$activePage = 'about';
include('includes/navbar.php');
?>

<!-- ─── HERO IMAGE ──────────────────────────────────────────────────────────── -->
<div class="relative w-full h-56 sm:h-72 md:h-96 lg:h-[480px] overflow-hidden">
    <img src="img/About Us.jpg"
         alt="About Us hero"
         class="w-full h-full object-cover object-center">
    <div class="hero-overlay absolute inset-0 flex flex-col items-center justify-center text-center px-4">
        <span class="text-brand-primary font-display italic text-base sm:text-lg tracking-widest mb-1 opacity-0 section-animate" style="animation-delay:0.1s">Welcome to</span>
        <h1 class="font-display text-white text-3xl sm:text-5xl md:text-6xl font-bold tracking-tight opacity-0 section-animate" style="animation-delay:0.25s">Our Story</h1>
        <div class="gold-divider h-px w-24 mt-4 opacity-0 section-animate" style="animation-delay:0.4s"></div>
    </div>
</div>

<!-- ─── OUR STORY ───────────────────────────────────────────────────────────── -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
    <div class="flex flex-col md:flex-row items-center gap-10 lg:gap-20">

        <!-- Text -->
        <div class="w-full md:w-1/2 space-y-5">
            <p class="text-brand-primary font-display italic text-lg sm:text-xl tracking-wide">Discover</p>
            <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight text-brand-dark">
                Our Story
            </h2>
            <div class="gold-divider h-0.5 w-16"></div>
            <p class="text-gray-600 leading-relaxed text-base sm:text-lg">
                We make food from the heart, to your heart. We think, we care, we love what we are doing.
                Quality is our best feature; our mission is to make you satisfied.
                <span class="block mt-1">Our goal is your happiness.</span>
            </p>
            <p class="text-gray-600 leading-relaxed text-base sm:text-lg">
                Every dish we serve carries with it years of culinary passion, locally sourced ingredients,
                and a commitment to bringing people together around great food.
            </p>
            <a href="menu.php"
               class="inline-block mt-2 px-7 py-3 bg-brand-primary text-white font-body text-sm tracking-widest uppercase hover:bg-brand-dark transition-colors duration-300 rounded-sm shadow">
                View Our Menu
            </a>
        </div>

        <!-- Image -->
        <div class="w-full md:w-1/2 relative">
            <div class="absolute -top-3 -left-3 w-full h-full border border-brand-primary/40 rounded-sm pointer-events-none"></div>
            <img src="img/pexels-william-choquette-2641886.jpg"
                 alt="Our kitchen"
                 class="w-full h-64 sm:h-80 md:h-[420px] object-cover rounded-sm shadow-xl relative z-10">
        </div>
    </div>
</section>

<!-- ─── DIVIDER ──────────────────────────────────────────────────────────────── -->
<div class="gold-divider h-px w-full max-w-3xl mx-auto opacity-60"></div>

<!-- ─── MEET THE TEAM ────────────────────────────────────────────────────────── -->
<section class="bg-white py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Heading -->
        <div class="text-center mb-12 md:mb-16 space-y-3">
            <p class="text-brand-primary font-display italic text-base sm:text-lg tracking-wide">The People Behind the Flavours</p>
            <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-bold text-brand-dark">
                Meet Our <span class="text-brand-primary">Team</span>
            </h2>
            <div class="gold-divider h-0.5 w-16 mx-auto mt-2"></div>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">

            <!-- Card: Owner/Admin -->
            <div class="team-card flex flex-col items-center text-center group">
                <div class="overflow-hidden rounded-full w-36 h-36 sm:w-44 sm:h-44 border-4 border-brand-primary/30 shadow-lg mb-5">
                    <img src="img/pngegg (1).png"
                         alt="Admin"
                         class="team-img w-full h-full object-cover">
                </div>
                <span class="text-xs tracking-[0.2em] uppercase text-brand-primary font-body font-semibold mb-1">Owner</span>
                <h3 class="font-display text-xl text-brand-dark font-semibold">~ Admin ~</h3>
                <p class="text-gray-500 text-sm mt-2 max-w-xs">Visionary behind every detail, ensuring each guest feels at home.</p>
            </div>

            <!-- Card: Chef -->
            <div class="team-card flex flex-col items-center text-center group">
                <div class="overflow-hidden rounded-full w-36 h-36 sm:w-44 sm:h-44 border-4 border-brand-primary/30 shadow-lg mb-5">
                    <img src="img/pngegg (1).png"
                         alt="Chef"
                         class="team-img w-full h-full object-cover">
                </div>
                <span class="text-xs tracking-[0.2em] uppercase text-brand-primary font-body font-semibold mb-1">Staff</span>
                <h3 class="font-display text-xl text-brand-dark font-semibold">~ Chef ~</h3>
                <p class="text-gray-500 text-sm mt-2 max-w-xs">Crafting every dish with love, precision, and the finest ingredients.</p>
            </div>

            <!-- Card: Organizer -->
            <div class="team-card flex flex-col items-center text-center group sm:col-span-2 sm:mx-auto lg:col-span-1 lg:mx-0">
                <div class="overflow-hidden rounded-full w-36 h-36 sm:w-44 sm:h-44 border-4 border-brand-primary/30 shadow-lg mb-5">
                    <img src="img/pngegg (1).png"
                         alt="Employee"
                         class="team-img w-full h-full object-cover">
                </div>
                <span class="text-xs tracking-[0.2em] uppercase text-brand-primary font-body font-semibold mb-1">Organizer</span>
                <h3 class="font-display text-xl text-brand-dark font-semibold">~ Employee ~</h3>
                <p class="text-gray-500 text-sm mt-2 max-w-xs">Keeping everything running smoothly so your experience is seamless.</p>
            </div>

        </div>
    </div>
</section>

<!-- ─── FOOTER (placeholder — replace with your footer include) ──────────────── -->
<?php include('includes/footer.php'); ?>

<!-- ─── SCRIPTS ─────────────────────────────────────────────────────────────── -->
<script>
    // Mobile nav toggle
    const menuBtn    = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const iconOpen   = document.getElementById('iconOpen');
    const iconClose  = document.getElementById('iconClose');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        iconOpen.classList.toggle('hidden');
        iconClose.classList.toggle('hidden');
    });

    // Intersection Observer for scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.section-animate').forEach(el => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });
</script>
<script src="js/main.js"></script>
</body>
</html>