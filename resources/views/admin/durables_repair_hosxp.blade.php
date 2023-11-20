@extends('layouts.layout');

@section('title')
    จัดการแจ้งซ่อม (Hosxp)
@endsection

@section('header')
    จัดการแจ้งซ่อม (Hosxp)
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" /> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.dataTables.min.css" />
    {{-- @livewireStyles --}}
@endsection

@section('body')
    @include('sweetalert::alert')
    <div class="d-flex justify-content-end align-items-center mb-4" id="tt">

    </div>
    <div class="card">
        <h5 class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-primary fw-bold">
                    จัดการแจ้งซ่อม (Hosxp)
                </div>
            </div>
        </h5>
        <div class="card-body">
            <div class="d-inline-flex  mb-3" id="userstable_filter">
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered text-start table-striped" id="datatable250">
                    <thead>
                        <tr class="text-nowrap">
                            <th class="text-center">ลำดับ</th>
                            <th class="text-center">จัดการ</th>
                            <th class="text-center">สถานะ</th>
                            <th class="text-center">หน่วยงาน</th>
                            <th class="text-center">เบอร์</th>
                            <th class="text-center">สาเหตุ</th>
                            <th class="text-center">ประเภท</th>
                            <th class="text-center">ผู้ซ่อม</th>
                            <th class="text-center">วันที่แจ้ง</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $value)
                            <tr class="text-nowrap">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button class="name-button btn btn-info  btn-sm" data-bs-toggle="modal"
                                            data-repair_id="{{ $value->inv_durable_good_repair_id }}"
                                            data-bs-target="#exampleModal"
                                            data-name="{{ $value->inv_durable_good_repair_id }}"
                                            data-id="{{ $value->inv_durable_good_code }}"
                                            data-comid="{{ $value->inv_durable_good_code }}"
                                            data-evl_type="{{ $value->inv_durable_good_evl_type_id }}"
                                            data-apprv_emp_id="{{ $value->inv_durable_good_apprv_emp_id }}"
                                            data-status="{{ $value->inv_durable_good_rstatus_id }}"
                                            data-score="{{ $value->inv_durable_rate_after_point }}"
                                            data-rate="{{ $value->inv_durable_rate_after_emp_id }}"
                                            data-detail="{{ $value->inv_durable_good_repair_desc }}">ประเมิน
                                        </button>
                                        <a href="{{ route('DelRepair2', $value->inv_durable_good_repair_id) }}"
                                            class="btn btn-danger btn-sm" data-confirm-delete="true">ลบ</a>
                                    </div>
                                </td>
                                <td class="text-center"><span
                                        class="badge 
                                    @if ($value->inv_durable_good_rstatus_name == '') bg-label-dark
                                    @elseif ($value->inv_durable_good_rstatus_name == 'รับเรื่องแล้ว')
                                    bg-label-primary
                                    @elseif ($value->inv_durable_good_rstatus_name == 'แทงชำรุด')
                                    bg-label-danger
                                    @elseif ($value->inv_durable_good_rstatus_name == 'ส่งภายนอก')
                                    bg-label-warning
                                    @elseif ($value->inv_durable_good_rstatus_name == 'กำลังดำเนินการซ่อม')
                                    bg-label-info
                                    @elseif ($value->inv_durable_good_rstatus_name == 'ซ่อมเรียบร้อย')
                                    bg-label-success @endif">
                                        @if ($value->inv_durable_good_rstatus_name == '')
                                            รอรับเรื่อง
                                        @else
                                            {{ $value->inv_durable_good_rstatus_name }}
                                        @endif
                                    </span>

                                </td>
                                <td class="text-center">{{ $value->inv_dep_name }}</td>
                                <td class="text-center">{{ $value->inv_durable_good_repair_tel }}</td>

                                <td>{{ $value->inv_durable_good_repair_cause }}</td>
                                <td class="text-center">{{ $value->inv_durable_good_desc_name }}</td>
                                {{-- <td class="user-select-all">{{ $value->anydesk_ip }}</td> --}}
                                <td class="text-center">{{ $value->adminfname }} {{ $value->adminlname }}</td>
                                <td class="text-center">
                                    {{ Carbon\Carbon::parse($value->inv_durable_good_repair_date)->thaidate('j M y') }}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @php(
    $en = DB::connection('pgsql')->table('emp')->where('emp_department_id', 39)->where('emp_status_id', 2)->select('emp_id', 'emp_dep_id', 'emp_first_name', 'emp_last_name')->get())
    @php(
    $eval = DB::connection('pgsql')->table('inv_durable_good_evl_type')->get())
    @php(
    $username = $username = DB::connection('pgsql')->table('doctor')
        ->select('emp.emp_id', 'doctor.name')
        ->leftJoin('emp','doctor.cid','=','emp.emp_cid')
        ->leftJoin('opduser','doctor.code','=','opduser.doctorcode')
        ->where('doctor.active','=','Y')
        ->whereNotNull('doctor.code')
        ->whereNotNull('emp.emp_id')
        ->where('opduser.account_disable','=','N')
        ->get()) {{-- emp id --}}
    <div class="modal fade" data-bs-backdrop="static" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">แจ้งซ่อม</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="" action="{{ route('updateRepairHosxp') }}" method="POST">
                        @csrf
                        @method('post')
                        <div class="form-floating">
                            <input type="hidden" name="repair_id" class="form-control" id="repair_id" placeholder=""
                                value="">
                            <input type="hidden" name="id" class="form-control" id="id" placeholder=""
                                value="">
                        </div>
                        <div class="divider">
                            <div class="divider-text">
                                สำหรับช่าง
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="apparv_emp" name="evaluate"
                                aria-label="Floating label select example">
                                <option value=""></option>
                                @foreach ($en as $een)
                                    <option value="{{ $een->emp_id }}">{{ $een->emp_first_name }}
                                        {{ $een->emp_last_name }}</option>
                                @endforeach
                            </select>
                            <label for="apparv_emp">ประเมินซ่อม (ช่างซ่อม)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="eval" name="evaluate_status"
                                aria-label="Floating label select example">
                                <option value=""></option>
                                @foreach ($eval as $eeval)
                                    <option value="{{ $eeval->inv_durable_good_evl_type_id }}">
                                        {{ $eeval->inv_durable_good_evl_type_name }}</option>
                                @endforeach
                            </select>
                            <label for="apparv_emp">ประเมินซ่อม (ช่างซ่อม)</label>

                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="status" name="status"
                                aria-label="Floating label select example">
                                {{ $sta = DB::connection('pgsql')->table('inv_durable_good_repair_status')->get() }}
                                <option value="">
                                    -
                                </option>
                                @foreach ($sta as $status)
                                    <option value="{{ $status->inv_durable_good_rstatus_id }}">{{ $status->inv_durable_good_rstatus_name }}</option>
                                @endforeach
                            </select>
                            <label for="status">สถานะส่งซ่อม (ช่างซ่อม)</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="ไม่บังคับ" name="detail" id="detail" style="height: 100px"></textarea>
                            <label for="status">รายละเอียด/หมายเหตุ (ช่างซ่อม)</label>
                        </div>

                        <div class="divider">
                            <div class="divider-text">
                                สำหรับผู้แจ้ง
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="username" name="username"
                                aria-label="Floating label select example">
                                <option value="">
                                    -
                                </option>
                                @foreach ($username as $usernames)
                                    <option value="{{ $usernames->emp_id }}"
                                        {{ old('username') == $usernames->emp_id ? 'selected' : '' }}>
                                        {{ $loop->iteration }}.) {{ $usernames->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="username">ประเมินการซ่อม (สำหรับผู้แจ้งซ่อม)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="score" name="score"
                                aria-label="Floating label select example">
                                <option value="">
                                    -
                                </option>
                                <option value="1" {{ old('score') == 1 ? 'selected' : '' }}>
                                    ปรับปรุง
                                </option>
                                <option value="2" {{ old('score') == 2 ? 'selected' : '' }}>
                                    พอใช้
                                </option>
                                <option value="3" {{ old('score') == 3 ? 'selected' : '' }}>
                                    ปานกลาง
                                </option>
                                <option value="4" {{ old('score') == 4 ? 'selected' : '' }}>
                                    ดี
                                </option>
                                <option value="5" {{ old('score') == 5 ? 'selected' : '' }}>
                                    ดีมาก
                                </option>
                            </select>
                            <label for="floatingSelect">คะแนน (สำหรับผู้แจ้งซ่อม)</label>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>

                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    {{-- <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script> --}}

    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.bootstrap5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#username').select2({
                dropdownParent: $('#exampleModal'),
                theme: 'bootstrap-5',
            });
            $(".name-button").click(function(event) {
                $('.modal-header h1.modal-title').html("แก้ไข " + $(this).attr('data-comid'));
                $('#id').val($(this).attr('data-id'));
                $('#status').val($(this).attr('data-status'));
                $('#repair_id').val($(this).attr('data-repair_id'));
                $('#eval').val($(this).attr('data-evl_type'));
                $('#detail').val($(this).attr('data-detail'));
                $('#apparv_emp').val($(this).attr('data-apprv_emp_id'));
                $('#score').val($(this).attr('data-score'));
                $('#username').val($(this).attr('data-rate')).trigger('change');
            });
            $('#datatable250').DataTable({
                    fixedColumns: {
                        left: 2
                    },
                    stateSave: true,
                    "stateSaveParams": function(settings, data) {
                        data.search.search = "";
                    },
                    stateSaveCallback: function(settings, data) {
                        localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data))
                    },
                    stateLoadCallback: function(settings) {
                        return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance))
                    },
                    initComplete: function() {
                        this.api()
                            .columns([2, 3, 6, 7])
                            .every(function() {
                                var column = this;
                                var select = $(
                                    '<select class="form-select fter mx-2"><option value="">' +
                                    column
                                    .header().textContent + ' (ทั้งหมด)</option></select>'
                                ).appendTo('#userstable_filter').on('change',
                                    function() {
                                        column.search($(this).val()).draw();
                                    });

                                column
                                    .data()
                                    .unique()
                                    .sort()
                                    .each(function(d, j) {
                                        select.append('<option>' + d + '</option>');
                                    });
                            });
                        var bt = $('<button class="btn btn-primary">รีเซ็ต</button>').appendTo(
                            '#userstable_filter').on('click',
                            function() {
                                $('.fter').val('');
                                var table = $('#datatable250').DataTable();
                                table.search('').columns().search('').draw();

                            });
                    },
                    "language": {
                        "sProcessing": "กำลังดำเนินการ...",
                        "sLengthMenu": "แสดง_MENU_ แถว",
                        "sZeroRecords": "ไม่พบข้อมูล",
                        "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                        "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                        "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                        "sInfoPostFix": "",
                        "sSearch": "ค้นหา:",
                        "sUrl": "",
                        "oPaginate": {
                            "sFirst": "เริ่มต้น",
                            "sPrevious": "ก่อนหน้า",
                            "sNext": "ถัดไป",
                            "sLast": "สุดท้าย"
                        }
                    },
                    "dom": "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                    "buttons": [{
                            "extend": 'copy',
                            "charset": 'utf-8',
                            "className": 'btn btn-dark'
                        },
                        {
                            "extend": 'excel',
                            "exportOptions": {
                                "stripHtml": false,
                                'columns': [0, 2, 3, 4, 5, 6, 7, 8]

                            },
                            "charset": 'utf-8',
                            "className": 'btn btn-dark'
                        },
                        {
                            "extend": 'print',
                            "exportOptions": {
                                "stripHtml": false,
                                'columns': [0, 2, 3, 4, 5, 6, 7, 8]

                            },
                            "charset": 'utf-8',
                            "className": 'btn btn-dark'
                        },

                    ]

                }).buttons()
                .container()
                .appendTo("#tt");

        });
    </script>
@endsection
