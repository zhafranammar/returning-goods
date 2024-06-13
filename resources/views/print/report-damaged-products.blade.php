<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Damaged Product Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 10px;
        }
        .header {
            margin-bottom: 20px;
            text-align: center; /* Center align everything */
        }
        .header h1 {
            font-size: 18px;
            margin: 0;
        }
        .header .subtitle {
            font-size: 14px;
            margin-top: 5px;
        }
        .details {
            font-size: 14px;
            margin-top: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            width: 30%;
        }
        .value {
            width: 70%;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 10px;
        }
        .logo {
            max-width: 200px; /* Atur lebar maksimal logo */
            height: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-container">
            <img src="https://yt3.googleusercontent.com/ytc/AIdro_kJnyLQmO6idb1CEsVS8qI2EuuUSNkxdWoW0SZpl10yR_c=s900-c-k-c0x00ffffff-no-rj" alt="Logo" class="logo" width="90">
        </div>
        <h1>Damaged Product Report</h1>
        <div class="subtitle">
            <p><strong>Sistem Pengembalian Barang</strong></p>
            <p><strong>Tes Web Developer DeePublish</strong></p>
        </div>
        <div class="details">
            <p><strong>Report Date:</strong> {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        </div>
    </div>

    <div class="section-title">Product Information</div>
    <table>
        <tr>
            <th>Product Attribute</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>Product Code</td>
            <td>{{ $damagedProduct->code }}</td>
        </tr>
        <tr>
            <td>Product Name</td>
            <td>{{ $damagedProduct->name }}</td>
        </tr>
        <tr>
            <td>Price</td>
            <td>{{ $damagedProduct->price }}</td>
        </tr>
        <tr>
            <td>Stock</td>
            <td>{{ $damagedProduct->stock }}</td>
        </tr>
    </table>

    <div class="section-title">Supplier Information</div>
    <table>
        <tr>
            <th>Supplier Attribute</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>Supplier Code</td>
            <td>{{ $supplier->code }}</td>
        </tr>
        <tr>
            <td>Supplier Name</td>
            <td>{{ $supplier->name }}</td>
        </tr>
        <tr>
            <td>Contact Person</td>
            <td>{{ $supplier->contact_person }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $supplier->email }}</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>{{ $supplier->address }}</td>
        </tr>
    </table>

    <div class="section-title">Damaged Product Report Details</div>
    <table>
        <tr>
            <th>Report Attribute</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>Report Date</td>
            <td>{{ $reportDamagedProduct->report_date }}</td>
        </tr>
        <tr>
            <td>Quantity</td>
            <td>{{ $reportDamagedProduct->quantity }}</td>
        </tr>
        <tr>
            <td>Damage Description</td>
            <td>{{ $reportDamagedProduct->damage_description }}</td>
        </tr>
        <tr>
            <td>Transaction Code</td>
            <td>{{ $reportDamagedProduct->transaction_code }}</td>
        </tr>
        <tr>
            <td>Status Report</td>
            <td>{{ $reportDamagedProduct->status_report }}</td>
        </tr>
    </table>
</body>
</html>
