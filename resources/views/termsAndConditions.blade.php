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

        <p><strong>Welcome to BENGAL TENNIS ASSOCIATION!</strong></p>

        <p><strong>Cookies</strong><br>We employ the use of cookies. By accessing BENGAL TENNIS ASSOCIATION. , you agreed to use cookies in agreement with the BENGAL TENNIS ASSOCIATION Privacy Policy.</p>
        <p>Most interactive websites use cookies to let us retrieve the user’s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p>
        <p><strong>License</strong><br>Unless otherwise stated, BENGAL TENNIS ASSOCIATION. and/or its licensors own the intellectual property rights for all material on BENGAL TENNIS ASSOCIATION. All intellectual property rights are reserved. You may access this from BENGAL TENNIS ASSOCIATION. for your own personal use subjected to restrictions set in these terms and conditions.</p>
        <p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. BENGAL TENNIS ASSOCIATION does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of BENGAL TENNIS ASSOCIATION, its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, BENGAL TENNIS ASSOCIATION. shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p>
        <p>You hereby grant BENGAL TENNIS ASSOCIATION. a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</p>

        <p><strong>Hyperlinking to our Content</strong><br>The following organizations may link to our Website without prior written approval:</p>

        <ul>
            <li>Search engines;</li>
            <li>News organizations;</li>
        </ul>

        <p>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party’s site. No use of BENGAL TENNIS ASSOCIATION. ‘s logo or other artwork will be allowed for linking absent a trademark license agreement. iFrames Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
