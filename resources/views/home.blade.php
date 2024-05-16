<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Example App</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var baseCurrency = 'ZAR';
        var rates;

        $(document).ready(function() {

            $.ajax({
                url: '/get-rates',
                type: 'GET',
                async: false,
                data: { baseCurrency: baseCurrency },
                success: function(data) {
                    rates = data;

                    $.each(rates, function(currency) {
                        $('#currency').append(`<option value="${currency}">${currency}</option>`);
                    });
                },
                error: function() {
                    alert('Failed to fetch rates.');
                }
            });

            $('#convert-btn').click(function() {
                var amount = parseFloat($('#amount').val());
                var selectedCurrency = $('#currency').val();
                var resultContainer = $('#conversion-result');

                if (!isNaN(amount) && selectedCurrency && rates[selectedCurrency]) {
                    var convertedAmount = amount * rates[selectedCurrency];
                    resultContainer.text('Converted amount: ' + convertedAmount.toFixed(2));
                } else {
                    resultContainer.text('Please enter a valid amount and select a currency.');
                }
            });

            $('#fetch-rates-btn').click(function() {
                $.ajax({
                    url: '/get-rates',
                    type: 'GET',
                    data: { baseCurrency: baseCurrency },
                    success: function(data) {
                        $('#rates-table thead tr').empty();
                        $('#rates-table thead tr').append(`<th>Currency</th><th>Rate</th>`);
                        $('#rates-table tbody').empty();
                        $.each(data, function(currency, rate) {
                            $('#rates-table tbody').append(`<tr><td>${currency}</td><td>${rate}</td></tr>`);
                        });
                    },
                    error: function() {
                        alert('Failed to fetch rates.');
                    }
                });
            });
        });
    </script>
        <style>
            #convert-form {
                margin-top: 30px;
                margin-bottom: 40px;
            }
        </style>
</head>
<body>
    <div id="convert-form">
        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount">
        <br><br>
        <label for="currency">Select Currency:</label>
        <select id="currency" name="currency">
        </select>
        <br><br>
        <button id="convert-btn">Convert</button>
        <br><br>
        <div id="conversion-result"></div>
    </div>
    <button id="fetch-rates-btn">Fetch Rates</button>
    <table id="rates-table">
        <thead>
            <tr></tr>
        </thead>
        <tbody></tbody>
    </table>
</body>
</html>
