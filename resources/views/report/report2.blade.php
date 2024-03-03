<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: ubuntu, sans-serif;
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
            color: #95a5a6;
        }
        .normal-text-footer {
            font-size: 10px; /* Adjusted font size */
            color: #95a5a6;
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


        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 10px 20px;
        }
    </style>

</head>
<body>

<table style="margin-bottom: 30px">
    <tr>
        <td style="float: right; text-align: left; width: 80%">
            <h3 style="float: right; text-align: right; color: #747e7f; padding-right: 20px">{{$info->full_name_fr ?? '-'}}</h3>
        </td>
        <td style="text-align: center; width: 20%">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAABS0lEQVR4nO2ZXU/CMBSGz///XwJKRxxfKgkYvRFZ2Fq8o9KXtIZoCNONNFl77JPscs375N265ozABAITCEwgMIHABAITCEwgMIHAXUSWJR4mObJBD6J/0+mVDXoui6zKdiJWYjwSULKCMQZdY4xxWWymOpmLIvNxDiUlQkPJyjXTWMRWGUIT59hM2W0fjUXscxkqoiZbEvm3jXxqjY+dQvG+xuvzCov5FLkYhiui9R47pbBZv7nAP9e8dAUn8jib4H54Vxs0GhHxR9AkckZqJDRE19uvL0R62RuSdq3QHq2n2ZTHB/GE3tsjinRHlJfVMl6R389g34KnBqMT8YVIIjE3koU6fDgc2g0fvsZBFaIfB0kuAzqLvSH6kem1tA3oE/K5WBLxAMEj0TeyLTZXv8jbovARAfz/WMUGgQkEJhCYQGACgQnUdQBfHAHGUyadCaRjxQAAAABJRU5ErkJggg==" alt="Company Logo" style="width: 45px; height: 45px;">
            <h6 style="font-size: 12px; color: #95a5a6">{{$info->header_fr}}</h6>
        </td>
    </tr>
</table>
<table style="margin-bottom: 30px">
    <tr>
        <td style="text-align: left;">

            <p class="normal-text"><b>Nom et prénom: </b> {{$info->full_name_fr ?? '-'}}</p>
            <p class="normal-text"><b>Compte bancaire du CPA: </b> {{$info->account_number ?? '-'}}</p>
            <p class="normal-text"><b>Registre du commerce: </b> {{$info->register_number}}</p>
            <p class="normal-text"><b>Identifiant fiscale: </b> {{$info->id_number}}</p>
            <p class="normal-text"><b>Identifiant statistiques: </b> {{$info->statistics_number}}</p>

        </td>
        <td style="float: right; text-align: right;">

            <p class="normal-text"><b>Bénéficiaire: </b> {{$client->full_name_fr ?? '-'}}</p>
            <p class="normal-text"><b>Téléphone: </b> {{$client->phone ?? '-'}}</p>
            <p class="normal-text"><b>Email: </b> {{$client->email ?? '-'}}</p>
            <p class="normal-text"><b>Adress: </b> {{$client->address_fr ?? '-'}}</p>

            @php
                $currentDateTime = now(); // Get current date and time
                $date = $currentDateTime->toDateString(); // Extract date
                $time = $currentDateTime->toTimeString(); // Extract time
                $previousDate = date('Y-m-d', strtotime('-1 day'));
                $formattedDate = date('d-m-Y', strtotime($previousDate))
            @endphp
            <p class="normal-text"><b>Kerzaz à: </b>{{ $formattedDate }}</p>
        </td>
    </tr>
</table>



<table style="margin-bottom: 30px; text-align: center;">
    <tr style="text-align: center;">
        <td style="text-align: center;">
            <h1 style="text-align: center; color: #747e7f; padding-right: 20px">{{$info->key ?? "-"}}</h1>
            <p class="normal-text"><b>N°: </b> {{$number}}</p>
        </td>
    </tr>
</table>

<table class="invoice-table" style="margin-bottom: 30px">
    <thead>
    <tr>
        <th>Produit</th>
        @if($with_price == "oui")
        <th>Prix (DA)</th>
        @endif
        <th>Unité</th>
        <th>Quantité</th>
        @if($with_price == "oui")
        <th>Total (DA)</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @for($i=0; $i<count($items); $i++)
        <tr>
            <td>{{$items[$i]["name"]}}</td>
            @if($with_price == "oui")
            <td>{{$items[$i]["price"]}}</td>
            @endif
            <td>{{$items[$i]["unit"]}}</td>
            <td>{{$items[$i]["qte"]}}</td>
            @if($with_price == "oui")
            <td>{{$items[$i]["price"] * $items[$i]["qte"]}}</td>
            @endif
        </tr>
    @endfor
    @if($with_price == "oui")
    <tr>
        <td style="background-color: white; border-bottom-color: #FFFFFF; border-left-color: #FFFFFF; border-right-color: #FFFFFF"></td>
        <td style="background-color: white; border-bottom-color: #FFFFFF; border-left-color: #FFFFFF; border-right-color: #FFFFFF"></td>
        <td style="background-color: white; border-bottom-color: #FFFFFF; border-left-color: #FFFFFF"></td>
        <td><b>Total</b></td>
        <td>{{$total}}</td>
    </tr>
    @endif
    </tbody>
</table>

@if($with_price == "oui")
<table style="margin-bottom: 30px; text-align: center;">
    <tr style="text-align: center;">
        <td style="text-align: center;">
            <p class="normal-text"><b>Prix nominale: </b> {{$totalText}}</p>
        </td>
    </tr>
</table>
@endif

<br>
<br>
<table>
    <tr>
        <td style="width: 80%;"></td>
        <td style="margin-left: 30px">
            <img src="{{'data:image/png;base64,' . DNS2D::getBarcodePNG($number, 'QRCODE')}}" alt="QR Code" style="width: 55px; height: 55px; margin-bottom: 5px">
            <p class="normal-text" style="color: white"><b>Signature</b></p>
            <p class="normal-text" style="margin-top: 15px"><b>Signature</b></p>
        </td>

    </tr>
</table>




<footer>
    <table>
        <tr>
            <td style="text-align: center;">
                <p class="normal-text-footer"><b>Téléphone: </b> {{$info->phone ?? '-'}}</p>
            </td>
            <td style="text-align: center;">
                <p class="normal-text-footer"><b>Email: </b> {{$info->email ?? '-'}}</p>
            </td>
            <td style="text-align: center;">
                <p class="normal-text-footer"><b>Adress: </b> {{$info->address_fr ?? '-'}}</p>
            </td>
        </tr>
    </table>
</footer>

</body>
</html>
