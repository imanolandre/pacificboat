<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .invoice-box {
            width: 100%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            color: #000;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        .invoice-box table td {

            vertical-align: top;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding: 20px;
            background: #DCE6F1;
        }
        .invoice-box table tr.heading td {
            background: #244062;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            color: white;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        .invoice-box table tr .logo {
            width: 100px;
            height: auto;
        }
        .invoice-box .notes {
            padding: 50px;
            text-align: center;
        }
        .center {
            text-align: center;
        }
        .right {
            text-align: right;
        }
        .left {
            text-align: left;
        }
        .descrip {
            text-align: left;
        }
        .blue {
            color: #0000FF;
        }
        .tables{
            border: 2px solid #000;
        }
        .margen{
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table class="tables margen">
            <tr class="top information">
                <td colspan="5">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="assets/tablar-logo.png" alt="Company logo" class="logo">
                            </td>
                            <td class="descrip" colspan="3">
                                <b>PACIFIC BOAT AND SERVICES</b><br>
                                3828 Udall st.<br>
                                San Diego, CA. 92107<br>
                                (619) 517 9074<br>
                                a1ex012@hotmail.com
                            </td>
                            <td class="right">
                                <h2 class="blue">INVOICE</h2>
                                <b>Inv. No.: {{ $invoice->id }}</b><br>
                                <b>Date:</b> {{ \Carbon\Carbon::parse($invoice->date)->format('M-d') }}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="5">
                    <table>
                        <tr>

                            <td>
                                <b>Bill to:</b> {{ $invoice->week->customer_name }}<br>
                                {{ $invoice->location }}<br>
                                {{ $invoice->email }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading tables">
                <td colspan="2" class="center">SALES PERSON</td>
                <td class="center">JOB</td>
                <td class="center">TERMS</td>
                <td class="center">DUE DATE</td>
            </tr>
            <tr class="details">
                <td colspan="2"> {{ $invoice->week->customer_name }}</td>
                <td class="center">{{ $invoice->yacht_name }}</td>
                <td class="center">Due on Recipt</td>
                <td class="center">{{ \Carbon\Carbon::parse($invoice->due_date)->format('m/d/Y') }}</td>
            </tr>
        </table>
        <table class="tables">
            <tr class="heading">
                <td class="center">QTY</td>
                <td colspan="2" class="center des">DESCRIPTION</td>
                <td class="center">DATE</td>
                <td class="center">TOTAL</td>
            </tr>
            @foreach($invoice->details as $detail)
            <tr class="left">
                <td class="center">{{ $detail->qty }}</td>
                <td colspan="2" class="center des">{{ $detail->description }}</td>
                <td class="center">{{ \Carbon\Carbon::parse($detail->date)->format('m/d/Y') }}</td>
                <td class="center">${{ number_format($detail->total, 2) }}</td>
            </tr>
            @endforeach
            @php
                $subtotal = $invoice->details->sum('total');
            @endphp
            <tr class="total">
                <td></td>
                <td></td>
                <td></td>
                <td class="center"><b>SUBTOTAL</b></td>
                <td class="center">${{ number_format($subtotal, 2) }}</td>
            </tr>
            <tr class="total">
                <td><b>NOTES:</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="total">
                <td></td>
                <td></td>
                <td></td>
                <td class="center"><b>TOTAL DUE</b></td>
                <td class="center">${{ number_format($subtotal, 2) }}</td>
            </tr>
            <tr class="notes">
                <td colspan="5">Make all Checks Payable to <span class="blue">{{ $invoice->week->customer_name }}</span></td>
            </tr>
        </table>
    </div>
</body>
</html>
