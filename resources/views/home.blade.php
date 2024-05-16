<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Example App</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#fetch-rates-btn').click(function() {
                var baseCurrency = 'ZAR'
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
</head>
<body>
    <button id="fetch-rates-btn">Fetch Rates</button>
    <table id="rates-table">
        <thead>
            <tr></tr>
        </thead>
        <tbody></tbody>
    </table>
</body>
</html>
