<script type="text/javascript">
    let label_amount = document.querySelector("#label_amount")
    let slider_amount = document.querySelector("#slider_amount")
    let input_amount = document.querySelector("[name='amount']")
    let recapBlock = document.querySelector("#recap")

    let blockUI = new KTBlockUI(recapBlock);

    let slide_amount = noUiSlider.create(slider_amount, {
        start: [500],
        connect: true,
        range: {
            "min": 500,
            "max": 5000
        },
        step: 100
    })

    let updateMensuality = () => {
        let inputMensuality = document.querySelector('#mensuality')
        let inputInsurance = document.querySelector('input[name=insurance]:checked')


        blockUI.block()

        $.ajax({
            url: '/api/account/simulate',
            method: 'POST',
            data: {"type": "sim_duration", "amount": input_amount.value, "duration": inputMensuality.value, "action": "facelia", "insurance": inputInsurance.value},
            success: data => {
                console.log(data)
                document.querySelector('.label_amount').innerHTML = new Intl.NumberFormat('fr-FR', {style: 'currency', currency: 'EUR'}).format(data.amount)
                document.querySelector('.label_interest').innerHTML = new Intl.NumberFormat('fr-FR', {style: 'currency', currency: 'EUR'}).format(data.interest)
                document.querySelector('.label_du').innerHTML = new Intl.NumberFormat('fr-FR', {style: 'currency', currency: 'EUR'}).format(data.du)
                document.querySelector('.label_mensuality').innerHTML = data.mensuality
                document.querySelector('.label_taux').innerHTML = data.taux
                document.querySelector('.label_amount_mensuality').innerHTML = new Intl.NumberFormat('fr-FR', {style: 'currency', currency: 'EUR'}).format(data.amount_mensuality)
                document.querySelector('.label_duration').innerHTML = data.mensuality+' Mois'
                blockUI.release()
            }
        })
    }

    slide_amount.on("update", function (values, handle) {
        label_amount.innerHTML = Math.round(values[handle]);
        $("[name='amount']").val(Math.round(values[handle]))
        updateMensuality()
        if (handle) {
            label_amount.innerHTML = Math.round(values[handle]);
            $("[name='amount']").val(Math.round(values[handle]))
            updateMensuality()
        }
    });

    $("#faceliaForm").on('submit', e => {
        e.preventDefault()
        let form = $("#faceliaForm")
        let url = form.attr('action')
        let btn = form.find('.btn-bank')
        let data = form.serializeArray()

        btn.attr('data-kt-indicator', 'on')

        $.ajax({
            url: url,
            method: 'POST',
            data: data,
            success: data => {
                console.log(data)
            }
        })
    })


</script>
