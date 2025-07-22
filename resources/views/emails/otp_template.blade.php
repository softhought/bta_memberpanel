<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .email-header {
            background-color: #008d62;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .email-body {
            padding: 30px 20px;
        }

        .email-body h2 {
            margin-top: 0;
            color: #444;
        }

        .otp-box {
            font-size: 32px;
            font-weight: bold;
            background-color: #f1f1f1;
            padding: 15px;
            border-radius: 6px;
            text-align: center;
            letter-spacing: 6px;
            color: #008d62;
            margin: 20px 0;
        }

        .email-footer {
            font-size: 13px;
            color: #888;
            text-align: center;
            padding: 15px;
            background-color: #f9f9f9;
            border-top: 1px solid #eee;
        }

        .email-footer a {
            color: #008d62;
            text-decoration: none;
        }

        @media only screen and (max-width: 600px) {
            .email-body {
                padding: 20px 15px;
            }

            .otp-box {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>BTA Portal Verification</h1>
        </div>

        <div class="email-body">
            <h2>Hi {{ $name }},</h2>
            <p>We received a request to reset your password for registration number <strong>{{ $member_code }}</strong>.</p>
            <p>Please use the OTP below to verify your identity:</p>

            <div class="otp-box">{{ $otp }}</div>

            <p>This OTP is valid for 10 minutes. Do not share it with anyone.</p>
            <p>If you did not request this, please ignore this email or contact our support.</p>

            <p>Thank you,<br><strong>Bengal Tennis Association</strong></p>
        </div>

        <div class="email-footer">
            Yuba Bharati Krirangan, Sector 3, Salt Lake, Kolkata, West Bengal 700098<br>
            <a href="https://members.btaportal.in/" target="_blank">https://members.btaportal.in/</a>
        </div>
    </div>
</body>
</html>
