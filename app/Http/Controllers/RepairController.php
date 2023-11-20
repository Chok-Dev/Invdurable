<?php

namespace App\Http\Controllers;


use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RepairController extends Controller
{
    public function index()
    {
        
        $title = 'ลบรายการแจ้งซ่อม!';
        $text = "คุณแน่ใจที่จะลบหรือไหม?";
        confirmDelete($title, $text);
        $data = DB::table('durable_fix')
            ->leftJoin('durable_goods', 'durable_fix.com_id', '=', 'durable_goods.id')
            ->leftJoin('status', 'durable_fix.status_id', '=', 'status.id')
            ->leftJoin('inv_dep', 'durable_goods.inv_dep_id', '=', 'inv_dep.inv_dep_id')
            ->leftJoin('com_service_list', 'durable_fix.service_list_id', '=', 'com_service_list.service_list_id')
            ->leftJoin('com_type', 'durable_goods.com_type_id', '=', 'com_type.com_type_id')
            ->leftJoin('durable_engineer', 'durable_fix.repair_by_id', '=', 'durable_engineer.id')
            ->select('durable_engineer.engineer_name','com_type.*', 'com_service_list.service_list_name', 'durable_goods.*', 'durable_fix.*', 'status.id as status_id', 'status.status_name', 'status.status_tag', 'inv_dep.inv_dep_name')->orderBy('durable_fix.id', 'DESC')
            ->get();
        //dd($data);
        return view('admin.durables_repair')->with('data', $data);
    }
    public function indexHosxp()
    {
        
        $title = 'ลบรายการแจ้งซ่อม!';
        $text = "คุณแน่ใจที่จะลบหรือไหม?";
        confirmDelete($title, $text);
        $data = DB::connection('pgsql')->table('inv_durable_good_repair')
        ->select('inv_durable_good_repair.inv_durable_good_repair_desc','ad.emp_last_name as adminlname','ad.emp_first_name as adminfname','inv_durable_good_repair.inv_durable_good_rstatus_id','inv_durable_good_repair.inv_durable_good_evl_type_id','inv_durable_good_repair.inv_durable_good_apprv_emp_id','inv_durable_good_repair.inv_durable_good_eval_emp_id','inv_durable_good_repair.inv_durable_rate_after_point','inv_durable_good_repair.inv_durable_rate_after_emp_id','inv_durable_good_repair.inv_durable_good_repair_id','inv_durable_good.inv_durable_good_code', 'inv_durable_good_repair_status.inv_durable_good_rstatus_name', 'inv_durable_good_desc.inv_durable_good_desc_name', 'inv_durable_good_kind.inv_durable_good_kind_name', 'inv_durable_good_repair.inv_durable_good_repair_cause', 'emp.emp_first_name', 'emp.emp_last_name', 'inv_durable_good_repair.inv_durable_good_repair_tel', 'inv_dep.inv_dep_name', 'inv_durable_good_repair.inv_durable_good_repair_date')
        ->leftJoin('inv_durable_good_repair_dep','inv_durable_good_repair_dep.inv_durable_good_repair_dep_id','=','inv_durable_good_repair.inv_durable_good_repair_dep_id')
        ->leftJoin('inv_durable_good','inv_durable_good.inv_durable_good_id','=','inv_durable_good_repair.inv_durable_good_id')
        ->leftJoin('inv_durable_good_kind','inv_durable_good_kind.inv_durable_good_kind_id','=','inv_durable_good.inv_durable_good_kind_id')
        ->leftJoin('inv_durable_good_desc','inv_durable_good_desc.inv_durable_good_desc_id','=','inv_durable_good.inv_durable_good_desc_id')
        ->leftJoin('emp','inv_durable_good_repair.emp_id','=','emp.emp_id')
        ->leftJoin('emp as ad','inv_durable_good_repair.inv_durable_good_eval_emp_id','=','ad.emp_id')
        ->leftJoin('inv_dep','inv_durable_good_repair.inv_dep_id','=','inv_dep.inv_dep_id')
        ->leftJoin('inv_durable_good_repair_status','inv_durable_good_repair_status.inv_durable_good_rstatus_id','=','inv_durable_good_repair.inv_durable_good_rstatus_id')
        ->whereNotIn('inv_durable_good_repair.inv_durable_rate_after_coment', ['web'])
        ->orWhere('inv_durable_good_repair.inv_durable_rate_after_coment','=',null)
        ->where('inv_durable_good_repair.inv_durable_good_repair_dep_id','=',2)
        ->orderBy('inv_durable_good_repair.inv_durable_good_repair_id','desc')
        ->get();
        /* dd($data); */
        return view('admin.durables_repair_hosxp')->with('data', $data);
    }
    public function updateRepair(Request $request)
    {
        DB::beginTransaction();
        try {
            DB::connection('pgsql')->table('inv_durable_good_repair')->where('inv_durable_good_repair_id', $request->repair_id)->update([
                'inv_durable_good_evl_type_id' => $request->evaluate_status, //ประเมินซ่อม
                'inv_durable_good_repair_emp_id' => $request->evaluate,
                'inv_durable_good_rep_sec_id' => 19, //ประเภท คอม
                'inv_durable_good_apprv_emp_id' => $request->evaluate, //ผู้อนุมัติ
                'inv_durable_good_eval_emp_id' =>  $request->evaluate, //ผุ้ประเมิน
                'inv_durable_good_rstatus_id' => $request->status, //สถานะ
                'inv_durable_rate_after_point' => $request->score,
                'inv_durable_rate_after_emp_id' => $request->username,
                'inv_durable_good_repair_desc' => $request->detail,
                'inv_durable_good_rep_eval_day' => 1,
                'inv_durable_rate_after_coment' => 'web',
                'inv_durable_rate_after_date' => date("Y-m-d"),
                'inv_durable_good_rep_sum_date' => date("Y-m-d"),
                'inv_durable_good_apprv_date' => date("Y-m-d"),
            ]);
            //inv_durable_good_repair_desc

            $data = DB::table('durable_fix')->where('id',  $request->id)->first();
            if (!empty($request->signed)) {
                $image_parts = explode(";base64,", $request->signed);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $file = uniqid() . time() . '.' . $image_type;

                if (!empty($data->signed)) {
                    Storage::disk('public')->delete("/signed/" . $data->signed);
                }
            }

            DB::table('durable_fix')
                ->where('id', $request->id)
                ->update([
                    'help_evl_type_id' => $request->evaluate_status,
                    'help_apprv_emp_id' => $request->evaluate,
                    'status_id' => $request->status,
                    'signed' => $file ?? $data->signed,
                    'inv_durable_rate_after_point' => $request->score,
                    'inv_durable_rate_after_emp_id' => $request->username,
                    'help_detail' => $request->detail,
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);

            if (!empty($request->signed)) {
                Storage::disk('public')->put('/signed/' . $file, $image_base64);
            }

            alert()->success('สำเร็จ', 'บันทึกข้อมูลสำเร็จ.');
            DB::Commit();
            return redirect()->route('repair');
        } catch (Exception $e) {
            DB::rollback();
            alert()->error('ไม่สำเร็จ', 'บันทึกข้อมูลไม่สำเร็จ.');
            return redirect()->route('repair');
        }
    }

    public function updateRepairHosxp(Request $request)
    {
        DB::beginTransaction();
        try {
            DB::connection('pgsql')->table('inv_durable_good_repair')->where('inv_durable_good_repair_id', $request->repair_id)->update([
                'inv_durable_good_evl_type_id' => $request->evaluate_status, //ประเมินซ่อม
                'inv_durable_good_repair_emp_id' => $request->evaluate,
                'inv_durable_good_rep_sec_id' => 19, //ประเภท คอม
                'inv_durable_good_apprv_emp_id' => $request->evaluate, //ผู้อนุมัติ
                'inv_durable_good_eval_emp_id' =>  $request->evaluate, //ผุ้ประเมิน
                'inv_durable_good_rstatus_id' => $request->status, //สถานะ
                'inv_durable_rate_after_point' => $request->score,
                'inv_durable_rate_after_emp_id' => $request->username,
                'inv_durable_good_repair_desc' => $request->detail,
                'inv_durable_good_rep_eval_day' => 1,
                'inv_durable_rate_after_date' => date("Y-m-d"),
                'inv_durable_good_rep_sum_date' => date("Y-m-d"),
                'inv_durable_good_apprv_date' => date("Y-m-d"),
            ]);
            alert()->success('สำเร็จ', 'บันทึกข้อมูลสำเร็จ.');
            DB::Commit();
            return redirect()->route('repair_hosxp');
        } catch (Exception $e) {
            DB::rollback();
            alert()->error('ไม่สำเร็จ', 'บันทึกข้อมูลไม่สำเร็จ.');
            return redirect()->route('repair_hosxp');
        }
    }
    public function DelRepair($id)
    {
        DB::beginTransaction();
        try {
            $dadel = DB::table('durable_fix')->where('id',  $id)->first();
            DB::connection('pgsql')->table('inv_durable_good_repair')->where('inv_durable_good_repair_id', '=', $dadel->hos_repiar_id)->delete();
            DB::table('durable_fix')->where('id', '=', $id)->delete();
            DB::Commit();
            if (!empty($dadel->signed)) {
                Storage::disk('public')->delete("/signed/" . $dadel->signed);
            }
            alert()->success('สำเร็จ', 'ลบข้อมูลสำเร็จ.');
            return redirect()->route('repair');
        } catch (Exception $e) {
            DB::rollback();
            alert()->error('ไม่สำเร็จ', 'ลบข้อมูลไม่สำเร็จ.');
            return redirect()->route('repair');
        }
    }
    public function DelRepair2($id)
    {
        DB::beginTransaction();
        try {
            DB::connection('pgsql')->table('inv_durable_good_repair')->where('inv_durable_good_repair_id', '=', $id)->delete();
         
            DB::Commit();
           
            alert()->success('สำเร็จ', 'ลบข้อมูลสำเร็จ.');
            return redirect()->route('repair');
        } catch (Exception $e) {
            DB::rollback();
            alert()->error('ไม่สำเร็จ', 'ลบข้อมูลไม่สำเร็จ.');
            return redirect()->route('repair');
        }
    }
}
