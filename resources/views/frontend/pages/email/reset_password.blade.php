<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
        }

        table,
        td {
            border-collapse: collapse;
        }

        td {
            padding: 20px;
            text-align: left;
        }

        h1 {
            color: #ffff;
        }

        a {
            background-color: ##12B58A;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }

        @media (max-width: 600px) {
            table {
                width: 100% !important;
            }

            td {
                display: block;
                width: 100%;
                box-sizing: border-box;
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <table cellpadding="0" cellspacing="0" bgcolor="#f4f4f4">
        <tr>
            <td>
                <table align="center" width="600" cellpadding="0" cellspacing="0"
                    style="border-collapse: collapse; background-color: #ffffff;">
                    <!-- Header -->
                    <tr>
                        <td
                            style="padding: 20px 20px 10px; text-align: center; background-color: #12B58A; color: #fff;">
                            <h1>Password Reset</h1>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 20px;">
                            <p>Hello,</p>
                            <p>We received a request to reset your password. To reset your password, click the button
                                below:</p>
                            <p style="text-align: center; padding-top: 10px; padding-bottom: 10px; color: #fff;  background-color: #12B58A;">
                                <a href="{{ route('resetPasswordPage', $token) }}">Reset Password</a>
                            </p>
                            <p>If you did not request a password reset, please ignore this email.</p>
                            <p>Thank you!</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px; text-align: center; background-color: #f4f4f4;">
                            &copy; 2023 Book my trip. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
