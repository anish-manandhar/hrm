<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class SettingBoolInput extends Component
{
    public function render()
    {
        return view('livewire.setting-bool-input');
    }

    public function changeBool($key)
    {
        $value = Setting::where('key', $key)->first();
        $value->value = !$value->value;
        $value->save();
    }
}
