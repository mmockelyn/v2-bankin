<script type="text/javascript">
    let elements = {
        btnShowCard: document.querySelectorAll('.showCard'),
        modalShowCard: document.querySelector('#showCard'),
        modalOpposite: document.querySelector('#modalOpposition'),
        modalLimitDraw: document.querySelector('#modalLimitDraw')
    }

    let modalShowCard = new bootstrap.Modal(elements.modalShowCard)
    let modalOpposite = new bootstrap.Modal(elements.modalOpposite)
    let modalLimitDraw = new bootstrap.Modal(elements.modalLimitDraw)

    let lockedCard = (card) => {
        $.ajax({
            url: '/api/account/card/'+card.value+'/lock',
            method: 'POST',
            success: data => {
                console.log(data);
            }
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
                    <a class="d-flex justify-content-between align-items-center bg-hover-lighten w-400px h-50px">
                        <div class="px-5 fs-5 text-dark">Voir mon code secret</div>
                        <i class="fas fa-chevron-right fa-2x ms-2"></i>
                    </a>
                    <div class="fw-bolder fs-3 mt-5">Réglages</div>
                    <a class="d-flex justify-content-between align-items-center bg-hover-lighten w-400px h-50px">
                        <div class="px-5 fs-5 text-dark">Paiement à distance</div>
                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                            <input class="form-check-input h-30px w-50px" type="checkbox" value="" ${data.card.external_payment === 1 ? 'checked="checked"' : ""} id="flexSwitch30x50"/>
                        </div>
                    </a>
                    <a class="d-flex justify-content-between align-items-center bg-hover-lighten w-400px h-50px">
                        <div class="px-5 fs-5 text-dark">Paiement & retrait à l'étranger</div>
                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                            <input class="form-check-input h-30px w-50px" type="checkbox" value="" ${data.card.abroad_payment === 1 ? 'checked="checked"' : ""} id="flexSwitch30x50"/>
                        </div>
                    </a>
                    `
                    modalShowCard.show()
                }
            })
        })
    })
</script>
