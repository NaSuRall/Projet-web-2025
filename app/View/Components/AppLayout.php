<?php

namespace App\View\Components;

use App\Models\Group;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $groups = Group::all();
        return view('layouts.app', compact('groups'));
    }
}
