<script type="text/javascript">
    // Class definition
    var KTDatatablesServerSide = function () {
        // Shared variables
        var table;
        var dt;
        var filterPayment;

        // Private functions
        var initDatatable = function () {
            dt = $("#listTransactions").DataTable({
                searchDelay: 500,
            });

            table = dt.$;
        }

        // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
        var handleSearchDatatable = function () {
            const filterSearch = document.querySelector('[data-kt-search-element="input"]');
            filterSearch.addEventListener('keyup', function (e) {
                dt.search(e.target.value).draw();
            });
        }
        // Public methods
        return {
            init: function () {
                initDatatable();
                handleSearchDatatable();
            }
        }
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTDatatablesServerSide.init();
        document.querySelectorAll('.show').forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault()
                let divModal = document.querySelector('#view_transpac')
                let modal = new bootstrap.Modal(divModal);

                $.ajax({
                    url: `/api/transaction/${e.target.dataset.transaction}`,
                    success: data => {
                        console.log(data)

                        let type = {
                            'deposit': {"title": "Dépot sur le compte"},
                            'withdraw': {"title": "Retrait sur le compte"},
                            'payment': {"title": "Carte Bancaire"},
                            'transfer': {"title": "Virement Bancaire"},
                            'sepa': {"title": "Prélèvement bancaire"},
                            'fee': {"title": "Frais bancaire"},
                            'subscription': {"title": "Cotisation"},
                        };

                        let state = {
                            0: {"class": "warning", "title": "A Venir", "icon": "fa-exclamation"},
                            1: {"class": "success", "title": "Comptabilisé", "icon": "fa-check"},
                        }
                        divModal.querySelector('.modal-header').classList.add(`bg-${data.category.color}`)
                        divModal.querySelector('.modal-title').innerHTML = `${data.name}`
                        data.amount >= 0 ?
                            divModal.querySelector('#amount').classList.add('text-success') :
                            divModal.querySelector('#amount').classList.add('text-danger')

                        data.amount >= 0 ?
                            divModal.querySelector('#amount').classList.remove('text-danger') :
                            divModal.querySelector('#amount').classList.remove('text-success')

                        data.amount >= 0 ?
                            divModal.querySelector('#amount').classList.add('badge-light-success') :
                            divModal.querySelector('#amount').classList.add('badge-light-danger')

                        data.amount >= 0 ?
                            divModal.querySelector('#amount').classList.remove('badge-light-danger') :
                            divModal.querySelector('#amount').classList.remove('badge-light-success')

                        divModal.querySelector('#amount').innerHTML = new Intl.NumberFormat('fr-FR', {style: 'currency', currency: 'EUR'}).format(data.amount)

                        divModal.querySelector('#type').innerHTML = `${type[data.type].title}`
                        divModal.querySelector('#reference').innerHTML = `${data.uuid}`
                        divModal.querySelector('#status').innerHTML = `<span class="badge badge-${state[data.confirmed].class} rounded-3"><i class="fas ${state[data.confirmed].icon} me-2 text-white"></i> ${state[data.confirmed].title}</span>`
                        modal.show()
                    }
                })
            })
        })
    });
</script>
