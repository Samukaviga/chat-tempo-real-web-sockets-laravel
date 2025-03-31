<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout
{

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');  // Redireciona o usuário para a página de login após logout
    }

    public function render()
    {
        return view('layout.navigation');
    }
}
