<!DOCTYPE html>
<html>

<head>
    <title>Inventory Billing System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <center>
        <h1>{{ $title }}</h1>
    </center>
    <table style="width: 100%">
        <tr>
            <td style="width: 70%">
                <p><b>Customer Name :</b> {{ $invoice->name }}</p>
            </td>
            <td style="width: 30%">
                <p><b>Invoice no :</b> {{ $invoice->invoice_no }}<br><br><b>Date :</b> {{ $date }}</p>
            </td>
        </tr>
    </table>

    <table border="1" style="width: 100%; text-align: center">
        <tr>
            <th>#</th>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
        </tr>
        @php
            $i = 1;
        @endphp
        @foreach ($items as $data)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $data->product_name }}</td>
                <td>{{ $data->product_price }}</td>
                <td>{{ $data->product_qty }}</td>
                <td>{{ $data->gross_amount }}</td>
            </tr>
        @endforeach
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td style="width: 70%"></td>
            <td style="width: 30%">
                <table border="1" style="width: 100%; text-align: center">
                    <tr>
                        <td style="width: 50%"><b>Net Amount :</b> </td>
                        <td style="width: 50%">{{ $invoice->sub_total }}</td>
                    </tr>
                    <tr>
                        <td style="width: 50%"><b>Discount :</b> </td>
                        <td style="width: 50%">{{ $invoice->sub_discount }}</td>
                    </tr>
                    <tr>
                        <td style="width: 50%"><b>Total :</b> </td>
                        <td style="width: 50%">{{ $invoice->grand_total }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>
