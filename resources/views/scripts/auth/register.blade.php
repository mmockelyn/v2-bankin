<script type="text/javascript">
    let elements = {
        type_account: document.querySelectorAll('[name="type_account"]'),
        individual: document.querySelector('#individual'),
        business: document.querySelector('#business'),
    }

    $("#datebirth").flatpickr({
        locale: 'fr'
    })

    let checkTypeAccount = (input) => {
        console.log(input.value)
        if(input.value === 'INDIVIDUAL') {
            elements.individual.classList.remove('d-none')
            elements.business.classList.add('d-none')
        } else {
            elements.individual.classList.add('d-none')
            elements.business.classList.remove('d-none')
        }
    }

</script>
