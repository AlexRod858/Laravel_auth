<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'details' => 'required'
        ]);


        $items = Item::create($request->all());


        return back()->with('success', 'Item created successfully!');
    }
}
