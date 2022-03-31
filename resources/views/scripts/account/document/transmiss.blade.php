<script type="text/javascript">
    let modal = document.querySelector('#modalTransfer')
    let btnShowModal = document.querySelectorAll('.btnShowModal')

    let m = new bootstrap.Modal(document.querySelector('#modalTransfer'))

    btnShowModal.forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault()
            console.log(e.target)
            $.ajax({
                url: '/api/account/document/'+e.target.dataset.documentId,
                success: data => {
                    console.log(data)
                    modal.querySelector('[name="document_transmiss_id"]').value = data.id
                    modal.querySelector('#document_type').innerHTML = data.type_document
                    m.show()
                }
            })
        })
    })
</script>
