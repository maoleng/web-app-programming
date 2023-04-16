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

