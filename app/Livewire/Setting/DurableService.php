<?php

namespace App\Livewire\Setting;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DurableService extends Component
{
    protected $listeners = ['DeleteConfirm' => 'DelDurableData'];
    public $durable_type, $durable_id, $durable_vid;
    

    public function resetinput()
    {
        $this->durable_id = '';
        $this->durable_type = '';
        $this->durable_vid = '';
    }
    public function storeDurableData()
    {
        $this->validate(
            [
                'durable_type' => 'required',
                'durable_vid' => 'required|unique:com_service_list,v_id',
            ],
            [
                'durable_type.required' => '* กรุณากรอกข้อมูลให้ครบถ้วน',
                'durable_vid.required' => '* กรุณากรอกข้อมูลให้ครบถ้วน',
                'durable_vid.unique' => '* เลขครุภัณฑ์นี้ถูกใช้งานไปแล้ว',

            ]
        );
        DB::beginTransaction();
        try {
            DB::table('com_service_list')->insert([
                'service_list_name' => $this->durable_type,
                'v_id' => $this->durable_vid,
            ]);
            $this->dispatch('close-modal');
            $this->durable_id = '';
            $this->durable_type = '';
            $this->durable_vid = '';
            DB::Commit();
            $this->dispatch('alert_success');
        } catch (Exception $e) {
            $this->durable_id = '';
            $this->durable_type = '';
            $this->durable_vid = '';
            DB::rollback();
            $this->dispatch('alert_error');
        }
    }

    public function EditDurable($id)
    {

        $this->durable_id = '';
        $this->durable_type = '';
        $data = DB::table('com_service_list')->where('service_list_id', $id)->first();
        $this->durable_type = $data->service_list_name;
        $this->durable_vid = $data->v_id;
        $this->durable_id = $data->service_list_id;
        $this->dispatch('show-modal-edit');
    }

    public function EditDurableData()
    {
        $this->validate(
            [
                'durable_type' => 'required',
                'durable_vid' => 'required|unique:com_service_list,v_id,' . $this->durable_id . ',service_list_id',
            ],
            [
                'durable_type.required' => '* กรุณากรอกข้อมูลให้ครบถ้วน',
                'durable_vid.required' => '* กรุณากรอกข้อมูลให้ครบถ้วน',
                'durable_vid.unique' => '* เลขครุภัณฑ์นี้ถูกใช้งานไปแล้ว',
            ]
        );

        DB::beginTransaction();
        try {
            DB::table('com_service_list')
                ->where('service_list_id', $this->durable_id)
                ->update(array(
                    'service_list_name' => $this->durable_type,
                    'v_id' => $this->durable_vid,
                ));
            $this->durable_id = '';
            $this->durable_type = '';
            $this->durable_vid = '';
            $this->dispatch('close-modal');
            DB::Commit();
            $this->dispatch('alert_success');
        } catch (Exception $e) {
            $this->durable_id = '';
            $this->durable_type = '';
            $this->durable_vid = '';
            DB::rollback();
            $this->dispatch('alert_error');
        }
    }
    public function DelDurable($id)
    {
        $data = DB::table('com_service_list')->where('service_list_id', $id)->first();
        $this->durable_type = $data->service_list_name;
        $this->durable_id = $data->service_list_id;
        $this->dispatch('al-del');
    }
    public function DelDurableData()
    {

        DB::beginTransaction();
        try {
            DB::table('com_service_list')->where('service_list_id', '=', $this->durable_id)->delete();
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
        $data = DB::table('com_service_list')->orderByDesc('service_list_id')->get();
        return view('livewire.setting.durable-service', ['data' => $data])->layout('livewire.setting.base')->title('ตั้งค่าปัญหาครุภัณฑ์');
    }
}
