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

var owa_baseUrl = 'https://owa.bzhm.tk/';
var owa_cmds = owa_cmds || [];
owa_cmds.push(['setSiteId', '44837492d1ada871b72cb5c321fce65a']);
owa_cmds.push(['trackPageView']);
owa_cmds.push(['trackClicks']);

(function() {
    var _owa = document.createElement('script'); _owa.type = 'text/javascript'; _owa.async = true;
    owa_baseUrl = ('https:' == document.location.protocol ? window.owa_baseSecUrl || owa_baseUrl.replace(/http:/, 'https:') : owa_baseUrl );
    _owa.src = owa_baseUrl + 'modules/base/dist/owa.tracker.js';
    var _owa_s = document.getElementsByTagName('script')[0]; _owa_s.parentNode.insertBefore(_owa, _owa_s);
}());
