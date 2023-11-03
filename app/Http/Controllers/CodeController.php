<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CodeController extends Controller
{
    //
    public $barcode;

    public function render(){
        return view('livewire.show-codes');
    }
    
    
}
