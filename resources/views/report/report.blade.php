<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: montserrat, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px transparent;
        }

        h1 {
            font-size: 24px; /* Adjusted font size */
            margin-bottom: 10px;
        }
        .normal-text {
            font-size: 12px; /* Adjusted font size */
            color: #95a5a6
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 10px;
        }

        .invoice-table, .invoice-table th, .invoice-table td {
            border: 1px solid #eeeeee;
        }

        .invoice-table th, .invoice-table td {
            padding: 10px;
            text-align: left;
        }

        .invoice-table th {
            background-color: #e0e0e0; /* Header background color */
        }

        .invoice-table tbody tr:nth-child(odd) {
            background-color: #f9f9f9; /* Odd row background color */
        }
    </style>
</head>
<body>

<table style="margin-bottom: 30px">
    <tr>
        <td style="text-align: center; width: 11%">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAtCAAAAADws9Z4AAAABGdBTUEAALGOfPtRkwAAAAlwSFlzAAAOxAAADsQBlSsOGwAAABl0RVh0U29mdHdhcmUATWljcm9zb2Z0IE9mZmljZX/tNXEAAAJWSURBVEjHvdX9TxJhAAdw/2F7M+Ceez/uOVApIk2izAOaIKu2FAgJtctIxEVLKE0sK1QGjEYwEJDDe7pmW9QCnn7p2W673X1ue+6e732fEfQPY6T/LU0/jquYuFnSUC6OievrbaQ+2MbDKPZGn4f9JR4+ch0iVJTv53EwiklLz9YV3700Dkapubueaw7/rYqGgX98v29ewuqtYmF9tJwGRwsXoyiAKVx86mK46SImfgoEKejOYuEDaBaghWaeNIbjTxOkKEGOp4zpYbgRl2gIJYFhJEthIG4eRW8ARhQ5w5TyuljQBuY5NQMpimREx0J50HK3u11NRV21md99u/0q2emXjVp62e+VZdnjCQRCoWgsPH97o0/qvoZsFMUSgGQpUiBo2jQ2OrmnlT7k/4IzNoLnJckqWHiRZxlAsFNKc19mLpOPan/iTUALkOeAkaJozjI+cye8W1cXjabZ+VnSVvodv2c5K0uzk/7IajK1l6u09BerOkelrQ7qFnw3K7245iA4YA3nm70hWhCDhfNT5Xkv1pNIBur1L1tKZDn389pZ7dej1R5cHmeB0nlhJ3niQqA8pJEWjSDS8ZkYyLGJYfWV40wudclolngi0b/r1PMguAF9/JEUoAhiA4ox+07/z7sr4Opa+zpnhrR8NgCfuOfSO37jlccoCER93T4PrNyKlzBdsqygDMdDsyE+rJ+zG6kKypl5gTWFNZwy35kgScKSxGh+dXV6zACda2WcbSJ00f4wc9jG2lP2GaWJuwGpvk2EcHEugbCxdtDAx6e4Fquf/wP+DohYH31YE3hWAAAAAElFTkSuQmCC" alt="Company Logo" style="width: 45px; height: 45px;">
            <h6 style="font-size: 12px; color: #95a5a6">Sud Express Parcels</h6>
        </td>
        <td style="float: right; text-align: right; width: 80%">
            <h1 style="float: right; text-align: right; color: #747e7f; padding-right: 20px">User Repport</h1>
        </td>
    </tr>
</table>
<table style="margin-bottom: 30px">
    <tr>
        <td style="text-align: left;">
            <p class="normal-text"><b>Office: </b> {{$parcels[0]->depart->name ?? '-'}}</p>
            <p class="normal-text"><b>Phone Number: </b> {{$parcels[0]->depart->phone ?? '-'}}</p>
            <p class="normal-text"><b>Email: </b> {{$parcels[0]->depart->email ?? '-'}}</p>
            <p class="normal-text"><b>Address: </b> {{$parcels[0]->depart->address ?? '-'}}</p>
        </td>
        <td style="float: right; text-align: right;">
            <p class="normal-text"><b>User: </b> {{$parcels[0]->user->name ?? '-'}}</p>
            <p class="normal-text"><b>Period: </b> {{$start_date . ' to ' . $end_date}}</p>
            <p class="normal-text"><b>Total: </b> {{$total}} DA</p>
        </td>
    </tr>
</table>

<table class="invoice-table" style="margin-bottom: 30px">
    <thead>
    <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Destination</th>
        <th>Price (DA)</th>
    </tr>
    </thead>
    <tbody>
    @for($i=0; $i<count($parcels); $i++)
        <tr>
            <td>{{$parcels[$i]->tracking_number}}</td>
            <td>{{$parcels[$i]->type->name}}</td>
            <td>{{$parcels[$i]->arrive->name}}</td>
            <td>{{$parcels[$i]->type->price}}</td>
        </tr>
    @endfor
    </tbody>
</table>

<table style="margin-bottom: 30px">
    <tr>
        <td>
            @foreach($typesTotals as $name => $total)
                <p class="normal-text"><b>{{$name}}: </b> {{$total}}</p>
            @endforeach
        </td>
        <td>
            @foreach($officesTotals as $name => $total)
            <p class="normal-text"><b>{{$name}}: </b> {{$total}}</p>
            @endforeach
        </td>
    </tr>
</table>

<table>
    <tr>
        <td style="width: 79%;">

        </td>
        <td>
            <p class="normal-text"><b>Responsible signature</b></p>
        </td>
    </tr>
</table>

</body>
</html>


