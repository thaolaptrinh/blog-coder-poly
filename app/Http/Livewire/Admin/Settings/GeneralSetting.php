<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Enums\BlogStatus;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;
use Livewire\Component;

class GeneralSetting extends Component
{

    public $site_name, $site_description,  $site_status, $site_keywords;



    protected function rules()
    {
        return [
            'site_name' => 'required|string',
            'site_description' => 'required|string',
            'site_keywords' => 'required|string',
            'site_status' => ['required', 'integer', Rule::in(BlogStatus::getValues())],
        ];
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function mount()
    {
        $settings = Setting::getValues(['site_name', 'site_status', 'site_description', 'site_keywords']);

        $this->site_name = $settings['site_name'];
        $this->site_status = $settings['site_status'];
        $this->site_description = $settings['site_description'];
        $this->site_keywords = $settings['site_keywords'];
    }


    public function save()
    {
        $validatedData = $this->validate($this->rules());

        Cache::clear();
        Setting::updateValues($validatedData);

        return back()->with('status', 'general-updated');
    }


    public function render()
    {
        return view('livewire.admin.settings.general-setting');
    }
}
