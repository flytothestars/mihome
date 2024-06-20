<?php

namespace App\Livewire;

use App\Models\Cart as ModelsCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Component;

class CartItem extends Component
{
    public $cart;
    public $offer;
    public $quantity;
    public $component;
    public $added = false;

    public function mount($offer = null, $quantity = 1, $component = 'cart')
    {
        $this->cart = ModelsCart::where('fuser_id', Auth::check() ? Auth::id() : Session::getId())->first();
        if (!$this->cart) $this->cart = ModelsCart::create([
            'fuser_id' => Auth::check() ? Auth::id() : Session::getId()
        ]);
        $this->offer = Offer::find($offer);
        $this->quantity = $quantity;
        $this->component = $component;
    }

    public function addtocart()
    {
        if (!$this->offer) return;
        $this->cart->items()->updateOrCreate([
            'offer_id' => $this->offer->id
        ], [
            'quantity' => $this->quantity
        ]);
        $this->added = true;
        $this->dispatch('refresh-the-cart');
        $this->dispatch('openModal', 'modals.' . $this->component, [
            'product' =>  $this->offer->product->id,
            'offer' =>  $this->offer->id,
            'added' =>  $this->quantity
        ]);
    }

    public function render()
    {
        return view('livewire.cart-item', [
            'added' => !!$this->added,
            'product' => $this->offer->product,
        ]);
    }
}
