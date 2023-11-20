<?php

namespace App\Livewire\Setting;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DurableEngineer extends Component
{
    protected $listeners = ['DeleteConfirm' => 'DelDurableData',
    'EditDurable' => 'EditDurable'];
    public $engineer_id, $engineer_name,$engineer_edit_id;

    public function resetinput()
    {
        $this->engineer_id = '';
        $this->engineer_name = '';
    }
    public function storeDurableData()
    {
        $this->validate(
            [
                'engineer_id' => 'required|unique:status,id',
                'engineer_name' => 'required',
            ],
            [
                'engineer_id.required' => '* กรุณากรอกข้อมูลให้ครบถ้วน',
                'engineer_id.unique' => '* ไอดีนี้ถูกใช้งานไปแล้ว',
                'engineer_name.required' => '* กรุณากรอกข้อมูลให้ครบถ้วน',
            ]
        );
        DB::beginTransaction();
        try {
            DB::table('durable_engineer')->insert([
                'id' => $this->engineer_id,
                'engineer_name' => $this->engineer_name,
            ]);
            $this->dispatch('close-modal');
            $this->engineer_id = '';
            $this->engineer_name = '';
            DB::Commit();
            $this->dispatch('alert_success');
        } catch (Exception $e) {
            $this->engineer_id = '';
            $this->engineer_name = '';
            $this->dispatch('close-modal');
            DB::rollback();
            $this->dispatch('alert_error');
        }
    }

    public function EditDurable($id)
    {

        $this->engineer_id = '';
        $this->engineer_name = '';
        $data = DB::table('durable_engineer')->where('id', $id)->first();
        $this->engineer_id = $data->id;
        $this->engineer_edit_id = $data->id;
        $this->engineer_name = $data->engineer_name;
        $this->dispatch('show-modal-edit');
    }

    public function EditDurableData()
    {
        $this->validate(
            [
                'engineer_id' => 'required|unique:status,id,' . $this->engineer_edit_id . '',
                'engineer_name' => 'required',
            ],
            [
                'engineer_id.required' => '* กรุณากรอกข้อมูลให้ครบถ้วน',
                'engineer_id.unique' => '* ไอดีนี้ถูกใช้งานไปแล้ว',
                'engineer_name.required' => '* กรุณากรอกข้อมูลให้ครบถ้วน',
            ]
        );

        DB::beginTransaction();
        try {
            DB::table('durable_engineer')
                ->where('id', $this->engineer_edit_id)
                ->update(array(
                    'id' => $this->engineer_id,
                    'engineer_name' => $this->engineer_name,
                ));
            $this->engineer_id = '';
            $this->engineer_name = '';
            $this->dispatch('close-modal');
            DB::Commit();
            $this->dispatch('alert_success');
        } catch (Exception $e) {
            $this->engineer_id = '';
            $this->engineer_name = '';
            $this->dispatch('close-modal');
            DB::rollback();
            $this->dispatch('alert_error');
        }
    }
    /* public function DelDurable($id)
    {
        $data = DB::table('status')->where('id', $id)->first();
        $this->engineer_id = $data->id;
        $this->dispatch('al-del');
    } */
    public function DelDurableData($id)
    {

        DB::beginTransaction();
        try {
            DB::table('durable_engineer')->where('id', '=', $id)->delete();
            DB::Commit();
            $this->dispatch('alert_success');
        } catch (Exception $e) {
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
        $data = DB::table('durable_engineer')->orderByDesc('id')->get();
        return view('livewire.setting.durable-engineer', ['data' => $data])->layout('livewire.setting.base')->title('ช่างซ่อม');
    }
}
