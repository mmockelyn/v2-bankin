$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

document.querySelector('.logout').addEventListener('click', e => {
    e.preventDefault()
    let btn = e.target

    $.ajax({
        url: '/logout',
        method: "POST",
        success: () => {
            window.location.reload()
        }
    })
})
