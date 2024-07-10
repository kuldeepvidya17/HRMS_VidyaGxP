<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #ffffff;
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .header {
            background-color: #0073e6;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .content {
            margin-top: 20px;
            line-height: 1.6;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Important Notice: Attendance Policy
        </div>
        <div class="content">
            <p>Dear {{ $name }},</p>

            <p>We have noticed that your recent attendance records shows late arrival to work. As stated in our company attendance policy, punctuality is essential for maintaining efficiency and effectiveness in our operations.</p>


            <ul>
                <li>Your Entry Time: {{ $punch_time }}</li>
            </ul>

            <p>Please be reminded that continual late entries are recorded and may impact performance reviews and potential raises or promotions. We understand that unexpected delays can occur and are willing to support you in finding solutions if there are specific challenges you're facing.</p>

            <p>We expect all employees to adhere to the set work schedules, and we appreciate your immediate attention to this matter. Please consult your manager or HR department if you have any concerns or require assistance regarding this issue.</p>
            
            <p>Thank you for your cooperation.</p>

            <p>Best Regards,</p>
            <p>Amit Patel <br> ~ Global President Operation.</p>
            <p>VidyaGxP Pvt. Ltd.</p>
        </div>
        <div class="footer">
            This is an automated message. Please do not reply directly to this email.
        </div>
    </div>
</body>
</html>
