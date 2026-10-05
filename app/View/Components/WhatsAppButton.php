<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WhatsAppButton extends Component
{
    // public $phoneNumber;
    // public $message;

    public function __construct()
    {
        // $this->phoneNumber = $phoneNumber;
        // $this->message = $message;
    }

    public function render()
    {
        return view('components.whats-app-button');
    }
}
