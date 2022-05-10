<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $title;
    public $modalId;
    public $modalSize;
    public $hasSubmitBtn;
    public $submitBtnId;
    public $submitBtnText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $modalId, $modalSize, $submitBtn = false)
    {
        $this->title = $title;
        $this->modalId = $modalId;
        $this->modalSize = $modalSize;
        $this->hasSubmitBtn = false;
        if($submitBtn){
            $this->hasSubmitBtn = true;
            $this->submitBtnId = $submitBtn['id'];
            $this->submitBtnText = $submitBtn['text'];
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
