<?php

namespace App\View\Components\Front;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\AddBalance;

class Sidebar extends Component
{
    public $user;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $transaction_approvals_count = AddBalance::where('status', 1)->count();

        return view('components.front.sidebar', [
            'user' => $this->user,
            'transaction_approvals_count' => $transaction_approvals_count,
        ]);
    }
}
