<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\Feedback as FormsFeedback;
use App\Models\Offer;
use App\Models\Preorder as ModelsPreorder;
use App\Models\Product;
use LivewireUI\Modal\ModalComponent;

class Feedback extends ModalComponent
{
    public $link;

    public function mount($link)
    {
        $this->form->link = $link;
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public FormsFeedback $form;

    public function save()
    {
        $this->form->store();
        $this->closeModal();
    }

    public function render()
    {
        $data = [];
        return view('livewire.modals.feedback', $data);
    }
}
