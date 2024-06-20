<?php

namespace App\Livewire\Forms;

use App\Models\Feedback as ModelsFeedback;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class Feedback extends Form
{
    #[Validate('required')]
    public $name = '';

    #[Validate('required')]
    public $phone = '';

    #[Validate('required')]
    public $message = '';

    #[Validate('required')]
    public $link = '';

    public function store()
    {
        $this->validate();
        ModelsFeedback::create($this->all());
    }
}
