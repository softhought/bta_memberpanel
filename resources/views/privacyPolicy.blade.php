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
        <h2 class="text-center">Privacy Policy</h2>
        <p><strong>BENGAL TENNIS ASSOCIATION</strong><br>
            Welcome to our website. If you continue to browse and use this website, you are agreeing to comply with and be bound by the following terms and conditions of use, which together with our privacy policy and our cookie policy govern BTA’s relationship with you in relation to this website. If you disagree with any part of these terms and conditions, please do not use our website. The term 'BTA' or 'us' or 'we' refers to the owner of the website whose contact details can be found on our contact page. The term 'you' refers to the user or viewer of our website. The use of this website is subject to the following terms of use: The content of the pages of this website is for your general information and use only. It is subject to change without notice. This website uses cookies and may not function correctly without them. By using our website, and by agreeing to these terms and conditions, you are consenting to our use of cookies in accordance with our cookie policy. Please refer to our cookie policy for further information. Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose.
        </p>

        <div class="location-text">
                You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law. Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services or information available through this website meet your specific requirements. This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions. All trademarks reproduced in this website, which are not the property of, or licensed to the operator, are acknowledged on the website. Unauthorised use of this website may give rise to a claim for damages and/or be a criminal offence. From time to time, this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s).
            </p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
