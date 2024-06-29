import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    window.handleSubmit = function(event) {
        event.preventDefault();

        const age = document.getElementById('age').value;
        const currency = document.getElementById('currency').value;
        const start_date = document.getElementById('start_date').value;
        const end_date = document.getElementById('end_date').value;

        const token = process.env.API_JWT_TOKEN;

        resetErrors();
        hideResult();

        document.getElementById('button').innerHTML = 'Loading...';

        axios.post('/api/quotation', {
            age: age,
            currency_id: currency,
            start_date: start_date,
            end_date: end_date
        }, {
            headers: {
                'Authorization': 'Bearer '+ token
            }
        })
        .then(function(response) {
            resetButtonText();
            fillResult(response.data);
        })
        .catch(function(error) {
            resetButtonText();
            const responseData = error.response.data;
            if (!responseData.success) {
                if (responseData.errors.age) {
                    document.getElementById('error_age').innerHTML = responseData.errors.age[0];
                }
                if (responseData.errors.currency_id) {
                    document.getElementById('error_currency').innerHTML = responseData.errors.currency_id[0];
                }
                if (responseData.errors.start_date) {
                    document.getElementById('error_start_date').innerHTML = responseData.errors.start_date[0];
                }
                if (responseData.errors.end_date) {
                    document.getElementById('error_end_date').innerHTML = responseData.errors.end_date[0];
                }
            }
        });

        return false;
    };

    function resetErrors() {
        document.getElementById('error_age').innerHTML = '';
        document.getElementById('error_currency').innerHTML = '';
        document.getElementById('error_start_date').innerHTML = '';
        document.getElementById('error_end_date').innerHTML = '';
    }

    function resetButtonText() {
        document.getElementById('button').innerHTML = 'Calculate';
    }

    function fillResult(data) {
        document.getElementById('quotation_result').classList.add('show');
        document.getElementById('quotation_reference').innerHTML = 'Quotation reference #' + data.quotation_id;
        document.getElementById('quotation_value').innerHTML = 'Total Value: ' + data.total + ' ' + data.currency_id;
    }

    function hideResult() {
        document.getElementById('quotation_result').classList.remove('show');
        document.getElementById('quotation_reference').innerHTML = '';
        document.getElementById('quotation_value').innerHTML = '';
    }
});
