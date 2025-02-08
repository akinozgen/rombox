<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $content;
    public $link;
    public $linkTitle;
    public $icon;

    public function __construct($title, $content, $link, $linkTitle, $icon)
    {
        $this->title = $title;
        $this->content = $content;
        $this->link = $link;
        $this->linkTitle = $linkTitle;
        $this->icon = $icon;
    }

    public function render()
    {
        return view('components.card');
    }
}
