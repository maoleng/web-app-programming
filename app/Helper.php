<?php

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
    function redirectBackWithSuccess(string $success)
    {
        session()->flash('success', $success);

        redirect()->back();
    }
}
