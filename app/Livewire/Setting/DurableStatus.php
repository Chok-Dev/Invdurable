<?php

namespace App\Livewire\Setting;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DurableStatus extends Component
{
    protected $listeners = ['DeleteConfirm' => 'DelDurableData'];
    public $status_id, $status_name, $status_color,$status_edit_id;

    public function resetinput()
    {
        $this->status_id = '';
        $this->status_name = '';
        $this->status_color = '';
    }
    public function storeDurableData()
    {
        $this->validate(
            [
                'status_id' => 'required|unique:status,id',
                'status_name' => 'required',
            ],
            [
                'status_id.required' => '* กรุณากรอกข้อมูลให้ครบถ้วน',
                'status_id.unique' => '* ไอดีนี้ถูกใช้งานไปแล้ว',
                'status_name.required' => '* กรุณากรอกข้อมูลให้ครบถ้วน',
            ]
        );
        DB::beginTransaction();
        try {
            DB::table('status')->insert([
                'id' => $this->status_id,
                'status_name' => $this->status_name,
                'status_tag' => $this->status_color,
            ]);
            $this->dispatch('close-modal');
            $this->status_id = '';
            $this->status_name = '';
            $this->status_color = '';
            DB::Commit();
            $this->dispatch('alert_success');
        } catch (Exception $e) {
            $this->status_id = '';
            $this->status_name = '';
            $this->status_color = '';
            $this->dispatch('close-modal');
            DB::rollback();
            $this->dispatch('alert_error');
        }
    }

    public function EditDurable($id)
    {

        $this->status_id = '';
        $this->status_name = '';
        $this->status_color = '';
        $data = DB::table('status')->where('id', $id)->first();
        $this->status_id = $data->id;
        $this->status_edit_id = $data->id;
        $this->status_name = $data->status_name;
        $this->status_color = $data->status_tag;
        $this->dispatch('show-modal-edit');
    }

    public function EditDurableData()
    {
        $this->validate(
            [
                'status_id' => 'required|unique:status,id,' . $this->status_edit_id . '',
                'status_name' => 'required',
            ],
            [
                'status_id.required' => '* กรุณากรอกข้อมูลให้ครบถ้วน',
                'status_id.unique' => '* ไอดีนี้ถูกใช้งานไปแล้ว',
                'status_name.required' => '* กรุณากรอกข้อมูลให้ครบถ้วน',
            ]
        );

        DB::beginTransaction();
        try {
            DB::table('status')
                ->where('id', $this->status_edit_id)
                ->update(array(
                    'id' => $this->status_id,
                    'status_name' => $this->status_name,
                    'status_tag' => $this->status_color,
                ));
            $this->status_id = '';
            $this->status_name = '';
            $this->status_color = '';
            $this->dispatch('close-modal');
            DB::Commit();
            $this->dispatch('alert_success');
        } catch (Exception $e) {
            $this->status_id = '';
            $this->status_name = '';
            $this->status_color = '';
            $this->dispatch('close-modal');
            DB::rollback();
            $this->dispatch('alert_error');
        }
    }
    public function DelDurable($id)
    {
        $data = DB::table('status')->where('id', $id)->first();
        $this->status_id = $data->id;
        $this->dispatch('al-del');
    }
    public function DelDurableData()
    {

        DB::beginTransaction();
        try {
            DB::table('status')->where('id', '=', $this->status_id)->delete();
            $this->status_id = '';
            $this->status_name = '';
            $this->status_color = '';
            DB::Commit();
            $this->dispatch('alert_success');
        } catch (Exception $e) {
            $this->status_id = '';
            $this->status_name = '';
            $this->status_color = '';
            DB::rollback();
            $this->dispatch('alert_error');
        }
    }




    public function render()
    {
        $title = 'ลบครุภัณฑ์!';
        $text = "คุณแน่ใจที่จะลบหรือไหม?";
        confirmDelete($title, $text);
        $data = DB::table('status')->orderByDesc('id')->get();
        return view('livewire.setting.durable-status', ['data' => $data])->layout('livewire.setting.base')->title('สถานะดำเนินการ');
    }
}
