<script type="text/javascript">
    let elements = {
        formUpdatePhoneMail: $("#formUpdatePhoneMail"),
        formUpdateSituation: $("#formUpdateSituation"),
        formContact: $("#formContact"),
        formUpdatePassword: $("#formUpdatePassword"),
        formActiveAuth: $("#formActiveAuth"),
        dateField: document.querySelectorAll('.date'),
        divModalShowQr: document.querySelector('#show_qr_code'),
    }

    let modalQr = new bootstrap.Modal(elements.divModalShowQr)
    elements.formUpdatePhoneMail.on('submit', e => {
        e.preventDefault()
        let form = elements.formUpdatePhoneMail
        let url = form.attr('action')
        let data = form.serializeArray()
        let btn = form.find(".btn-bank")

        btn.attr('data-kt-indicator', 'on')
        btn.attr('disabled', 'true')

        $.ajax({
            url: url,
            method: 'post',
            data: data,
            statusCode: {
                200: data => {
                    btn.removeAttr('data-kt-indicator')
                    btn.removeAttr('disabled')
                    console.log(data)
                    toastr.success("Vos informations de communications ont été mise à jours", "Mise à jours")
                },
                500: err => {
                    btn.removeAttr('data-kt-indicator')
                    btn.removeAttr('disabled')
                    console.error(err)
                    toastr.error(err.message)
                },
                422: data => {
                    btn.removeAttr('data-kt-indicator')
                    btn.removeAttr('disabled')
                    toastr.warning(JSON.parse(data.responseText).message, "Erreur de formulaire")
                }
            }
        })
    })
    elements.formUpdateSituation.on('submit', e => {
        e.preventDefault()
        let form = elements.formUpdateSituation
        let url = form.attr('action')
        let data = form.serializeArray()
        let btn = form.find(".btn-bank")

        btn.attr('data-kt-indicator', 'on')
        btn.attr('disabled', 'true')

        $.ajax({
            url: url,
            method: 'post',
            data: data,
            statusCode: {
                200: data => {
                    btn.removeAttr('data-kt-indicator')
                    btn.removeAttr('disabled')
                    console.log(data)
                    toastr.success("Vos informations de situation ont été mise à jours", "Mise à jours")
                },
                500: err => {
                    btn.removeAttr('data-kt-indicator')
                    btn.removeAttr('disabled')
                    console.error(err)
                    toastr.error(err.message)
                },
                422: data => {
                    btn.removeAttr('data-kt-indicator')
                    btn.removeAttr('disabled')
                    toastr.warning(JSON.parse(data.responseText).message, "Erreur de formulaire")
                }
            }
        })
    })
    elements.formContact.on('submit', e => {
        e.preventDefault()
        let form = elements.formContact
        let url = form.attr('action')
        let data = form.serializeArray()
        let btn = form.find(".btn-bank")

        btn.attr('data-kt-indicator', 'on')
        btn.attr('disabled', 'true')

        $.ajax({
            url: url,
            method: 'post',
            data: data,
            statusCode: {
                200: data => {
                    btn.removeAttr('data-kt-indicator')
                    btn.removeAttr('disabled')
                    console.log(data)
                    toastr.success("Votre demande de contact nous est parvenue. Nous allons y répondre dans les prochaines heures", "Demande de contact")
                    form[0].reset();
                },
                500: err => {
                    btn.removeAttr('data-kt-indicator')
                    btn.removeAttr('disabled')
                    console.error(err)
                    toastr.error(err.message)
                },
                422: data => {
                    btn.removeAttr('data-kt-indicator')
                    btn.removeAttr('disabled')
                    toastr.warning(JSON.parse(data.responseText).message, "Erreur de formulaire")
                }
            }
        })
    })
    elements.formUpdatePassword.on('submit', e => {
        e.preventDefault()
        let form = elements.formUpdatePassword
        let url = form.attr('action')
        let data = form.serializeArray()
        let btn = form.find(".btn-bank")

        btn.attr('data-kt-indicator', 'on')
        btn.attr('disabled', 'true')

        $.ajax({
            url: url,
            method: 'put',
            data: data,
            statusCode: {
                200: data => {
                    btn.removeAttr('data-kt-indicator')
                    btn.removeAttr('disabled')
                    console.log(data)
                    toastr.success("Votre mot de passe à été modifier", "Modification du mot de passe")
                    form[0].reset();
                },
                500: err => {
                    btn.removeAttr('data-kt-indicator')
                    btn.removeAttr('disabled')
                    console.error(err)
                    toastr.error(err.message)
                },
                422: data => {
                    btn.removeAttr('data-kt-indicator')
                    btn.removeAttr('disabled')
                    toastr.warning(JSON.parse(data.responseText).message, "Erreur de formulaire")
                }
            }
        })
    })
    elements.formActiveAuth.on('submit', e => {
        e.preventDefault()
        let form = elements.formActiveAuth
        let url = form.attr('action')
        let data = form.serializeArray()
        let btn = form.find(".btn-bank")

        btn.attr('data-kt-indicator', 'on')
        btn.attr('disabled', 'true')

        $.ajax({
            url: url,
            method: 'post',
            data: data,
            statusCode: {
                200: data => {
                    btn.removeAttr('data-kt-indicator')
                    btn.removeAttr('disabled')
                    console.log(data)
                    toastr.success("L'authentification 2FA à été activer", "Authentification 2FA")
                    $.ajax({
                        url: '/user/two-factor-qr-code',
                        success: data => {
                            console.log(data)
                            elements.divModalShowQr.querySelector('#divQrShow').innerHTML = data.svg
                            modalQr.show()
                        }
                    })
                    form[0].reset();
                },
                500: err => {
                    btn.removeAttr('data-kt-indicator')
                    btn.removeAttr('disabled')
                    console.error(err)
                    toastr.error(err.message)
                },
                422: data => {
                    btn.removeAttr('data-kt-indicator')
                    btn.removeAttr('disabled')
                    toastr.warning(JSON.parse(data.responseText).message, "Erreur de formulaire")
                }
            }
        })
    })
    elements.dateField.forEach(date => {
        date.flatpickr()
    })
</script>
