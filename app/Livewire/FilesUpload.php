<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class FilesUpload extends Component
{
    use WithFileUploads;

    public $files = [];

    public function render()
    {
        return view('livewire.files-upload');
    }

    public function updatedFiles()
    {
        // You can do whatever you want to do with $this->files here
    }
}
