<script type="text/javascript">
    "use strict";
    let elements = {
        btnShowCard: document.querySelectorAll('.showCard'),
        modalShowCard: document.querySelector('#showCard'),
        modalOpposite: document.querySelector('#modalOpposition'),
        modalLimitDraw: document.querySelector('#modalLimitDraw'),
        modalShowCode: document.querySelector('#modalShowCode'),
        modalShowCheck: document.querySelector('#modalShowCheck'),
        modalAddCheck: document.querySelector('#modalAddCheck'),
        tableListCheck: document.querySelector('#tableListCheck'),
    }

    let modalShowCard = new bootstrap.Modal(elements.modalShowCard)
    let modalOpposite = new bootstrap.Modal(elements.modalOpposite)
    let modalLimitDraw = new bootstrap.Modal(elements.modalLimitDraw)
    let modalShowCode = new bootstrap.Modal(elements.modalShowCode)
    let modalShowCheck = new bootstrap.Modal(elements.modalShowCheck)
    let modalAddCheck = new bootstrap.Modal(elements.modalAddCheck)

    let lockedCard = (card) => {
        $.ajax({
            url: '/api/account/card/' + card.value + '/lock',
            method: 'POST',
            success: data => {
                console.log(data);
            }
        })
    }

    let activeExternalPayment = (number) => {
        $.get('/api/account/card/' + number + '/externalPayment')
            .then(data => {
                console.log(data)
            })
    }

    let activeAbroadPayment = (number) => {
        $.get('/api/account/card/' + number + '/abroadPayment')
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
                elements.modalLimitDraw.querySelector('.text-bank-payment').setAttribute('title', "Votre disponible est estimé en déduisant de vos " + data.payment.limit + " de plafond tous les achats que vous avez effectués les 15 derniers jours.")
                elements.modalLimitDraw.querySelector('.progressPayment').innerHTML = `Il reste ${data.payment.dispo} disponible`
                elements.modalLimitDraw.querySelector('.progressPayment').style.width = data.payment.percent_usage

                elements.modalLimitDraw.querySelector('#withdrawLimit').innerHTML = data.withdraw.limit
                elements.modalLimitDraw.querySelector('.text-bank-payment').setAttribute('title', "Votre disponible est estimé en déduisant de vos " + data.withdraw.limit + " de plafond tous les retraits que vous avez effectués les 15 derniers jours.")
                elements.modalLimitDraw.querySelector('.progressWithdraw').innerHTML = `Il reste ${data.withdraw.dispo} disponible`
                elements.modalLimitDraw.querySelector('.progressWithdraw').style.width = data.withdraw.percent_usage
            }
        })
        modalLimitDraw.show()
    }

    let LevyList = () => {
        let datatable;
        let filterAccount;
        let filterCreditor;
        let filterStatus;
        let table = document.querySelector('#kt_customers_table');


        let initLevyList = () => {
            const tableRows = table.querySelectorAll('tbody tr')

            tableRows.forEach(row => {
                const dateRow = row.querySelectorAll('td');
                const realDate = moment(dateRow[2].innerHTML, "D/M/Y").format(); // select date from 5th column in table
                dateRow[2].setAttribute('data-order', realDate);
            })

            datatable = $(table).DataTable({
                "info": false,
                'order': [],
                'columnDefs': [
                    { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                ]
            });

            // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
            datatable.on('draw', function () {
                initToggleToolbar();
                // Fonction création opposition
                handleOppositeRows()
                toggleToolbars();
            });
        }

        let handleSearchDatatable = () => {
            const filterSearch = document.querySelector('[data-kt-customer-table-filter="search"]');
            filterSearch.addEventListener('keyup', function (e) {
                datatable.search(e.target.value).draw();
            });
        }

        let handleOppositeRows = () => {
            const oppositeButton = table.querySelectorAll('[data-kt-customer-table-filter="create_opposite"]');

            oppositeButton.forEach(b => {
                b.addEventListener('click', e => {
                    e.preventDefault()

                    const parent = e.target.closest('tr')
                    const creditorName = parent.querySelectorAll('td')[3].innerText

                    Swal.fire({
                        text: `Êtes-vous sur de vouloir créer une opposition pour ${creditorName} ?`,
                        icon: 'warning',
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Oui, créer une opposition à ce prélèvement",
                        cancelButtonText: "Non",
                        customClass: {
                            confirmButton: "btn fw-bold btn-bank",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(result => {
                        if(result.isConfirmed === true) {
                            $.ajax({
                                url: '/api/account/levy/'+e.target.dataset.row,
                                method: "DELETE",
                                success: () => {
                                    Swal.fire({
                                        text: "Une opposition à été effectuer sur "+creditorName,
                                        icon: 'success',
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok !",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-bank",
                                        }
                                    }).then(() => {
                                        window.location.refresh()
                                    })
                                }
                            })
                        }
                    })
                })
            })
        }

        let handleFilterDatatable = () => {
            filterAccount = $('[data-kt-customer-table-filter="account"]')
            filterCreditor = $('[data-kt-customer-table-filter="creditor"]')
            filterStatus = $('[data-kt-customer-table-filter="status"]')

            const filterButton = document.querySelector('[data-kt-customer-table-filter="filter"]');

            filterButton.addEventListener('click', function () {
                // Get filter values
                const accountValue = filterAccount.val();
                const creditorValue = filterCreditor.val();
                const statusValue = filterStatus.val();

                // Build filter string from filter options
                const filterString = accountValue + ' ' + creditorValue + ' '+ statusValue;

                // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
                datatable.search(filterString).draw();
            });
        }

        // Reset Filter
        let handleResetForm = () => {
            // Select reset button
            const resetButton = document.querySelector('[data-kt-customer-table-filter="reset"]');

            // Reset datatable
            resetButton.addEventListener('click', function () {
                // Reset month
                filterAccount.val(null).trigger('change');
                filterCreditor.val(null).trigger('change');
                filterStatus.val(null).trigger('change');

                // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
                datatable.search('').draw();
            });
        }

        // Init toggle toolbar
        let initToggleToolbar = () => {
            // Toggle selected action toolbar
            // Select all checkboxes
            const checkboxes = table.querySelectorAll('[type="checkbox"]');

            // Select elements
            const oppositeSelected = document.querySelector('[data-kt-customer-table-select="opposite_selected"]');

            // Toggle delete selected toolbar
            checkboxes.forEach(c => {
                // Checkbox on click event
                c.addEventListener('click', function () {
                    setTimeout(function () {
                        toggleToolbars();
                    }, 50);
                });
            });

            // Deleted selected rows
            oppositeSelected.addEventListener('click', function () {
                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Êtes-vous sur de vouloir effectuer une opposition du ses prélèvement ?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Oui, créer une opposition",
                    cancelButtonText: "Non",
                    customClass: {
                        confirmButton: "btn fw-bold btn-bank",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if(result.isConfirmed === true) {
                        checkboxes.forEach(c => {
                            if (c.checked) {
                                $.ajax({
                                    url: '/api/account/levy/'+c.value,
                                    method: "DELETE",
                                    success: () => {
                                        Swal.fire({
                                            text: "Une opposition à été effectuer sur les Créanciers séléctionner",
                                            icon: 'success',
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok !",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-bank",
                                            }
                                        }).then(() => {
                                            window.location.refresh()
                                        })
                                    }
                                })
                                //datatable.row($(c.closest('tbody tr'))).remove().draw();
                            }
                        });

                        const headerCheckbox = table.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;
                    }
                });
            });
        }

        // Toggle toolbars
        const toggleToolbars = () => {
            // Define variables
            const toolbarBase = document.querySelector('[data-kt-customer-table-toolbar="base"]');
            const toolbarSelected = document.querySelector('[data-kt-customer-table-toolbar="selected"]');
            const selectedCount = document.querySelector('[data-kt-customer-table-select="selected_count"]');

            // Select refreshed checkbox DOM elements
            const allCheckboxes = table.querySelectorAll('tbody [type="checkbox"]');

            // Detect checkboxes state & count
            let checkedState = false;
            let count = 0;

            // Count checked boxes
            allCheckboxes.forEach(c => {
                if (c.checked) {
                    checkedState = true;
                    count++;
                }
            });

            // Toggle toolbars
            if (checkedState) {
                selectedCount.innerHTML = count;
                toolbarBase.classList.add('d-none');
                toolbarSelected.classList.remove('d-none');
            } else {
                toolbarBase.classList.remove('d-none');
                toolbarSelected.classList.add('d-none');
            }
        }
        // Public methods
        return {
            init: function () {
                table = document.querySelector('#kt_customers_table');

                if (!table) {
                    return;
                }

                initLevyList();
                initToggleToolbar();
                handleSearchDatatable();
                handleFilterDatatable();
                handleOppositeRows();
                handleResetForm();
            }
        }
    };


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

                axios.get('/api/account/' + elements.modalShowCode.dataset.cardNumber + '/code')
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

                axios.get('/api/account/card/' + elements.modalShowCode.querySelector(".modal-content").dataset.cardNumber + '/code')
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

    $("#formAddCheck").on('submit', e => {
        e.preventDefault()
        let form = $("#formAddCheck")
        let url = '/api/account/check';
        let data = form.serializeArray()
        let btn = form.find('.btn-bank')

        btn.attr('data-kt-indicator', 'on')

        $.post(url, data)
            .then(response => {
                btn.removeAttr('data-kt-indicator')
                if (response.status === 200) {
                    elements.tableListCheck.innerHTML += `
                        <tr>
                            <td>Chéquier N°${response.reference}</td>
                            <td>${response.statement}</td>
                        </tr>
                        `
                    modalAddCheck.hide();
                    form[0].reset()
                    toastr.success("Votre chéquier à été commander", "Commande de chéquier")
                    modalShowCheck.show()
                } else {
                    toastr.warning(response.error, "Commande de chéquier")
                }
            })
            .catch(err => {
                btn.removeAttr('data-kt-indicator')
                toastr.error("Une erreur à eu lieu lors de la commande de votre chéquier", "Commande de chéquier")
            })
    })

    KTUtil.onDOMContentLoaded(function () {
        LevyList().init();
    });
</script>
