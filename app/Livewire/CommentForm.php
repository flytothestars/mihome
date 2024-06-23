<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class CommentForm extends Component
{
    public $product;
    public $rate = 5;
    public $name = '';
    public $advantages = '';
    public $disadvantages = '';
    public $text = '';
    public $stars = [true, true, true, true, true];
    public $datetime;
    protected $rules = [
        'name' => 'required',
    ];

    public function setRate($rate)
    {
        $this->rate = $rate;
        for ($i = 0; $i < 5; ++$i) $this->stars[$i] = $this->rate > $i;
    }

    public function mount($product)
    {
        $this->datetime = date('Y-m-d');
        $this->name = Auth::check() ? Auth::user()->name : '';
        $this->product = $product;
    }

    public function submit()
    {
        $this->validate();
        $product = Product::findOrFail($this->product);
        $review = $product->reviews()->create(
            [
                'user_id' => Auth::id(),
                'rate' => $this->rate,
                'name' => $this->name ?: (Auth::check() ? Auth::user()->name : ''),
                'advantages' => $this->advantages,
                'disadvantages' => $this->disadvantages,
                'text' => $this->text,
            ]
        );
        $cnt = 0;
        array_map(function ($file) use ($review, $cnt) {
            $cnt += 100;
            $path = Storage::put('comments', Storage::get($file));
            $review->images()->create([
                'sort' => $cnt,
                'link' => $path
            ]);
        }, Storage::files("tmp/", Session::getId()));

        $this->rate = 5;
        $this->name = '';
        $this->advantages = '';
        $this->disadvantages = '';
        $this->text = '';
        $this->stars = [true, true, true, true, true];
    }

    public function render()
    {
        return view('livewire.comment-form');
    }
}
