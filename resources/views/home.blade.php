<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
            rel="stylesheet">

        @vite(['resources/css/reset.css', 'resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body>
        <h1>Health Insurance Quotation</h1>
        <form onsubmit="return handleSubmit(event)">
            <ul>
                <li>
                    <label for="age">* Age (Separated by comma):</label>
                    <input type="text" name="age" id="age" required />
                    <span class="error" id="error_age"></span>
                </li>
                <li>
                    <label for="age">* Currency:</label>
                    <select name="currency" id="currency" required>
                        <option selected disabled value="">Select one option</option>
                        @foreach ($currencies as $currency)
                            <option value="{{$currency->iso_code}}">{{$currency->iso_code}}</option>
                        @endforeach
                    </select>
                    <span class="error" id="error_currency"></span>
                </li>
                <li>
                    <label for="age">* Trip Start Date:</label>
                    <input type="date" name="start_date" id="start_date" required />
                    <span class="error" id="error_start_date"></span>
                </li>
                <li>
                    <label for="age">* Trip End Date:</label>
                    <input type="date" name="end_date" id="end_date" required />
                    <span class="error" id="error_end_date"></span>
                </li>
                <li class="button">
                    <button type="submit" id="button">Calculate</button>
                </li>
            </ul>
        </form>
        <div class="result" id="quotation_result">
            <h3 id="quotation_reference"></h3>
            <span class="value" id="quotation_value"></span>
        </div>
    </body>
</html>
