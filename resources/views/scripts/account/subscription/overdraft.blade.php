<script type="text/javascript">
    let elements = {
        btnSimulate: document.querySelector("#simulate"),
        cardSimulate: document.querySelector("#simulateResult")
    }

    let blockCard = new KTBlockUI(elements.cardSimulate)

    elements.btnSimulate.addEventListener('click', e => {
        blockCard.block({
            message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Chargement de la simulation...</div>',
        })

        $.ajax({
            url: '/api/account/simulate',
            method: "POST",
            data: {
                "action": elements.btnSimulate.dataset.action,
                "incoming": elements.btnSimulate.dataset.incoming,
                "customer": elements.btnSimulate.dataset.customer,
            },
            success: data => {
                console.log(data)
                if (data.access === false) {
                    elements.cardSimulate.innerHTML = `
                    <div class="d-flex flex-column flex-center">
                        <div>
                            <i class="fas fa-times-circle fa-5x text-danger"></i>
                        </div>
                        <div>Vous ne pouvez pas obtenir de découvert bancaire actuellement.</div>
                        <div>Résons: ${data.error}</div>
                    </div>
                `
                } else {
                    elements.cardSimulate.innerHTML = `
                    <div class="d-flex flex-column flex-center">
                        <div class="mb-10">
                            <i class="fas fa-check-circle fa-5x text-success"></i>
                        </div>
                        <div class="fs-2 mb-5">Félicitation, vous avez le droit à un découvert bancaire d'un montant de:</div>
                        <div class="mb-5">
                            <span class="badge badge-lg badge-success fs-3tx">${new Intl.NumberFormat('fr-FR', {style: "currency", currency: "EUR"}).format(data.value)}</span>
                        </div>
                        <p>Taux utilisation débiteur du découvert: ${data.taux}</p>
                        <form action="{{ route('account.subscribe.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="action" value="overdraft">
                            <input type="hidden" name="customer" value="{{ request()->user()->customer }}">
                            <input type="hidden" name="amount" value="${data.value}">

                            <button class="btn btn-bank">Demander mon découvert</button>
                        </form>
                    </div>
                `
                }
            }
        })
    })
</script>
