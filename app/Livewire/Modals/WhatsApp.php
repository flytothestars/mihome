<?php

namespace App\Livewire\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class WhatsApp extends ModalComponent
{

    public string $video = "";

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('livewire.modals.whatsapp');
    }
}
