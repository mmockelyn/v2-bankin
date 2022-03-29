<script type="text/javascript">
    let elements = {
        btnShowCard: document.querySelectorAll('.showCard'),
        modalShowCard: document.querySelector('#showCard'),
        modalOpposite: document.querySelector('#modalOpposition'),
        modalLimitDraw: document.querySelector('#modalLimitDraw'),
        modalShowCode: document.querySelector('#modalShowCode')
    }

    let modalShowCard = new bootstrap.Modal(elements.modalShowCard)
    let modalOpposite = new bootstrap.Modal(elements.modalOpposite)
    let modalLimitDraw = new bootstrap.Modal(elements.modalLimitDraw)
    let modalShowCode = new bootstrap.Modal(elements.modalShowCode)

    let lockedCard = (card) => {
        $.ajax({
            url: '/api/account/card/'+card.value+'/lock',
            method: 'POST',
            success: data => {
                console.log(data);
            }
        })
    }

    let activeExternalPayment = (number) => {
        $.get('/api/account/card/'+number+'/externalPayment')
        .then(data => {
            console.log(data)
        })
    }

    let activeAbroadPayment = (number) => {
        $.get('/api/account/card/'+number+'/abroadPayment')
            .then(data => {
                console.log(data)
            })
    }

    let showModalOpposite = () => {
        modalOpposite.show()
    }

    let showModalLimitDraw = (number) => {
        $.ajax({
            url: `/api/account/card/${number}/plafond`,
            success: data => {
                console.log(data)
                elements.modalLimitDraw.querySelector('#paymentLimit').innerHTML = data.payment.limit
                elements.modalLimitDraw.querySelector('.text-bank-payment').setAttribute('title', "Votre disponible est estimé en déduisant de vos "+data.payment.limit+" de plafond tous les achats que vous avez effectués les 15 derniers jours.")
                elements.modalLimitDraw.querySelector('.progressPayment').innerHTML = `Il reste ${data.payment.dispo} disponible`
                elements.modalLimitDraw.querySelector('.progressPayment').style.width = data.payment.percent_usage

                elements.modalLimitDraw.querySelector('#withdrawLimit').innerHTML = data.withdraw.limit
                elements.modalLimitDraw.querySelector('.text-bank-payment').setAttribute('title', "Votre disponible est estimé en déduisant de vos "+data.withdraw.limit+" de plafond tous les retraits que vous avez effectués les 15 derniers jours.")
                elements.modalLimitDraw.querySelector('.progressWithdraw').innerHTML = `Il reste ${data.withdraw.dispo} disponible`
                elements.modalLimitDraw.querySelector('.progressWithdraw').style.width = data.withdraw.percent_usage
            }
        })
        modalLimitDraw.show()
    }

    elements.btnShowCard.forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault()
            $.ajax({
                url: '/api/account/card',
                method: "POST",
                data: {"card_id": btn.dataset.card},
                success: data => {
                    console.log(data)
                    elements.modalShowCode.querySelector('.modal-content').setAttribute('data-card-number', data.card.number)
                    elements.modalShowCard.querySelector('.modal-title').innerHTML = `${data.brand} ${data.support}`
                    elements.modalShowCard.querySelector('.backCard').style.backgroundImage = `url('/storage/${data.support}.png')`
                    elements.modalShowCard.querySelector('.nameCard').innerHTML = `${data.nameCard}`
                    elements.modalShowCard.querySelector('.infoCard').innerHTML = `<span class="me-10">${data.numCard}</span> ${data.card.exp_month}/${data.card.exp_year}`
                    elements.modalShowCard.querySelector('.menu').innerHTML = `
                    <a class="d-flex justify-content-between align-items-center bg-hover-lighten w-400px h-50px">
                        <div class="px-5 fs-5 text-dark">Verrouillage temporaire</div>
                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                            <input class="form-check-input h-30px w-50px" type="checkbox" value="${data.card.number}" ${data.card.status === 'INACTIVE' ? 'checked="checked"' : ""} id="flexSwitch30x50" onchange="lockedCard(this)"/>
                        </div>
                    </a>
                    <a class="d-flex justify-content-between align-items-center bg-hover-lighten w-400px h-50px" onclick="showModalOpposite()">
                        <div class="px-5 fs-5 text-dark">Faire Opposition</div>
                        <i class="fas fa-chevron-right fa-2x ms-2"></i>
                    </a>
                    <a class="d-flex justify-content-between align-items-center bg-hover-lighten w-400px h-50px" onclick="showModalLimitDraw(${data.card.number})">
                        <div class="px-5 fs-5 text-dark">Gérer mes plafonds</div>
                        <i class="fas fa-chevron-right fa-2x ms-2"></i>
                    </a>
                    @if(ismobile())
                    <a class="d-flex justify-content-between align-items-center bg-hover-lighten w-400px h-50px" data-bs-toggle="modal" data-bs-target="#modalShowCode">
                        <div class="px-5 fs-5 text-dark">Voir mon code secret</div>
                        <i class="fas fa-chevron-right fa-2x ms-2"></i>
                    </a>
                    @endif
                    <div class="fw-bolder fs-3 mt-5">Réglages</div>
                    <a class="d-flex justify-content-between align-items-center bg-hover-lighten w-400px h-50px">
                        <div class="px-5 fs-5 text-dark">Paiement à distance</div>
                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                            <input class="form-check-input h-30px w-50px" type="checkbox" value="" ${data.card.external_payment === 1 ? 'checked="checked"' : ""} id="flexSwitch30x50" onchange="activeExternalPayment(${data.card.number})"/>
                        </div>
                    </a>
                    <a class="d-flex justify-content-between align-items-center bg-hover-lighten w-400px h-50px">
                        <div class="px-5 fs-5 text-dark">Paiement & retrait à l'étranger</div>
                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                            <input class="form-check-input h-30px w-50px" type="checkbox" value="" ${data.card.abroad_payment === 1 ? 'checked="checked"' : ""} id="flexSwitch30x50" onchange="activeAbroadPayment(${data.card.number})"/>
                        </div>
                    </a>
                    `
                    modalShowCard.show()
                }
            })
        })
    })

    $("#formAuthVerify").on('submit', e => {
        e.preventDefault()
        let form = $("#formAuthVerify")
        let url = form.attr('action')
        let data = form.serializeArray()
        let btn = form.find('.btn-bank')

        btn.attr('data-kt-indicator', 'on')

        axios.post(url, {
            auth_code: $("#auth_code").val()
        })
        .then(() => {
            btn.removeAttr('data-kt-indicator')
            let blockUi = new KTBlockUI(modalShowCode.querySelector(".modal-content"))
            blockUi.block()

            axios.get('/api/account/'+elements.modalShowCode.dataset.cardNumber+'/code')
            .then(response => {
                console.log(response)
            })
            .catch(response => {
                console.error(response)
            })

        })
        .catch(() => {
            btn.removeAttr('data-kt-indicator')
            $("#errorCode").html("Code Erronée")
            let blockUi = new KTBlockUI(elements.modalShowCode.querySelector(".modal-content"))
            blockUi.block()
            console.log(elements.modalShowCode.querySelector(".modal-content").dataset)

            axios.get('/api/account/card/'+elements.modalShowCode.querySelector(".modal-content").dataset.cardNumber+'/code')
                .then(response => {
                    console.log(response)
                    elements.modalShowCode.querySelector(".modal-content")
                    elements.modalShowCode.querySelector("#formAuthVerify").classList.add('d-none')
                    blockUi.release()
                    elements.modalShowCode.querySelector(".modal-content").innerHTML += `
                    <div class="modal-body">
                        <div class="text-center fs-3 fw-bolder">${response.data}</div>
                    </div>
                    `
                })
                .catch(response => {
                    console.error(response)
                })
        })

    })
</script>
