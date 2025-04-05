<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Section extends Component
{
    public $title;
    public $slot;

    public function __construct($title, $slot = null)
    {
        $this->title = $title;
        $this->slot = $slot;
    }

    public function render()
    {
        return view('components.admin.section');
    }
}
