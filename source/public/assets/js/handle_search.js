$('#i-search').on('keypress',function(e) {
    if(e.which === 13) {
        handle('q', $(this).val())
    }
})

$('#i-ordered_at').on('change', function () {
    const range = $(this).val().split(' to ')
    if (range.length !== 2) {
        return
    }
    let ordered_at = range.join(',')
    handle('ordered_at', ordered_at)
})

$('#i-created_at').on('change', function () {
    const range = $(this).val().split(' to ')
    if (range.length !== 2) {
        return
    }
    let created_at = range.join(',')
    handle('created_at', created_at)
})

$('#i-expired_at').on('change', function () {
    const range = $(this).val().split(' to ')
    if (range.length !== 2) {
        return
    }
    let expired_at = range.join(',')
    handle('expired_at', expired_at)
})

function handle(param_name, value)
{
    let url = window.location.href.split('?')[0];
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());
    const param_names = Object.keys(params)

    if (params[param_name] !== undefined) {
        let query_string = ''
        let first = true
        if (param_names.length > 0) {
            param_names.forEach(function (name) {
                if (name !== param_name) {
                    query_string += first ? '?' : '&'
                    query_string += `${name}=${params[name]}`
                    first = false
                }
            })
            query_string += query_string === '' ? `?${param_name}=${value}` : `&${param_name}=${value}`
        } else {
            query_string += `?${param_name}=${value}`
        }
        window.location.href = url + query_string

        return
    }
    const link_char = param_names.length > 0 ? '&' : '?'
    window.location.href = window.location.href + link_char + `${param_name}=` + value
}

