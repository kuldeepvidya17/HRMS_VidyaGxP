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
            Daily Attendance Report
        </div>
        <div class="content">
            <table>
                <thead>
                    <th>CODE</th>
                    <th>NAME</th>
                    <th>STATUS</th>
                    <th>IN</th>
                    <th>OUT</th>
                </thead>
                <tbody>
                    @foreach (collect($reports)->sortBy('emp_code') as $report)
                        <tr>
                            <td>{{ $report['emp_code'] }}</td>
                            <td>{{ $report['name'] }}</td>
                            <td> <p style="color: {{ $report['status'] == 'Present' ? 'green' : 'red' }}">{{ $report['status'] }}</p></td>
                            <td>{{ format_date($report['punch_in_time'], 'd F Y g:i A') }}</td>
                            <td>{{ format_date($report['punch_out_time'], 'd F Y g:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

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
