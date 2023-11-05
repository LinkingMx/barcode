<?php

namespace App\Livewire;

use App\Models\Code;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Milon\Barcode\DNS1D;

class ShowCodes extends Component
{

    public $barcode;
    public $printcode;

    public function render()
    {
        return view('livewire.show-codes')->layout('layouts.app');
    }

    public function search()
    {
        $this->printcode = Code::where('code', $this->barcode)->get();
    }
}
