<?php

namespace App\Livewire\Setting;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DurableType extends Component
{
    /* protected $listeners = ['close-modal' => '$refresh']; */
    public $durable_type, $durable_id;

    public function updated($fields)
    {
        $this->dispatch('datatable');
        $this->validateOnly($fields, [
            'durable_type' => 'required',
        ]);
    }

    public function storeDurableData()
    {

        $this->dispatch('datatable');
        $this->validate([
            'durable_type' => 'required',
        ]);

        $save = DB::table('com_type')->insert([
            'com_type_name' => $this->durable_type,
        ]);

        $this->durable_type = '';
        $this->dispatch('close-modal');
    }

    public function EditDurable($id)
    {
        
        $this->dispatch('datatable');
        $this->durable_id = '';
        $this->durable_type = '';
        $data = DB::table('com_type')->where('com_type_id', $id)->first();
        /* dd($data); */
        $this->durable_type = $data->com_type_name;
        $this->durable_id = $data->com_type_id;
        $this->dispatch('show-modal-edit');
    }

    public function EditDurableData()
    {
        $this->dispatch('datatable');
        $this->validate([
            'durable_type' => 'required',
        ]);

        $data = DB::table('com_type')
            ->where('com_type_id', $this->durable_id)
            ->update(array(
                'com_type_name' => $this->durable_type,
            ));
        $this->durable_id = '';
        $this->durable_type = '';
        $this->dispatch('close-modal');
    }
    
    public function mount()
    {
        $this->durable_id = '';
        $this->durable_type = '';
        $this->dispatch('datatable');
    }

    public function render()
    {
        $title = 'ลบครุภัณฑ์!';
        $text = "คุณแน่ใจที่จะลบหรือไหม?";
        confirmDelete($title, $text);
        $data = DB::table('com_type')->orderByDesc('com_type_id')->get();
        return view('livewire.setting.durable-type', ['data' => $data])->layout('livewire.setting.base');
    }
}
