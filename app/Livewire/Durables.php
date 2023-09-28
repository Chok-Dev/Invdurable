<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Durables extends Component
{
    public $comtype =  "";
    public $invdep = "";

   /*  public function mount(){
        $this->comtype = DB::table('com_type')->select('*')->get();
        $this->invdep = DB::table('inv_dep')->select('inv_dep_id', 'inv_dep_name')->get();
    } */
    public function test($id){
        dd($id);
    }
    public function render()
    {
        $d = DB::table('durable_goods')
            ->select('durable_goods.*', 'inv_dep.*', 'com_type.*')
            ->leftJoin('com_type', 'durable_goods.com_type_id', '=', 'com_type.COM_TYPE_ID')
            ->leftJoin('inv_dep', 'durable_goods.inv_dep_id', '=', 'inv_dep.inv_dep_id')
            ->get();
            $title = 'ลบครุภัณฑ์!';
            $text = "คุณแน่ใจที่จะลบหรือไหม?";
            confirmDelete($title, $text);
        return view('livewire.durables')->with('data', $d);
    }
}
