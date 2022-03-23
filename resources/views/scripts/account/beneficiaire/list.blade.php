<script type="text/javascript">
    let elements = {
        divModalShow: document.querySelector('#show'),
        btnModalShow: document.querySelectorAll('.showModal'),
        divAddModal: document.querySelector('#add'),
        bicField: document.querySelector("#bic"),
        bankInfo: document.querySelector("#bank_info")
    }

    let modalShow = new bootstrap.Modal(elements.divModalShow)

    elements.btnModalShow.forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault()
            console.log(e.target.parentNode.dataset.bene)

            $.ajax({
                url: '/compte/transfer/beneficiaire/'+e.target.parentNode.dataset.bene,
                contentType : "application/json",
                dataType: "json",
                success: data => {
                    console.log(data)

                    let titulaire = {
                        0: {"text": "Non"},
                        1: {"text": "Oui"},
                    }

                    elements.divModalShow.querySelector("#logo_bank").setAttribute('src', data.bank.logo)
                    elements.divModalShow.querySelector("#nameBank").innerHTML = data.bank.name
                    elements.divModalShow.querySelector("#bicBank").innerHTML = data.bank.bic
                    elements.divModalShow.querySelector("#iban").innerHTML = data.beneficiaire.bank.iban
                    elements.divModalShow.querySelector("#nameBene").innerHTML = data.beneficiaire.type === 'corporate' ? data.beneficiaire.company : `${data.beneficiaire.civility}. ${data.beneficiaire.firstname} ${data.beneficiaire.lastname}`
                    elements.divModalShow.querySelector("#titulaire").innerHTML = titulaire[data.beneficiaire.bank.titulaire].text
                    elements.divModalShow.querySelector(".btn-outline-danger").setAttribute('data-bene', data.beneficiaire.uuid)
                    elements.divModalShow.querySelector(".btn-bank").setAttribute('data-bene', data.beneficiaire.uuid)

                    let delBtn = elements.divModalShow.querySelector(".btn-outline-danger");
                    let editBtn = elements.divModalShow.querySelector(".btn-bank");
                    let virBtn = elements.divModalShow.querySelector(".btn-outline-primary");
                    delBtn.addEventListener('click', e => {
                        e.preventDefault()
                        $.ajax({
                            url: '/compte/transfer/beneficiaire/'+e.target.dataset.bene,
                            method: "DELETE",
                            success: data => {
                                window.location.reload()
                            },
                            error: err => {
                                console.error(err)
                            }
                        })
                    })

                    editBtn.addEventListener('click', e => {
                        e.preventDefault()
                        window.location.href='/compte/transfer/beneficiaire/'+e.target.dataset.bene
                    })

                    virBtn.addEventListener('click', e => {
                        e.preventDefault()
                        window.location.href='/compte/transfer/create?beneficiaire='+data.beneficiaire.uuid
                    })

                    modalShow.show()
                },
                error: err => {
                    console.error(err)
                }
            })
        })
    })

    let modalAdd = new bootstrap.Modal(elements.divAddModal)

    let checkTypeAccount = (type) => {
        if(type.value === 'corporate') {
            document.querySelector("#corporate").classList.remove('d-none')
            document.querySelector("#retail").classList.add('d-none')
        } else {
            document.querySelector("#corporate").classList.add('d-none')
            document.querySelector("#retail").classList.remove('d-none')
        }
    }

    elements.bicField.addEventListener('blur', e => {
        e.preventDefault()
        changeBankInfo()
    })

    let changeBankInfo = () => {
        $.ajax({
            url: '/api/account/bank',
            method: 'POST',
            data: {"bic": elements.bicField.value},
            success: data => {
                console.log(data)
                elements.divAddModal.querySelector("#logo_bank").setAttribute('src', data.info.logo)
                elements.divAddModal.querySelector("#nameBank").innerHTML = data.bank.bank_name
                elements.divAddModal.querySelector("#bicBank").innerHTML = data.bank.swift_code
                elements.bankInfo.classList.remove('d-none')

            }
        })
    }
</script>
