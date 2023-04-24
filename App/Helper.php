<?php

use App\Models\Movie;

if (! function_exists('toggleActiveMenu')) {
    function toggleActiveMenu($path): string
    {
        return request()->url === '/'.$path ? 'class="active"' : '';
    }
}

if (! function_exists('showFirstError')) {
    function showFirstError()
    {
        $errors = session()->get('errors');
        if (! empty($errors)) {
            return $errors[0];
        }

        return null;
    }
}

if (! function_exists('alertError')) {
    function alertError(): string
    {
        $errors = session()->get('errors');
        if (! empty($errors)) {
            return "
                swal({
                    title: 'Error !',
                    text: '$errors[0]',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-warning',
                    type: 'warning'
                })
            ";
        }

        return '';
    }
}


if (! function_exists('alertSuccess')) {
    function alertSuccess(): string
    {
        $success = session()->get('success');
        if (! empty($success)) {
            return "
                swal({
                    title: 'Successfully !',
                    text: '$success',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-success',
                    type: 'success'
                })
            ";
        }

        return '';
    }
}

if (! function_exists('alertSuccessCustomer')) {
    function alertSuccessCustomer(): string
    {
        $success = session()->get('success');
        if (! empty($success)) {
            return
                '$(\'body\').append(`
                    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-small ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                </div>
                                <div class="modal-body text-center">
                                    <div style="" class="picture">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50%" viewBox="0 0 512 512"><path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z"/></svg>
                                    </div>
                                </div>
                                <div class="modal-footer text-center">
                                    <h3 class="modal-title card-title text-center" id="myModalLabel">'.$success.'</h3>
                                    <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `)
                $(\'#success-modal\').modal(\'show\')
            ';
        }

        return '';
    }
}

if (! function_exists('alertErrorCustomer')) {
    function alertErrorCustomer(): string
    {
        $errors = session()->get('errors');
        if (! empty($errors)) {
            return
                '$(\'body\').append(`
                    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-small ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                </div>
                                <div class="modal-body text-center">
                                    <div style="" class="picture">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/></svg>
                                    </div>
                                </div>
                                <div class="modal-footer text-center">
                                    <h3 class="modal-title card-title text-center" id="myModalLabel">'.$errors[0].'</h3>
                                    <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `)
                $(\'#success-modal\').modal(\'show\')
            ';
        }

        return '';
    }
}

if (! function_exists('showSuccess')) {
    function showSuccess()
    {
        return session()->get('success');
    }
}

if (! function_exists('authed')) {
    function authed()
    {
        return session()->get('auth');
    }
}

if (! function_exists('redirectBackWithError')) {
    function redirectBackWithError(string $error)
    {
        session()->flash('errors', [$error]);

        redirect()->back();
    }
}

if (! function_exists('redirectBackWithSuccess')) {
    function redirectBackWithSuccess(string $message)
    {
        session()->flash('success', $message);

        redirect()->back();
    }
}

if (! function_exists('redirectWithError')) {
    function redirectWithError(string $route, string $error)
    {
        session()->flash('errors', [$error]);

        redirect()->route($route);
    }
}

if (! function_exists('redirectWithSuccess')) {
    function redirectWithSuccess(string $route, string $message)
    {
        session()->flash('success', $message);

        redirect()->route($route);
    }
}

if (! function_exists('prettyMoney')) {
    function prettyMoney($money): string
    {
        return number_format($money, 0, '', ',');
    }
}

if (! function_exists('getMovieFeed')) {
    function getMovieFeed(): array
    {
        return (new Movie)->limit(8)->get(['banner']);
    }
}
