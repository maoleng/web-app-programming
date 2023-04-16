<?php

use App\Models\Admin;

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
        $auth = session()->get('auth');
        if ($auth !== null) {
            $auth->is_admin = $auth instanceof Admin;
        }
        return $auth ?? null;
    }
}

if (! function_exists('redirectBackWithError')) {
    function redirectBackWithError(string $error)
    {
        session()->flash('errors', [$error]);

        redirect()->back();
    }
}

