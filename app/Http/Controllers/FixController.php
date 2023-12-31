<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Phattarachai\LineNotify\Facade\Line;

class FixController extends Controller
{
    public function index()
    {
        $data = DB::table('durable_fix')
            ->leftJoin('durable_goods', 'durable_fix.com_id', '=', 'durable_goods.id')
            ->leftJoin('status', 'durable_fix.status_id', '=', 'status.id')
            ->leftJoin('inv_dep', 'durable_goods.inv_dep_id', '=', 'inv_dep.inv_dep_id')
            ->leftJoin('com_service_list', 'durable_fix.service_list_id', '=', 'com_service_list.service_list_id')
            ->select('com_service_list.service_list_name', 'durable_goods.*', 'durable_fix.*', 'status.*', 'inv_dep.inv_dep_name')->orderBy('durable_fix.id', 'DESC')
            ->get();
        return view('repair')->with('data', $data);
    }
    public function index2($id)
    {
        $data = DB::table('durable_fix')
            ->leftJoin('durable_goods', 'durable_fix.com_id', '=', 'durable_goods.id')
            ->leftJoin('status', 'durable_fix.status_id', '=', 'status.id')
            ->leftJoin('inv_dep', 'durable_goods.inv_dep_id', '=', 'inv_dep.inv_dep_id')
            ->leftJoin('com_service_list', 'durable_fix.service_list_id', '=', 'com_service_list.service_list_id')
            ->select('com_service_list.service_list_name', 'durable_goods.*', 'durable_fix.*', 'status.*', 'inv_dep.inv_dep_name')->orderBy('durable_fix.id', 'DESC')
            ->get();
        return view('repair2')->with('data', $data)->with('id', $id);
    }
    public function fix(Request $request)
    {
        request()->validate(
            [
                'username' => 'required', //|exists:pgsql.officer,officer_login_name
                'solu' => 'required',
                'tel' => 'required',
            ],
            [
                'username.required' => '* กรุณาใส่ชื่อของคุณ',
                //'username.exists' => '* ไม่พบชื่อผู้ใช้นี้',
                'solu.required' => '* กรุณาใส่ปัญหา หรือ อาการที่พบ',
                'tel.required' => '* กรุณาใส่เบอร์ติดต่อ',
            ]
        );

       /*  DB::beginTransaction();
        try { */
            $ser = DB::table('com_service_list')->where('service_list_id', '=', $request->service)->first();
            $commo = DB::table('durable_goods')
            ->leftJoin('inv_dep','durable_goods.inv_dep_id','=','inv_dep.inv_dep_id')
            ->where('durable_goods.id', '=', $request->id)->first();
/* dd($commo); */
            /* $user = DB::connection('pgsql')->table('opduser')
                ->leftJoin('officer', 'opduser.loginname', '=', 'officer.officer_login_name')
                ->leftJoin('doctor', 'doctor.code', '=', 'officer.officer_doctor_code')
                ->leftJoin('emp', 'emp.emp_cid', '=', 'doctor.cid')
                ->where('opduser.loginname', $request->username)
                ->where('doctor.active', 'Y')
                ->whereNotNull('emp.emp_id')
                ->whereNotNull('officer.officer_doctor_code')
                ->select('doctor.name', 'opduser.loginname', 'emp.emp_id', 'emp.emp_dep_id')->first(); */
            $user = DB::connection('pgsql')->table('doctor')
                ->select('opduser.loginname','emp.emp_id', 'doctor.name','emp.emp_dep_id')
                ->leftJoin('emp', 'doctor.cid', '=', 'emp.emp_cid')
                ->leftJoin('opduser', 'doctor.code', '=', 'opduser.doctorcode')
                ->where('doctor.active', '=', 'Y')
                ->whereNotNull('doctor.code')
                ->whereNotNull('emp.emp_id')
                ->where('opduser.loginname', $request->username)
                ->where('opduser.account_disable', '=', 'N')
                ->first();

            /* dd($user);  */
            $com = DB::connection('pgsql')->table('inv_durable_good')
                ->where('inv_durable_good_code', ($commo->durable_id == "-") ? $ser->v_id : $commo->durable_id)
                ->select('inv_durable_good_id','inv_durable_good_code')->first();

            $number = DB::connection('pgsql')->table('inv_durable_good_repair')
                ->select('inv_durable_good_repair_id')->latest('inv_durable_good_repair_id')->first();

/* dd($com); */
            Line::send("
เลขครุภัณฑ์: $com->inv_durable_good_code
ชื่อผู้แจ้ง: $user->name
หน่วยงาน: $commo->inv_dep_name
เบอร์ติดต่อ: $request->tel
สาเหตุ: $request->solu
วันที่แจ้ง: ".date("Y-m-d H:i:s"));

            $hosxpid = (int) $number->inv_durable_good_repair_id + 1;

            DB::connection('pgsql')->table('inv_durable_good_repair')->insert([
                'inv_durable_good_repair_id' => $hosxpid,
                'inv_durable_good_id' => $com->inv_durable_good_id,
                'inv_durable_rate_after_coment' => 'web',
                'inv_durable_good_repair_date' => date("Y-m-d"),
                'last_update' => date("Y-m-d"),
                'emp_id' =>  $user->emp_id,
                'emp_dep_id' =>  $user->emp_dep_id,
                'inv_durable_good_repair_staff' => $user->loginname,
                'inv_dep_id' => $commo->inv_dep_id,
                'inv_durable_good_repair_tel' => $request->tel,
                'inv_durable_good_repair_cause' => $request->solu,
                'inv_durable_return_status' => 'N',
                'inv_durable_good_repair_dep_id' => 2,
            ]);


            $savedata = DB::table('durable_fix')->insert([
                'hos_repiar_id' => $hosxpid,
                'solution' => $request->solu,
                'com_id' => $request->id,
                'repair_by_id' =>  $user->emp_id,
                'service_list_id' => $request->service,
                'name' => $user->name,
                'tel_number' => $request->tel,
                'status_id' => 6,
                'created_at' => date("Y-m-d H:i:s"),
            ]);
            if ($savedata) {

                DB::commit();
                alert()->success('สำเร็จ', 'บันทึกข้อมูลสำเร็จ.');
            } else {
                alert()->error('ไม่สำเร็จ', 'บันทึกข้อมูลไม่สำเร็จ.');
            }
            return redirect()->route('fix');
       /*  } catch (\Exception $ex) {
            DB::rollback();
            alert()->error('ไม่สำเร็จ', 'บันทึกข้อมูลไม่สำเร็จ.');
            return redirect()->route('fix');
        } */
    }
}
