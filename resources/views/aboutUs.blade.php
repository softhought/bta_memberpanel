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

    <div class="banner">
        <div class="tennis-ball"></div>
        <div class="tennis-ball"></div>
        <div class="tennis-ball"></div>
        <img src="https://storage.googleapis.com/tennis-khelo.appspot.com/academies/fd667fb8-2e24-4c1b-b7dc-a37abc4419d6.jpg"
            alt="BTA Logo" class="logo bg-white p-2 rounded">
    </div>

    <!-- About Section -->
    <div class="container about-section">
        <h2 class="text-center">About Us</h2>
        <p><strong>Purpose of this Portal</strong><br>
            This portal has been developed by BTA to serve as a user-friendly digital platform that enables students and
            guardians to conveniently manage and pay monthly coaching fees online. The system is designed to ensure a
            seamless, secure, and transparent transaction process, reducing the need for physical visits and manual
            payment methods. By streamlining the fee payment process, the portal enhances overall efficiency, improves
            financial tracking for both users and the institution, and supports timely communication regarding dues,
            receipts, and related updates.
        </p>

        <p><strong>BENGAL TENNIS ASSOCIATION</strong><br>
            The BTA Complex was inaugurated in March, 2003 followed by an ITF Futures Tournament. The Complex was
            offered through a ‘Lease Agreement’ by the West Bengal Government through the untiring efforts of Late Manik
            Goswami, who was the then Hony. Secretary of the Association and the present President Mr. Hironmoy
            Chatterjee.
        </p>

        <div class="location-text">
            <p><strong>Location: –</strong><br>
                Kolkata the ‘City of Joy’ lies on the banks of the river Hooghly and is the port of access to the
                Sunderbans Forests Reserves, River side retreats in Diamond Harbour and Raichak, white sand beaches of
                Bakhali, Digha, Mandermoni and Shankarpur and the Himalaya Mountains in Darjeeling, Sikkim and North
                East India. Situated on the periphery of the world famous ‘Vivekananda Yuba Bharti Krirangan’ (Salt Lake
                Stadium) in Eastern India’s most modern settlement – Salt Lake, Kolkata, the Bengal Tennis Association
                has excellent tennis infrastructure. The Bengal Tennis Association’s tennis centre boasts of a secure,
                tranquil and green environment for integrated tennis and fitness.
            </p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
