<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class DurableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function pdf($id)
    {

        $d = DB::table('durable_goods')
            ->select('durable_goods.*', 'inv_dep.*', 'com_type.*')
            ->leftJoin('com_type', 'durable_goods.com_type_id', '=', 'com_type.com_type_id')
            ->leftJoin('inv_dep', 'durable_goods.inv_dep_id', '=', 'inv_dep.inv_dep_id')
            ->where('durable_goods.id', $id)
            ->get();
        /* dd($d); */
        $data = [
            'data' => $d
        ];

        $pdf = PDF::loadView('admin.qrcode', $data, [], [
            'mode' => 'utf-8', 'format' => [60, 23],
            'margin_left' => 2,
            'margin_right' => 0,
            'margin_top' => 3,
            'margin_bottom' => 2,

        ]);

        return $pdf->stream("$id.pdf");
    }
    public function index()
    {
        $comtype = DB::table('com_type')
            ->select('*')
            ->get();
        $invdep = DB::table('inv_dep')
            ->select('inv_dep_id', 'inv_dep_name')
            ->get();
        $d = DB::table('durable_goods')
            ->select('durable_goods.*', 'inv_dep.*', 'com_type.*')
            ->leftJoin('com_type', 'durable_goods.com_type_id', '=', 'com_type.com_type_id')
            ->leftJoin('inv_dep', 'durable_goods.inv_dep_id', '=', 'inv_dep.inv_dep_id')
            ->get();
        $title = 'ลบครุภัณฑ์!';
        $text = "คุณแน่ใจที่จะลบหรือไหม?";
        confirmDelete($title, $text);
        return view('admin.durables')->with('comtype', $comtype)->with('invdep', $invdep)->with('data', $d);
    }

    public function durables_qrcode()
    {

        $d = DB::table('durable_goods')
            ->select('durable_goods.*', 'inv_dep.inv_dep_name', 'com_type.*')
            ->leftJoin('com_type', 'durable_goods.com_type_id', '=', 'com_type.com_type_id')
            ->leftJoin('inv_dep', 'durable_goods.inv_dep_id', '=', 'inv_dep.inv_dep_id')->get();
        return view('admin.durables_qrcode')->with('data', $d);
    }

    public function daruble_edit(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = DB::table('durable_goods')
                ->where('id', $request->eid)
                ->update(array(
                    'durable_name' => $request->ename,
                    'durable_id' => $request->ecommoid,
                    'year_received' => $request->eyear,
                    'anydesk_ip' => $request->eip,
                    'com_type_id' => $request->ecomtype,
                    'inv_dep_id' => $request->ebuild,

                ));
            DB::Commit();
            alert()->success('สำเร็จ', 'บันทึกข้อมูลสำเร็จ.');
            return redirect()->route('durables');
        } catch (Exception $e) {
            DB::rollback();
            alert()->error('ไม่สำเร็จ', 'บันทึกข้อมูลไม่สำเร็จ.');
            return redirect()->route('durables');
        }
    }
    public function daruble_add(Request $request)
    {
        request()->validate(
            [
                'commoid' => 'unique:durable_goods,durable_id', //required|unique:commodities,durable_name
            ],
            [
                // 'name.required' => '* กรุณาใส่ชื่อเครื่อง',
                'commoid.unique' => '* เลขครุภัณฑ์ถูกใช้งานไปแล้ว',
            ]
        );


        DB::beginTransaction();
        try {
            DB::table('durable_goods')->insert([
                'id' => $request->id,
                'durable_name' => $request->name,
                'year_received' => $request->year,
                'durable_id' => $request->commoid ?? "-",
                'anydesk_ip' => $request->ip,
                'com_type_id' => $request->comtype,
                'inv_dep_id' => $request->build
            ]);
            DB::Commit();
            alert()->success('สำเร็จ', 'บันทึกข้อมูลสำเร็จ.');
            return redirect()->route('durables');
        } catch (Exception $e) {
            DB::rollback();
            alert()->error('ไม่สำเร็จ', 'บันทึกข้อมูลไม่สำเร็จ.');
            return redirect()->route('durables');
        }
    }

    /* DB::table('users')->where('votes', '>', 100)->delete(); */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            DB::table('durable_goods')->where('id', '=', $id)->delete();
            DB::Commit();
            alert()->success('สำเร็จ', 'ลบข้อมูลสำเร็จ.');
            return redirect()->route('durables');
        } catch (Exception $e) {
            DB::rollback();
            alert()->error('ไม่สำเร็จ', 'ลบข้อมูลไม่สำเร็จ.');
            return redirect()->route('durables');
        }
    }
}
