<?php

namespace App\Livewire\Admin;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Durables extends Component
{
    public $comtype,$invdep;
    public $durable_id,$durable_name,$durable_code,$durable_type,$durable_year,$durable_anydesk,$durable_dep;

    public function reinput(){
        /* $this->durable_id=""; */
        $this->durable_name="";
        $this->durable_code="";
        $this->durable_type="";
        $this->durable_year="";
        $this->durable_anydesk="";
        $this->durable_dep="";
    }
    public function DurableAdd(){
        
        $this->validate(
            [
                'durable_code' => 'unique:durable_goods,durable_id', //required|unique:commodities,durable_name
            ],
            [
                // 'name.required' => '* กรุณาใส่ชื่อเครื่อง',
                'durable_code.unique' => '* เลขครุภัณฑ์ถูกใช้งานไปแล้ว',
            ]
        );
        DB::beginTransaction();
        try {
            DB::table('durable_goods')->insert([
                'id' => $this->durable_id,
                'durable_name' => $this->durable_name,
                'year_received' => $this->durable_year,
                'durable_id' => $this->durable_code ?? "-",
                'anydesk_ip' => $this->durable_anydesk,
                'com_type_id' => $this->durable_type,
                'inv_dep_id' => $this->durable_dep
            ]);
            DB::Commit();
            $this->dispatch('close-modal');
            $this->dispatch('alert_success');
            $this->reinput();
        } catch (Exception $e) {
            DB::rollback();
            $this->dispatch('close-modal');
            $this->dispatch('alert_error');
            $this->reinput();
        }
       
    }
    public function mount()
    {
        $this->durable_id= IdGenerator::generate(['table' => 'durable_goods', 'length' => 10, 'prefix' => 'COM']);
        $this->comtype = DB::table('com_type')
            ->select('*')
            ->get();
        $this->invdep = DB::table('inv_dep')
            ->select('inv_dep_id', 'inv_dep_name')
            ->get();
    }
    public function boot()
    {
        $this->dispatch('datatable');
    }
    public function render()
    {
        $d = DB::table('durable_goods')
            ->select('durable_goods.*', 'inv_dep.*', 'com_type.*')
            ->leftJoin('com_type', 'durable_goods.com_type_id', '=', 'com_type.com_type_id')
            ->leftJoin('inv_dep', 'durable_goods.inv_dep_id', '=', 'inv_dep.inv_dep_id')
            ->get();
        return view('livewire.admin.durables', ['data' => $d])->layout('livewire.admin.base');
    }
}
