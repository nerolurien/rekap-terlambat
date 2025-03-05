<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #25a244;
            --error: #e63946;
            --background: #f8f9fd;
            --card-bg: #ffffff;
            --text: #333333;
            --text-light: #6c757d;
        }

        body {
            background: var(--background);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow: hidden;
        }

        /* Background animations */
        .bg-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .bg-circle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(67, 97, 238, 0.1), rgba(63, 55, 201, 0.1));
            animation: float 15s infinite ease-in-out;
        }

        .circle1 {
            width: 300px;
            height: 300px;
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }

        .circle2 {
            width: 500px;
            height: 500px;
            bottom: -200px;
            right: -200px;
            animation-delay: -5s;
        }

        .circle3 {
            width: 200px;
            height: 200px;
            top: 50%;
            right: 10%;
            animation-delay: -10s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-20px) scale(1.05);
            }
        }

        /* Login container */
        .login-container {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            position: relative;
            z-index: 10;
            overflow: hidden;
            animation: cardEntrance 1.2s ease-out forwards;
            transform: translateY(60px);
            opacity: 0;
        }

        @keyframes cardEntrance {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .login-title {
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 700;
            color: var(--text);
            font-size: 1.8rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .login-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 10px;
        }

        /* Form styles */
        .form-group {
            position: relative;
            margin-bottom: 1.8rem;
        }

        .form-control {
            height: 55px;
            padding: 0.7rem 1rem 0.7rem 3rem;
            font-size: 1rem;
            border-radius: 10px;
            border: 2px solid #e9ecef;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            background: #f8f9fa;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: var(--primary);
            background: white;
            transform: translateY(-5px);
        }

        .form-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            transition: all 0.3s;
            z-index: 2;
        }

        .form-label {
            position: absolute;
            left: 50px;
            top: 50%;
            transform: translateY(-50%);
            transition: all 0.3s;
            pointer-events: none;
            color: var(--text-light);
            font-weight: 500;
            z-index: 2;
        }

        .form-control:focus+.form-icon,
        .form-control:not(:placeholder-shown)+.form-icon {
            color: var(--primary);
        }

        .form-control:focus~.form-label,
        .form-control:not(:placeholder-shown)~.form-label {
            transform: translateY(-130%) translateX(-40px) scale(0.85);
            color: var(--primary);
            font-weight: 600;
        }

        /* Button */
        .btn-login {
            height: 55px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 10px;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            border: none;
            color: white;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            margin-top: 1rem;
            z-index: 1;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, var(--secondary), var(--primary));
            transition: all 0.5s;
            z-index: -1;
        }

        .btn-login:hover::before {
            left: 0;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 5px 10px rgba(67, 97, 238, 0.3);
        }

        /* Alerts */
        .alert {
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            animation: fadeInDown 0.5s ease;
            border: none;
        }

        .alert-success {
            background-color: rgba(37, 162, 68, 0.1);
            color: var(--success);
        }

        .alert-danger {
            background-color: rgba(230, 57, 70, 0.1);
            color: var(--error);
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Extra elements */
        .divider {
            margin: 1.5rem 0;
            text-align: center;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 1px;
            background: #e9ecef;
        }

        .divider span {
            position: relative;
            background: var(--card-bg);
            padding: 0 15px;
            color: var(--text-light);
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 1.5rem;
        }

        .social-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #e9ecef;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
        }

        .social-btn:hover {
            transform: translateY(-3px);
            border-color: var(--primary);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .footer-text {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .footer-link {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }

        .footer-link:hover {
            color: var(--secondary);
        }
    </style>
</head>

<body>
    <!-- Background Animations -->
    <div class="bg-animation">
        <div class="bg-circle circle1"></div>
        <div class="bg-circle circle2"></div>
        <div class="bg-circle circle3"></div>
    </div>

    <div class="login-container">
        <h3 class="login-title animate__animated animate__fadeIn">Rekap-Terlambat</h3>

        <div id="alertContainer">
            @if (session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ $errors->first() }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle me-2"></i> {{ session('error') }}
                </div>
            @endif

        </div>

        <form action="{{ route('login') }}" method="POST" id="loginForm">
            @csrf

            <div class="form-group animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                <input type="email" name="email" class="form-control" placeholder=" ">
                <i class="bi bi-envelope form-icon"></i>
                <label class="form-label">Email Address</label>
            </div>

            <div class="form-group animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
                <input type="password" name="password" class="form-control" placeholder=" ">
                <i class="bi bi-lock form-icon"></i>
                <label class="form-label">Password</label>
            </div>

            <button type="submit" class="btn btn-login w-100 animate__animated animate__fadeInUp"
                style="animation-delay: 0.6s" id="loginButton">
                Sign In
            </button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.0/bootstrap-icons.min.js"></script>
    <script>
        $(document).ready(function() {
            // Check for filled inputs on page load
            $('.form-control').each(function() {
                if ($(this).val() !== '') {
                    $(this).addClass('active');
                }
            });

            // Add loading animation to button
            $('#loginForm').submit(function() {
                $('#loginButton').html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Signing in...'
                    );
                $('#loginButton').prop('disabled', true);

                // Submit the form normally
                return true;
            });

            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').slideUp('slow');
            }, 5000);

            // Add wave effect to login button
            $('.btn-login').on('mousedown', function(e) {
                const x = e.pageX - $(this).offset().left;
                const y = e.pageY - $(this).offset().top;

                const ripple = $('<span class="ripple"></span>');
                ripple.css({
                    left: x + 'px',
                    top: y + 'px'
                });

                $(this).append(ripple);

                setTimeout(function() {
                    ripple.remove();
                }, 600);
            });

            // Add subtle parallax effect to background circles
            $(document).mousemove(function(e) {
                const moveX = (e.pageX * -1) / 50;
                const moveY = (e.pageY * -1) / 50;

                $('.circle1').css({
                    'transform': 'translate3d(' + moveX + 'px, ' + moveY + 'px, 0) scale(1)'
                });

                $('.circle2').css({
                    'transform': 'translate3d(' + (moveX * -1) + 'px, ' + (moveY * -1) +
                        'px, 0) scale(1)'
                });

                $('.circle3').css({
                    'transform': 'translate3d(' + (moveX * 0.5) + 'px, ' + (moveY * 0.5) +
                        'px, 0) scale(1)'
                });
            });

            // Add 3D tilt effect to the login container
            $('.login-container').on('mousemove', function(e) {
                const card = $(this);
                const cardWidth = card.width();
                const cardHeight = card.height();
                const centerX = card.offset().left + cardWidth / 2;
                const centerY = card.offset().top + cardHeight / 2;
                const mouseX = e.pageX - centerX;
                const mouseY = e.pageY - centerY;
                const rotateY = (mouseX / (cardWidth / 2)) * 3; // Max rotation 3deg
                const rotateX = -((mouseY / (cardHeight / 2)) * 3); // Max rotation 3deg

                card.css('transform', 'perspective(1000px) rotateX(' + rotateX + 'deg) rotateY(' + rotateY +
                    'deg) translateZ(0)');
            });

            $('.login-container').on('mouseleave', function() {
                $(this).css('transform', 'perspective(1000px) rotateX(0) rotateY(0) translateZ(0)');
            });

            // Add "typing" animation effect to form fields
            $('.form-control').on('focus', function() {
                const label = $(this).siblings('.form-label');
                const labelText = label.text();
                label.empty();

                // Create typing animation
                for (let i = 0; i < labelText.length; i++) {
                    setTimeout(function() {
                        label.append(labelText[i]);
                    }, i * 20);
                }
            });
        });

        // Add ripple effect style
        document.head.insertAdjacentHTML('beforeend', `
        <style>
            .ripple {
                position: absolute;
                background: rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
            }

            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        </style>
        `);
    </script>
</body>

</html>
