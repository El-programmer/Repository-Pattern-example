<?php

namespace App\Datatables;

use Illuminate\Support\Traits\Macroable;

class DataTableActions
{
    public ?string $prifixPrmisssion = null;
    public bool $showBtn = false;
    public string $showRoute = "";

    public bool $deleteBtn = false;
    public string $deleteRoute = "";

    public bool $restoreBtn = false;
    public string $restoreRoute = "";

    public bool $editBtn = false;
    public string $editRoute = '';
    public array $extraBtns = [];

    public function __construct($prifix = null)
    {
        $this->prifixPrmisssion = $prifix;
    }

    public function show(string $route, $showBtn = true): static
    {
        if ($this->prifixPrmisssion == null || auth()->user()->can($this->prifixPrmisssion . "-show"))
            $this->showBtn = $showBtn;
        $this->showRoute = $route;

        return $this;
    }

    public function delete(string $route, $deleteBtn = true): static
    {
        if ($this->prifixPrmisssion == null || auth()->user()->can($this->prifixPrmisssion . "-delete"))
            $this->deleteBtn = $deleteBtn;
        $this->deleteRoute = $route;

        return $this;
    }

    public function restore(string $route, $restoreBtn = true): static
    {
        $this->restoreBtn = $restoreBtn;
        $this->restoreRoute = $route;

        return $this;
    }

    public function edit(string $route, $editBtn = true): static
    {
        if ($this->prifixPrmisssion == null || auth()->user()->can($this->prifixPrmisssion . "-edit"))
            $this->editBtn = $editBtn;
        $this->editRoute = $route;

        return $this;
    }

    public function make(): string
    {

        $html = '

    <div class="btn-group">
        <button type="button" class="btn  btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
            <i class="ti ti-dots-vertical"></i>
        </button>
  <ul class="dropdown-menu"  >';
        if ($this->showBtn) {
            $html .= '<a href="' . $this->showRoute . '" class="dropdown-item text-orange">
<i class="fa fa-eye"></i> ' . __('show') . '
            </a>';
        }
        if ($this->editBtn) {
            $html .= '<a href="' . $this->editRoute . '" class="dropdown-item text-orange">
<i class="fa fa-gear"></i> ' . __('edit') . '
            </a>';
        }
        if ($this->deleteBtn) {
            $html .= '<a data-bs-toggle="modal" data-bs-target="#delete" href="javascript:;" data-href="' . $this->deleteRoute . '" class="dropdown-item text-danger">
<i class="fa fa-times"></i> ' . __('delete') . '
            </a>';
        }
        if ($this->restoreBtn) {
            $html .= '<a data-bs-toggle="modal" data-bs-target="#restore" href="javascript:;" data-href="' . $this->restoreRoute . '" class="dropdown-item text-warning">
<i class="fa fa-eye"></i> ' . __('restore') . '
</a>';
        }
        foreach ($this->extraBtns as $btn) {
            if (isset($btn['html']))
                $html .= $btn['html'];
            else
                $html .= '<a href="' . $btn['url'] . '" class="dropdown-item text-warning">
 ' . $btn['icon'] . $btn['text'] . '
</a>';
        }
        return $html . '  </ul></div>';
    }

    public static function checkBox(mixed $id): string
    {
        return '<div class="form-check form-check-sm form-check-custom form-check-solid cursor-pointer "><input class="form-check-input mx-auto cursor-pointer datatableCheckBox" name="ids[]" type="checkbox" value="' . $id . '" /></div>';
    }

    public function addBtn($text, $url, $icon = "")
    {
        $this->extraBtns[] = [
            'text' => $text,
            'url' => $url,
            'icon' => $icon,
        ];
        return $this;
    }

    public function addHtml($html)
    {
        $this->extraBtns[] = [
            'text' => '',
            'url' => '',
            'icon' => '',
            'html' => $html
        ];
        return $this;
    }
}
