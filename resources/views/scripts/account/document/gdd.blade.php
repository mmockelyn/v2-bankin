<script type="text/javascript">
    let menus = document.querySelectorAll('.menu-link')
    let divShowDocument = document.querySelector('#showDocument')

    let blockUI = new KTBlockUI(divShowDocument);


    menus.forEach(menu => {
        menu.addEventListener('click', e => {
            e.preventDefault()
            blockUI.block()
            $.ajax({
                url: `/compte/documents/gdd/${e.target.dataset.category}/list`,
                success: data => {
                    blockUI.release()
                    divShowDocument.innerHTML = ``
                    data.forEach(item => {
                        divShowDocument.innerHTML += `
                            <div class="d-flex align-items-sm-center mb-7">
                            <div class="symbol symbol-50px me-5">
                            <span class="symbol-label">
                            <i class="fa-solid fa-file-pdf fa-2xl"></i>
                            </span>
                            </div>

                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                            <div class="flex-grow-1 me-2">
                            <a href="${item.link}" class="text-gray-800 text-hover-primary fs-6 fw-bolder">${item.name}</a>
                            <span class="text-muted fw-bold d-block fs-7">pdf</span>
                            </div>
                            <span class="badge badge-light fw-bolder my-2">${item.created_at}</span>
                            </div>
                            </div>
                        `
                    })
                }
            })
        })
    })
</script>
