jQuery(function () {
    'use strict';
    function formatCurrency(amount) {
        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'EUR',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        });
        return formatter.format(amount);
    }

    var today = new Date();
    var maxDate = new Date(today.setFullYear(today.getFullYear() - 18)).toISOString().split('T')[0];
    var minDate = new Date(today.setFullYear(today.getFullYear() - 65 + 18)).toISOString().split('T')[0];
    $('#birthday').attr('max', maxDate);
    $('#birthday').attr('min', minDate);

    var slider = document.getElementById("annual-income-range");
    var sliderOutput = document.getElementById("annual-income-range-output");

    slider.oninput = function() {
        sliderOutput.innerHTML = this.value;
    }

    var data = {
        unmarried: {
            '18a29': {
                '10k': 2.00, '15k': 3.00, '20k': 4.00, '25k': 5.00, '30k': 6.00,
            },
            '30a39': {
                '10k': 4.44, '15k': 6.70, '20k': 8.90, '25k': 11.15, '30k': 13.40,
            },
            '40a49': {
                '10k': 10.70, '15k': 16.00, '20k': 21.35, '25k': 26.70, '30k': 32.00,
            },
            '50a59': {
                '10k': 27.05, '15k': 40.60, '20k': 54.10, '25k': 67.65, '30k': 81.15,
            },
            '60a65': {
                '10k': 44.30, '15k': 66.40, '20k': 88.50, '25k': 110.70, '30k': 132.80,
            },
        },
        married: {
            '18a29': {
                '10k': 1.00, '15k': 1.50, '20k': 2.00, '25k': 2.50, '30k': 3.00,
            },
            '30a39': {
                '10k': 2.25, '15k': 3.35, '20k': 4.45, '25k': 5.55, '30k': 6.70,
            },
            '40a49': {
                '10k': 5.35, '15k': 8.00, '20k': 10.70, '25k': 13.35, '30k': 16.00,
            },
            '50a59': {
                '10k': 13.55, '15k': 20.30, '20k': 27.05, '25k': 33.85, '30k': 41.00,
            },
            '60a65': {
                '10k': 22.15, '15k': 33.20, '20k': 44.30, '25k': 55.35, '30k': 66.40,
            },
        }
    }

    function calculateInsurance() {
        var married = $('input[name="married"]:checked').val();
        var age = 0;
        var dob = new Date($("#birthday").val());
        if(!isNaN(dob.getTime())) {
            var today = new Date();
            age = today.getFullYear() - dob.getFullYear();
            var m = today.getMonth() - dob.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                age--;
            }
        }

        var ageRange = '';
        if (age >= 18 && age <= 29) ageRange = '18a29';
        if (age >= 30 && age <= 39) ageRange = '30a39';
        if (age >= 40 && age <= 49) ageRange = '40a49';
        if (age >= 50 && age <= 59) ageRange = '50a59';
        if (age >= 60 && age <= 65) ageRange = '60a65';

        var amountRange = `${slider.value}k`;

        var result = data['unmarried'][ageRange][amountRange];
        if (married == 'married') {
            result += data['married'][ageRange][amountRange];
        }

        var outputtext = '';
        if (married == 'married') {
            outputtext = `
                <table class="table table-bordered">
                    <tr><th>Tipo de Cobertura</th><th>Montante</th></tr>
                    <tr><td>Cobertura Titular</td><td>${formatCurrency(slider.value * 1000)}</td></tr>
                    <tr><td>Cobertura Conyugue</td><td>${formatCurrency(slider.value * 1000 / 2)}</td></tr>
                    <tr><td>Prima Mensual</td><td>${formatCurrency(result)}</td></tr>
                </table>
            `;
        } else {
            outputtext = `
                <table class="table table-bordered">
                    <tr><th>Tipo de Cobertura</th><th>Montante</th></tr>
                    <tr><td>Cobertura Titular</td><td>${formatCurrency(slider.value * 1000)}</td></tr>
                    <tr><td>Prima Mensual</td><td>${formatCurrency(result)}</td></tr>
                </table>
            `;
        }
        $('#result').html(outputtext);
    }

    $('#insuranceform').on('submit', function(e) {
        e.preventDefault();
        calculateInsurance();
    });
});