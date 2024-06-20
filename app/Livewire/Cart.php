<?php

namespace App\Livewire;

use App\Models\Cart as ModelsCart;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\On;

class Cart extends Component
{
    #[On('refresh-the-cart')]
    public function render()
    {
        $cart = ModelsCart::where('fuser_id', Auth::check() ? Auth::id() : Session::getId())->first();
        if (!$cart) $cart = ModelsCart::create([
            'fuser_id' => Auth::check() ? Auth::id() : Session::getId()
        ]);
        return view('livewire.cart', [
            'cart' => $cart
        ]);
    }
}
