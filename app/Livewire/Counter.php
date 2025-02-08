<?php

namespace App\Livewire;

use App\Mail\CounterNotification;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Livewire\Component;

class Counter extends Component
{
    public $count = 1;

    public function increment(): void
    {
        $this->count++;

        if ($this->count === 10) {
            Mail::to('test@example.com')->send(
                new CounterNotification(
                    count: $this->count,
                    timestamp: now()->format('Y-m-d H:i:s'),
                    marketing: true
                )
            );
        }
    }

    public function decrement(): void
    {
        $this->count--;
    }

    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.counter');
    }
}
