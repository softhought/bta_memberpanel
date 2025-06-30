<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Bengal Tennis Association</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #198754;
            --primary-dark: #0d6e3f;
            --secondary: #ffd700;
            --light: #f8f9fa;
            --dark: #001a0f;
            --accent: #e8f5e9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9f5eb 100%);
            color: #333;
            line-height: 1.6;
            overflow-x: hidden;
        }

        .banner {
            width: 100%;
            height: 400px;
            background: linear-gradient(rgba(0, 26, 15, 0.7), rgba(0, 26, 15, 0.8)),
                url('https://storage.googleapis.com/tennis-khelo.appspot.com/academies/fd667fb8-2e24-4c1b-b7dc-a37abc4419d6.jpg') no-repeat center center;
            background-size: cover;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo {
            max-width: 180px;
            transition: transform 0.3s ease;
            z-index: 10;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .tennis-ball {
            position: absolute;
            width: 50px;
            height: 50px;
            background: url('https://toppng.com/uploads/preview/tennis-ball-11530957551sn9bhrgmcq.png') no-repeat center center;
            background-size: cover;
            border-radius: 50%;
            opacity: 0.8;
            animation: float 8s infinite ease-in-out;
        }


        .tennis-ball:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .tennis-ball:nth-child(2) {
            top: 40%;
            right: 15%;
            animation-delay: 1.5s;
        }

        .tennis-ball:nth-child(3) {
            bottom: 30%;
            left: 20%;
            animation-delay: 3s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) translateX(0);
            }

            25% {
                transform: translateY(-20px) translateX(15px);
            }

            50% {
                transform: translateY(10px) translateX(-15px);
            }

            75% {
                transform: translateY(-15px) translateX(10px);
            }
        }

        .contact-section {
            padding: 80px 15px;
            position: relative;
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 50px;
            color: var(--primary-dark);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--secondary);
            border-radius: 2px;
        }

        .contact-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-top: 4px solid var(--primary);
        }

        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .contact-icon {
            width: 70px;
            height: 70px;
            background: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            color: var(--primary);
            font-size: 28px;
            transition: all 0.3s ease;
        }

        .contact-card:hover .contact-icon {
            background: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        .contact-details h5 {
            color: var(--primary-dark);
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .contact-details h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--secondary);
        }

        .contact-details p {
            font-size: 16px;
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }

        .contact-details i {
            color: var(--primary);
            margin-right: 12px;
            min-width: 20px;
            margin-top: 4px;
        }

        .contact-details a {
            color: var(--primary);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .contact-details a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .enquiry-form-section {
            background: linear-gradient(135deg, var(--dark) 0%, #003320 100%);
            color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .enquiry-form-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            transform: rotate(30deg);
            pointer-events: none;
        }

        .enquiry-form-section h4 {
            position: relative;
            font-weight: 600;
            margin-bottom: 30px;
            padding-bottom: 15px;
        }

        .enquiry-form-section h4::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary);
            border-radius: 2px;
        }

        .enquiry-form input,
        .enquiry-form textarea {
            background-color: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 8px;
            margin-bottom: 20px;
            color: #333;
            padding: 15px 20px;
            font-size: 16px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .enquiry-form input:focus,
        .enquiry-form textarea:focus {
            background-color: white;
            box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.2);
            outline: none;
        }

        .enquiry-form input::placeholder,
        .enquiry-form textarea::placeholder {
            color: #777;
        }

        .enquiry-form textarea {
            min-height: 150px;
            resize: vertical;
        }

        .enquiry-form button {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 15px 30px;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            width: 100%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
        }

        .enquiry-form button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: 0.5s;
        }

        .enquiry-form button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .enquiry-form button:hover::before {
            left: 100%;
        }

        .map-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            margin-top: 60px;
            border: 8px solid white;
            position: relative;
        }

        .map-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 2px solid var(--primary);
            border-radius: 10px;
            pointer-events: none;
            z-index: 10;
        }

        iframe {
            width: 100%;
            height: 400px;
            display: block;
        }

        .alert {
            border-radius: 8px;
            font-weight: 500;
        }

        .tennis-court-pattern {
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            opacity: 0.05;
            background-image:
                linear-gradient(to right, var(--primary) 2px, transparent 2px),
                linear-gradient(to bottom, var(--primary) 2px, transparent 2px);
            background-size: 30px 30px;
            z-index: -1;
        }

        @media (max-width: 768px) {
            .banner {
                height: 300px;
            }

            .contact-section {
                padding: 50px 15px;
            }

            .contact-card {
                margin-bottom: 30px;
            }

            .enquiry-form-section {
                padding: 30px 20px;
            }

            .section-title {
                margin-bottom: 40px;
            }
        }

        .footer {
            background: var(--dark);
            color: white;
            padding: 30px 0;
            margin-top: 80px;
            text-align: center;
        }

        .social-icons a {
            color: white;
            font-size: 22px;
            margin: 0 12px;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--secondary);
            transform: translateY(-5px);
        }
    </style>
</head>

<body>
    <!-- Banner -->
    <div class="banner">
        <div class="tennis-ball"></div>
        <div class="tennis-ball"></div>
        <div class="tennis-ball"></div>
        <img src="https://storage.googleapis.com/tennis-khelo.appspot.com/academies/fd667fb8-2e24-4c1b-b7dc-a37abc4419d6.jpg"
            alt="BTA Logo" class="logo bg-white p-2 rounded">
    </div>

    <!-- Contact Section -->
    <div class="container contact-section">
        <h2 class="text-center section-title">Contact Us</h2>
        <div class="tennis-court-pattern"></div>

        <div class="row">
            <!-- Contact Info -->
            <div class="col-lg-5 mb-5 mb-lg-0">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-details">
                        <h5>BENGAL TENNIS ASSOCIATION</h5>
                        <p><i class="fas fa-location-dot"></i> Yuba Bharati Krirangan, Street Number 2, beside Gate, JB
                            Block, Sector 3, Bidhannagar, Kolkata, West Bengal 700106</p>
                        <p><i class="fas fa-phone"></i> +91 33 2335 5198 / 0506 / 1006 9500</p>
                        <p><i class="fas fa-envelope"></i> <a
                                href="mailto:bengaltennis1@gmail.com">bengaltennis1@gmail.com</a></p>
                    </div>
                </div>
            </div>

            <!-- Enquiry Form -->
            <div class="col-lg-7">
                <div class="enquiry-form-section">
                    <div class="position-relative">
                        <h4>Send Us a Message</h4>

                        @if (session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('enquiry.submit') }}" method="POST" class="enquiry-form">
                            @csrf
                            <input type="text" name="name" class="form-control" placeholder="Your Name">
                            <input type="email" name="email" class="form-control" placeholder="Email Address">
                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number">
                            <textarea name="message" class="form-control" rows="4" placeholder="Your Message..."></textarea>
                            <button type="submit" class="btn">
                                <i class="fas fa-paper-plane me-2"></i> Submit Enquiry
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Map -->
        <div class="row">
            <div class="col-12">
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58944.436383015665!2d88.38260799631038!3d22.57808322601198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a02756dfc9a74ed%3A0x8a49a664dd07039f!2sBENGAL%20TENNIS%20ASSOCIATION!5e0!3m2!1sen!2sin!4v1617189806438!5m2!1sen!2sin"
                        allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 Bengal Tennis Association. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple animation for form elements on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const contactCard = document.querySelector('.contact-card');
            const formSection = document.querySelector('.enquiry-form-section');

            // Animate elements when they come into view
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = "1";
                        entry.target.style.transform = "translateY(0)";
                    }
                });
            }, {
                threshold: 0.1
            });

            // Set initial styles for animation
            if (contactCard) {
                contactCard.style.opacity = "0";
                contactCard.style.transform = "translateY(20px)";
                contactCard.style.transition = "opacity 0.6s ease, transform 0.6s ease";
                observer.observe(contactCard);
            }

            if (formSection) {
                formSection.style.opacity = "0";
                formSection.style.transform = "translateY(20px)";
                formSection.style.transition = "opacity 0.6s ease 0.2s, transform 0.6s ease 0.2s";
                observer.observe(formSection);
            }
        });
    </script>
</body>

</html>
