<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body{font-size:14px;margin:0;padding:0;box-sizing:border-box;}
        /*table {*/
        /*    width: 100%;*/
        /*    border-collapse: collapse;*/
        /*    margin: 20px 0;*/
        /*}*/
        th, td {
            padding: 10px;
            text-align: left;
            line-height: 1.4;
        }
        /*th {*/
        /*    background-color: #005baa;*/
        /*    color: #fff;*/
        /*}*/
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .bill-to, .invoice-info {
            margin: 20px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
        }
        .paid {
            text-align: center;
            font-size: 24px;
            color: red;
            font-weight: bold;
        }
        .note {
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>
<body style="margin: 0; padding: 0;">
    <div class="invoice">
        <table style="width: 100%; border-collapse: collapse;margin: 20px 0;">
            <tr>
                <td style="padding:0">
                    <img src="images/invoice-img/tp-invoice-name.webp" alt="towards-healthcare" width="300">
                </td>
                <td style="text-align:center">
                    <img src="images/invoice-img/towards-packaging-svg-logo.svg" alt="towards-healthcare" width="200">
                </td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse;margin: 20px 0;">
            <tr>
                <td colspan="2" style="font-size:14px;line-height: 1.6;">
                    <strong style="font-size:16px;text-transform:uppercase">Bill To:</strong><br>
                    <img src="images/invoice-img/tp-location-icon.webp" width="14px" style="padding-right:10px;vertical align:middle">Ferro Döküm San. ve Dış Tic. A.Ş<br>
                    Cumhuriyet Mah. 2253 Sok. No:13<br>
                    Gebze - Kocaeli<br>
                    Boğaziçi Kurumlar VD 619 051 7363<br>
                    <img src="images/invoice-img/tp-call-icon.webp" width="14px" style="vertical-align:middle;padding-right:7px"> 905368903720<br>
                    <img src="images/invoice-img/tp-mail-icon.webp" width="14px" style="vertical-align:middle;padding-right:7px"> busra.aygun@fesan.com.tr
                </td>
                <td colspan="2" style="line-height: 1.8;">
                    <strong style="font-size:16px;text-transform:uppercase">Invoice Info:</strong><br>
                    <span style="padding:7px 0"><strong style="font-weight:600">Invoice No:</strong> 000 000 0000</span><br>
                    <span style="padding:7px 0"><strong style="font-weight:600">Date:</strong> 00 00 0000</span><br>
                    <span style="padding:7px 0"><strong style="font-weight:600">Customer ID:</strong> 000 000 0000</span><br>
                    <span style="padding:7px 0"><strong style="font-weight:600">Prepayment:</strong> 000 000 0000</span>
                </td>
            </tr>
        </table>

        <table style="width: 100%; border-collapse: collapse;margin: 20px 0;">
            <thead>
                <tr style="background:#482f87;color:#fff;border:1px solid #fff">
                    <th style="background:#d1ab56;color:#000;border:1px solid #fff">No</th>
                    <th style="background:#d1ab56;color:#000;border:1px solid #fff">Report Name</th>
                    <th style="background:#d1ab56;color:#000;border:1px solid #fff">Qty</th>
                    <th style="background:#d1ab56;color:#000;border:1px solid #fff">License Type</th>
                    <th style="background:#d1ab56;color:#000;border:1px solid #fff">Report Price USD</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border:1px solid #dedcdc;background:#fffaf0">1</td>
                    <td style="border:1px solid #dedcdc;background:#fffaf0">Casting Market Research Report</td>
                    <td style="border:1px solid #dedcdc;background:#fffaf0">1</td>
                    <td style="border:1px solid #dedcdc;background:#fffaf0">Multi User License</td>
                    <td style="border:1px solid #dedcdc;background:#fffaf0">USD 3,250</td>
                </tr>
                <tr>
                    <td style="border:1px solid #dedcdc;background:#fffaf0">1</td>
                    <td style="border:1px solid #dedcdc;background:#fffaf0">Casting Market Research Report</td>
                    <td style="border:1px solid #dedcdc;background:#fffaf0">1</td>
                    <td style="border:1px solid #dedcdc;background:#fffaf0">Multi User License</td>
                    <td style="border:1px solid #dedcdc;background:#fffaf0">USD 3,250</td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%; border-collapse: collapse;margin: 20px 0;">
            <tr>
                <td rowspan="" style="line-height:1.8">
                    <strong style="text-transform:uppercase;font-weight:600;font-size:14px;">Contact Details:</strong><br>
                    <strong style="font-weight:600;">Payment related query:</strong>sales@towardspackaging.com<br>
                    Direct Lines:<strong style="font-weight:600;"> USA:</strong>+1 800 441 9344<br>
                    <strong style="font-weight:600;padding-left:79px">IND:</strong> +91 87933 22019<br>
                    <strong style="font-weight:600;padding-left:79px">APAC:</strong> +61 485 981 310<br>
                    <strong style="font-weight:600;padding-left:79px">Europe:</strong> +44 7383 092 044
                    <span style="margin:10px 0"></span>
                    <br>
                    <br>
                    <strong style="text-transform:uppercase;font-weight:600;font-size:14px;">Addresses:</strong><br>
                    <strong style="font-weight:600">Canada Office:</strong> Apt 1408 1785 Riverside Drive, Ottawa, ON, K1G 3T7,<br> Canada<br>
                    <strong style="font-weight:600">India Office:</strong> 707, Nandan Probiz, Baner, Pune (MH) – 411045,<br> India
                </td>
                <td style="vertical-align:middle;text-align:center">
                    <span style="font-size:18px;font-weight:600;">Thank You for Your Business</span><br>
                    <img src="images/invoice-img/paid-icon.webp" alt="paid-icon" width="150px" style="display:block;margin:0 auto">
                </td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse;margin: 20px 0;background:#044e47">
            <tr>
                <td rowspan="" style="color:#fff">
                    Note: The nature of income is in the nature of Business Profits and is taxable in India only.
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
