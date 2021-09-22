<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $billing_detail->billing_name }} | Invoice</title>
    {{-- <link rel="stylesheet" href="{{ asset('invoice/style.css') }}" media="all" /> --}}
    <style>
        /* @page {
            size: a4 landscape !important;

        } */


        @font-face {
            font-family: SourceSansPro;
            src: url(SourceSansPro-Regular.ttf);
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #0087C3;
            text-decoration: none;
        }

        body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-family: SourceSansPro;
        }

        header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
        }

        #logo {
            float: left;
            margin-top: 8px;
        }

        #logo img {
            height: 70px;
        }

        #company {
            float: right;
            text-align: right;
        }


        #details {
            margin-bottom: 50px;
        }

        #client {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
            float: left;
        }

        #client .to {
            color: #777777;
        }

        h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            float: right;
            text-align: right;
        }

        #invoice h1 {
            color: #0087C3;
            font-size: 2.4em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
        }

        #invoice .date {
            font-size: 1.1em;
            color: #777777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 20px;
            background: #EEEEEE;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
        }

        table th {
            white-space: nowrap;
            font-weight: normal;
        }

        table td {
            text-align: right;
        }

        table td h3 {
            color: #57B223;
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0.2em 0;
        }

        table .no {
            color: #FFFFFF;
            font-size: 1.6em;
            background: #57B223;
        }

        table .desc {
            text-align: left;
        }

        table .unit {
            background: #DDDDDD;
        }

        table .qty {}

        table .total {
            background: #57B223;
            color: #FFFFFF;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table tbody tr:last-child td {
            border: none;
        }

        table tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
        }

        table tfoot tr:first-child td {
            border-top: none;
        }

        table tfoot tr:last-child td {
            color: #57B223;
            font-size: 1.4em;
            border-top: 1px solid #57B223;

        }

        table tfoot tr td:first-child {
            border: none;
        }

        #thanks {
            font-size: 2em;
            margin-bottom: 50px;
        }

        #notices {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
        }

        #notices .notice {
            font-size: 1.2em;
        }

        footer {
            color: #777777;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <main>
        <header class="clearfix">
            <div id="company">
                <h2 class="name">Wellcome to {{ config('app.name') }}</h2>
                <div></div>
                <div>(602) 519-0450</div>
                <div><a href="mailto:company@example.com">company@example.com</a></div>
            </div>
            </div>
        </header>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">INVOICE TO:</div>
                <h2 class="name">{{ $billing_detail->billing_name }}</h2>
                <div class="address">{{ $billing_detail->billing_address }}</div>
                <div class="email"><a
                        href="mailto:{{ $billing_detail->billing_email }}">{{ $billing_detail->billing_email }}</a>
                </div>
            </div>
            <div id="invoice">
                <h1>INVOICE {{ $billing_detail->id.'-'.$billing_detail->created_at->format('d-m-y') }}</h1>
                <div class="date">Date of Invoice: {{ $billing_detail->created_at->format('d/m/Y') }}</div>
                <div class="date">Due Date: {{ $billing_detail->created_at->addDays(7)->format('d/m/Y') }}</div>
            </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="no">#</th>
                    <th class="desc">DESCRIPTION</th>
                    <th class="unit">UNIT PRICE</th>
                    <th class="qty">QUANTITY</th>
                    <th class="total">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($billing_detail->getOrderAmount->getOrderedProduct as $order_product)
                <tr>
                    <td class="no">{{ $loop->index+1 }}</td>
                    <td class="desc">
                        <h3>{{ $order_product->getProduct->title }}</h3>{{ $order_product->getProduct->summery }}
                    </td>
                    @php
                    $total =
                    (getproductPrice($order_product->product_id,$order_product->color_id,$order_product->size_id)->sale_price
                    * $order_product->quantity);
                    @endphp
                    <td class="unit">

                        {{ getproductPrice($order_product->product_id,$order_product->color_id,$order_product->size_id)->sale_price }}
                    </td>
                    <td class="qty">{{ $order_product->quantity }}</td>
                    <td class="total">{{ $total }}</td>
                </tr>

                @empty
                <tr>
                    <td colspan="50" class="text-center"> Not Avaialble</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">Subtotal</td>
                    <td> {{ $billing_detail->getOrderAmount->subtotal }} Tk.</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">Coupon {{ $billing_detail->getOrderAmount->discount }}%</td>
                    <td>
                        {{ discountTotal($billing_detail->getOrderAmount->subtotal,$billing_detail->getOrderAmount->discount) }}
                        Tk.
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">Shipping </td>
                    <td> {{ $billing_detail->getOrderAmount->shipping }} Tk.</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">GRAND TOTAL</td>
                    <td>{{ $billing_detail->getOrderAmount->total }} Tk.</td>
                </tr>
            </tfoot>
        </table>
        <div id="thanks">Thank you!</div>
        <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        </div>
        <div class="mt-3">
            <hr>
        </div>
        <div class="text-center">
            This Invoice was created on a computer by {{ config('app.name') }} and is valid without the signature and
            seal.
        </div>
    </main>
</body>

</html>
