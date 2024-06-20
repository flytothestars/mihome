<?php

namespace App\Livewire\Modals;

use App\Models\Offer;
use App\Models\Preorder as ModelsPreorder;
use App\Models\Product;
use LivewireUI\Modal\ModalComponent;

class Preorder extends ModalComponent
{
    public $product;
    public $offer = null;
    public $phone = null;
    public $confirm = false;

    protected $rules = ['phone' => 'required|regex:/^\+7 \([0-9]{3}\)\s[0-9]{3}\s[0-9]{2}\s[0-9]{2}$/i'];

    public function mount($product, $offer = null, $phone = null)
    {
        $this->product = Product::findOrFail($product);
        $this->offer = Offer::find($offer);
        $this->phone = $phone;
    }

    public function preorder()
    {
        $this->validate();
        ModelsPreorder::create([
            'phone' => $this->phone,
            'offer_id' => $this->offer->id
        ]);
        $this->confirm = true;
    }

    public function render()
    {
        $data = [
            'product' => $this->product,
            'offer' => $this->offer,
        ];
        if (!$this->offer && $this->product->offers()->count() === 1) $this->offer = $this->product->offers[0];
        if (!$this->offer) return view('livewire.modals.preorder-offers', $data);
        if ($this->confirm)  return view('livewire.modals.preorder-confirm', $data);
        return view('livewire.modals.preorder', $data);
    }
}
