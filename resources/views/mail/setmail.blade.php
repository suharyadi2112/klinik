<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Pemberitahuan</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .header {
            text-align: center;
            padding: 40px 0;
            background-color: #3498db;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 28px;
        }
        .table-container {
            width: 100%;
            max-width: 600px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: auto;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
            font-size: 16px;
        }
        th {
            background-color: #3498db;
            color: #ffffff;
        }
        td {
            background-color: #f7f7f7;
        }
        .orange-cell {
            background-color: #ff9800;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin: auto;">
        <tr>
            <td class="header">
                <h1>Email Pemberitahuan</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <p style="font-size: 16px; line-height: 1.6; color: #333;">
                    Terima kasih telah mendaftar. Kami ingin memberitahukan bahwa request Anda telah diteruskan ke klinik partner kami.
                </p>
            </td>
        </tr>
    </table>

    <!-- Table for Information -->
    <div class="table-container">
        <table>
            <tr>
                <th>CODE REGISTRATION</th>
                <td>{{ $data->penid }}-{{ $data->pentgl }}</td>
            </tr>
            <tr>
                <th>REGISTRATION DATE</th>
                <td>{{ $data->pentgl }}</td>
            </tr>
            <tr>
                <th>PATIENT NAME</th>
                <td>{{ $data->pasnama }}</td>
            </tr>
            <tr>
                <th>PARTNER</th>
                <td>{{ $data->pennama }}</td>
            </tr>
            <tr>
                <th>ADDRESS PATIENT</th>
                <td>{{ $data->pasalamat }}</td>
            </tr>
            <tr>
                <th class="orange-cell">STATUS</th>
                <td class="orange-cell">{{ $data->status_request }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
