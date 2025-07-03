<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bengal Tennis Association - About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
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

        .banner {
            width: 100%;
            height: 400px;
            background: linear-gradient(rgba(0, 26, 15, 0.7), rgba(0, 26, 15, 0.8)), url('https://storage.googleapis.com/tennis-khelo.appspot.com/academies/fd667fb8-2e24-4c1b-b7dc-a37abc4419d6.jpg') no-repeat center center;
            background-size: cover;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo {
            max-width: 180px;
        }

        .about-section {
            padding: 60px 15px;
        }

        .about-section h2 {
            margin-bottom: 20px;
            color: #198754;
        }

        .location-text {
            margin-top: 30px;
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

    <!-- About Section -->
    <div class="container about-section">
        <h2 class="text-center">Terms & Conditions</h2>
        <p><strong>Refund Policy</strong><br>
            Once paid and credited into our account there is no options for refund or return. Any excess amount received
            will be settled with future outstanding amount at the BTA office.
        </p>

        <p><strong>Cancellation Policy</strong><br>
            There will be no refund in case of any cancelled transactions. Any payment discrepancy will be settled at
            the BTA office.
        </p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
