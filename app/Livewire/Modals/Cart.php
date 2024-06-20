<?php

namespace App\Livewire\Modals;

use App\Models\Cart as ModelsCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use LivewireUI\Modal\ModalComponent;

class Cart extends ModalComponent
{
    public $sign = 'Для получения дополнительной скидки 5% выберите соответствующий способ оплаты в корзине.';
    public $component = 'cart';
    public $cart;
    public $product;
    public $offer;
    public $added = 1;

    public function mount($product, $offer = null, $added = 1)
    {
        $this->cart = ModelsCart::where('fuser_id', Auth::check() ? Auth::id() : Session::getId())->first();
        if (!$this->cart) $this->cart = ModelsCart::create([
            'fuser_id' => Auth::check() ? Auth::id() : Session::getId()
        ]);
        $this->added = $added;
        $this->product = Product::findOrFail($product);
        $this->offer = Offer::find($offer);
    }

    public function render()
    {
        if (!$this->offer && $this->product->offers()->count() === 1) $this->offer = $this->product->offers[0];
        if (!$this->offer) return view('livewire.modals.cart.offers');

        $this->cart->items()->updateOrCreate([
            'offer_id' => $this->offer->id
        ], [
            'quantity' => 1
        ]);
        $this->dispatch('refresh-the-cart');

        return view('livewire.modals.cart.confirm');
    }
}
