<?php

namespace App\Livewire\Setting;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DurableType extends Component
{
    protected $listeners = ['DeleteConfirm' => 'DelDurableData'];
    public $durable_type, $durable_id;
    

    public function resetinput()
    {
        $this->durable_id = '';
        $this->durable_type = '';
    }
    public function storeDurableData()
    {
        $this->validate(
            [
                'durable_type' => 'required',
            ],
            [
                'durable_type.required' => '* กรุณากรอกข้อมูลให้ครบถ้วน',
            ]
        );
        DB::beginTransaction();
        try {
            DB::table('com_type')->insert([
                'com_type_name' => $this->durable_type
            ]);
            $this->dispatch('close-modal');
            $this->durable_id = '';
            $this->durable_type = '';
            DB::Commit();
            $this->dispatch('alert_success');
        } catch (Exception $e) {
            $this->durable_id = '';
            $this->durable_type = '';
            DB::rollback();
            $this->dispatch('alert_error');
        }
    }
    public function EditDurable($id)
    {

        $this->durable_id = '';
        $this->durable_type = '';
        $data = DB::table('com_type')->where('com_type_id', $id)->first();
        $this->durable_type = $data->com_type_name;
        $this->durable_id = $data->com_type_id;
        $this->dispatch('show-modal-edit');
    }

    public function EditDurableData()
    {
        $this->validate(
            [
                'durable_type' => 'required',
            ],
            [
                'durable_type.required' => '* กรุณากรอกข้อมูลให้ครบถ้วน',
            ]
        );

        DB::beginTransaction();
        try {
            DB::table('com_type')
                ->where('com_type_id', $this->durable_id)
                ->update(array(
                    'com_type_name' => $this->durable_type,
                ));
            $this->durable_id = '';
            $this->durable_type = '';
            $this->dispatch('close-modal');
            DB::Commit();
            $this->dispatch('alert_success');
        } catch (Exception $e) {
            $this->durable_id = '';
            $this->durable_type = '';
            DB::rollback();
            $this->dispatch('alert_error');
        }
    }

    public function DelDurable($id)
    {
        $data = DB::table('com_type')->where('com_type_id', $id)->first();
        $this->durable_type = $data->com_type_name;
        $this->durable_id = $data->com_type_id;
        $this->dispatch('al-del');
    }
    public function DelDurableData()
    {

        DB::beginTransaction();
        try {
            DB::table('com_type')->where('com_type_id', '=', $this->durable_id)->delete();
            $this->durable_id = '';
            $this->durable_type = '';
            DB::Commit();
            $this->dispatch('alert_success');
        } catch (Exception $e) {
            $this->durable_id = '';
            $this->durable_type = '';
            DB::rollback();
            $this->dispatch('alert_error');
        }
    }

    public function boot()
    {
        $this->dispatch('datatable');
    }
    
    
    public function render()
    {
        $title = 'ลบครุภัณฑ์!';
        $text = "คุณแน่ใจที่จะลบหรือไหม?";
        confirmDelete($title, $text);
        $data = DB::table('com_type')->orderByDesc('com_type_id')->get();
        return view('livewire.setting.durable-type', ['data' => $data])->layout('livewire.setting.base')->title('ประเภทครุภัณฑ์');
    }
}
