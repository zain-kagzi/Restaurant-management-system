<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            display: ['"Cormorant Garamond"', 'Georgia', 'serif'],
            body: ['"DM Sans"', 'sans-serif'],
          },
          colors: {
            cream: '#faf7f2',
            espresso: '#2c1a0e',
            gold: '#b8934a',
            'gold-light': '#d4aa6a',
            'warm-gray': '#8c7b6b',
          },
          keyframes: {
            slideUp: {
              '0%':   { opacity: '0', transform: 'translateY(24px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' },
            },
            fadeIn: {
              '0%':   { opacity: '0' },
              '100%': { opacity: '1' },
            }
          },
          animation: {
            'slide-up': 'slideUp 0.6s cubic-bezier(0.22,1,0.36,1) forwards',
            'fade-in':  'fadeIn 0.8s ease forwards',
          }
        }
      }
    }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    body { background-color: #faf7f2; }

    /* Animated background pattern */
    .bg-pattern {
      background-image:
        radial-gradient(circle at 20% 50%, rgba(184,147,74,0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(44,26,14,0.06) 0%, transparent 40%),
        radial-gradient(circle at 60% 80%, rgba(184,147,74,0.06) 0%, transparent 40%);
    }

    /* Custom input focus ring */
    .field-input {
      transition: border-color 0.25s ease, box-shadow 0.25s ease;
    }
    .field-input:focus {
      outline: none;
      border-color: #b8934a;
      box-shadow: 0 0 0 3px rgba(184,147,74,0.15);
    }


    /* Password toggle icon */
    .toggle-pw { cursor: pointer; user-select: none; }

    /* Fancy submit button shimmer */
    .btn-submit {
      background: linear-gradient(135deg, #b8934a 0%, #d4aa6a 50%, #b8934a 100%);
      background-size: 200% 100%;
      transition: background-position 0.4s ease, transform 0.15s ease, box-shadow 0.2s ease;
    }
    .btn-submit:hover {
      background-position: right center;
      transform: translateY(-1px);
      box-shadow: 0 8px 24px rgba(184,147,74,0.35);
    }
    .btn-submit:active { transform: translateY(0); }

    /* Decorative side line */
    .accent-line {
      background: linear-gradient(to bottom, transparent, #b8934a, transparent);
    }
  </style>
</head>
<body class="font-body min-h-screen flex items-center justify-center px-4 py-10 bg-pattern">

  <?php
include('connection.php');

if (isset($_POST['regs'])) {

  $name  = mysqli_real_escape_string($con, $_POST['name']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $pass  = mysqli_real_escape_string($con, $_POST['pass']);
  $cpass = mysqli_real_escape_string($con, $_POST['cpass']);

  // Validation
  if (empty($name) || empty($email) || empty($pass) || empty($cpass)) {
    echo '<script>alert("Please fill in all fields.")</script>';
  } 
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '<script>alert("Invalid email format.")</script>';
  }
  elseif ($pass !== $cpass) {
    echo '<script>alert("Passwords do not match.")</script>';
  } 
  else {

    // Check existing email
    $sql2 = "SELECT * FROM users WHERE email='$email'";
    $res  = mysqli_query($con, $sql2);

    if (mysqli_num_rows($res) > 0) {
      echo '<script>alert("Email already exists.")</script>';
    } 
    else {

      // Secure password hash
      $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

      $sql = "INSERT INTO users (name,email,password) 
              VALUES('$name','$email','$hashedPass')";

      if (mysqli_query($con, $sql)) {
        echo '<script>alert("Registration Successful!")</script>';
        echo '<script>window.location.href="login.php"</script>';
      } else {
        echo '<script>alert("Error occurred. Try again.")</script>';
      }
    }
  }
}
?>

  <!-- Card wrapper -->
  <div class="w-full max-w-sm sm:max-w-md relative">

    <!-- Decorative left accent line -->
    <div class="accent-line absolute -left-4 top-16 bottom-16 w-px hidden sm:block"></div>

    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-xl shadow-espresso/10 overflow-hidden">

      <!-- Card header band -->
      <div class="bg-espresso px-8 pt-8 pb-6 text-center">
        <p class="font-display italic text-gold text-sm tracking-[0.2em] mb-1">Welcome</p>
        <h1 class="font-display text-white text-3xl sm:text-4xl font-semibold leading-tight">Create Account</h1>
        <p class="text-warm-gray text-xs sm:text-sm mt-2 tracking-wide font-light">Join us and enjoy great experiences</p>
      </div>

      <!-- Form body -->
      <div class="px-6 sm:px-8 py-8 space-y-4 bg-gray-700">

        <form action="signup.php" method="POST" class="space-y-4" novalidate>

          <!-- Name -->
          <div class="card-field space-y-1">
            <label class="block text-xs font-medium tracking-widest uppercase text-warm-gray" for="name">Full Name</label>
            <div class="relative">
              <span class="absolute inset-y-0 left-3 flex items-center text-gold/70">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
              </span>
              <input id="name" type="text" name="name" placeholder="John Doe" required
                class="field-input w-full pl-9 pr-4 py-3 text-sm border border-gray-200 rounded-lg bg-cream/60 text-espresso placeholder-warm-gray/60 font-body">
            </div>
          </div>

          <!-- Email -->
          <div class="card-field space-y-1">
            <label class="block text-xs font-medium tracking-widest uppercase text-warm-gray" for="email">Email Address</label>
            <div class="relative">
              <span class="absolute inset-y-0 left-3 flex items-center text-gold/70">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
              </span>
              <input id="email" type="email" name="email" placeholder="you@example.com" required
                class="field-input w-full pl-9 pr-4 py-3 text-sm border border-gray-200 rounded-lg bg-cream/60 text-espresso placeholder-warm-gray/60 font-body">
            </div>
          </div>

          <!-- Password -->
          <div class="card-field space-y-1">
            <label class="block text-xs font-medium tracking-widest uppercase text-warm-gray" for="pass">Password</label>
            <div class="relative">
              <span class="absolute inset-y-0 left-3 flex items-center text-gold/70">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 11c0-1.1-.9-2-2-2s-2 .9-2 2 .9 2 2 2 2-.9 2-2zm6 0c0-1.1-.9-2-2-2s-2 .9-2 2 .9 2 2 2 2-.9 2-2zM5 21v-2a7 7 0 0114 0v2"/></svg>
              </span>
              <input id="pass" type="password" name="pass"  minlength="6" placeholder="Min. 8 characters" required
                class="field-input w-full pl-9 pr-10 py-3 text-sm border border-gray-200 rounded-lg bg-cream/60 text-espresso placeholder-warm-gray/60 font-body">
              <button type="button" onclick="togglePw('pass','eyePass')" class="toggle-pw absolute inset-y-0 right-3 flex items-center text-warm-gray hover:text-gold transition-colors">
                <svg id="eyePass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
              </button>
            </div>
          </div>

          <!-- Confirm Password -->
          <div class="card-field space-y-1">
            <label class="block text-xs font-medium tracking-widest uppercase text-warm-gray" for="cpass">Confirm Password</label>
            <div class="relative">
              <span class="absolute inset-y-0 left-3 flex items-center text-gold/70">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
              </span>
              <input id="cpass" type="password" name="cpass" placeholder="Repeat your password" required
                class="field-input w-full pl-9 pr-10 py-3 text-sm border border-gray-200 rounded-lg bg-cream/60 text-espresso placeholder-warm-gray/60 font-body">
              <button type="button" onclick="togglePw('cpass','eyeCpass')" class="toggle-pw absolute inset-y-0 right-3 flex items-center text-warm-gray hover:text-gold transition-colors">
                <svg id="eyeCpass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
              </button>
            </div>
          </div>

          <!-- Submit button -->
          <div class="card-field pt-1">
            <button type="submit" name="regs"
              class="btn-submit w-full py-3 rounded-xl text-white font-body font-medium text-sm tracking-widest uppercase">
              Create Account
            </button>
          </div>

          <!-- Login link -->
          <div class="card-field text-center pt-1">
            <p class="text-xs text-warm-gray">
              Already have an account?
              <a href="login.php" class="text-gold hover:text-gold-light font-medium transition-colors">Sign in</a>
            </p>
          </div>

        </form>
      </div>
    </div>

    <!-- Footer note -->
    <p class="text-center text-warm-gray/60 text-xs mt-6 font-light tracking-wide">
      By signing up, you agree to our Terms &amp; Privacy Policy.
    </p>
  </div>

  <script>
    function togglePw(fieldId, iconId) {
      const field = document.getElementById(fieldId);
      const icon  = document.getElementById(iconId);
      const isHidden = field.type === 'password';
      field.type = isHidden ? 'text' : 'password';
      icon.innerHTML = isHidden
        ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
        : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
    }
  </script>
</body>
</html>