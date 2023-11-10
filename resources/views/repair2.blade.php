@extends('layouts.layout');

@section('title')
    แจ้งซ่อม
@endsection

@section('header')
    แจ้งซ่อม
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" /> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
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
                    แจ้งซ่อม
                </div>
            </div>
        </h5>
        <div class="card-body">
            <div class="d-inline-flex  mb-3" id="userstable_filter">
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered text-center table-striped" id="datatable1">

                    <thead>
                        <tr>
                            <th class="text-center">ลำดับ</th>
                            <th class="text-center">สถานะ</th>
                            <th class="text-center">หน่วยงาน</th>
                            <th class="text-center">บริการ</th>
                            <th class="text-center">สาเหตุ</th>
                            <th class="text-center">ผู้แจ้ง</th>
                            <th class="text-center">วัน/เวลา</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $value)
                            <tr class="text-center text-nowrap">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span
                                        class="badge rounded-pill {{ $value->status_tag }}">{{ $value->status_name }}</span>
                                </td>
                                <td>{{ $value->inv_dep_name }}</td>
                                <td>{{ $value->service_list_name }}</td>
                                <td>{{ $value->solution }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ Carbon\Carbon::parse($value->created_at)->thaidate('j M y H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


   {{--  @php(
    $username = DB::connection('pgsql')->table('opduser')
    ->leftJoin('officer', 'opduser.loginname', '=', 'officer.officer_login_name')
    ->leftJoin('doctor', 'doctor.code', '=', 'officer.officer_doctor_code')
    ->leftJoin('emp', 'emp.emp_id', '=', 'officer.emp_id')
    /* ->leftJoin('officer_group_list', 'officer_group_list.officer_id', '=', 'officer.officer_id') */
    /* ->leftJoin('officer_department', 'officer_department.officer_id', '=', 'officer.officer_id') */
    ->where('doctor.active', 'Y')
    /* ->where('officer_department.depcode', '136') */
    /* ->where('officer_group_list.officer_group_id', '56') */
    ->whereNotNull('emp.emp_id')
  /*   ->whereNotNull('doctor.position_id') */
    ->whereNotNull('officer.officer_doctor_code')
    ->select('officer.officer_id', 'doctor.name', 'emp.emp_id')
    ->get()) --}}
@php(
    $username = DB::connection('pgsql')->table('opduser')
    ->leftJoin('officer', 'opduser.loginname', '=', 'officer.officer_login_name')
    ->leftJoin('doctor', 'officer.officer_doctor_code', '=', 'doctor.code')
    ->leftJoin('emp', 'doctor.cid', '=', 'emp.emp_cid')
    ->where('doctor.active', 'Y')
    ->whereNotNull('emp.emp_id')
    ->whereNotNull('officer.officer_doctor_code')
    ->select('officer.officer_id', 'doctor.name', 'emp.emp_id','opduser.loginname')
    ->get())
    <div class="modal fade" data-bs-backdrop="static" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">แจ้งซ่อม</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="" action="{{ route('fix1') }}" method="POST">
                        @csrf
                        @method('post')
                        <div class="form-floating mb-3">
                            <input type="hidden" name="id" class="form-control" id="floatingInputValue"
                                placeholder="" value="{{ request()->id }}">
                            <input type="input" name="id" class="form-control" id="floatingInputValue"
                                placeholder="" value="{{ request()->id }}" disabled>
                            <label for="floatingInputValue" class="">ID</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="service" name="username"
                                aria-label="Floating label select example">
                                @foreach ($username as $usernames)
                                    <option value="{{ $usernames->loginname }}"
                                        {{ old('username') == $usernames->loginname ? 'selected' : '' }}>
                                        {{ $loop->iteration }}.) {{ $usernames->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">ชื่อผู้แจ้ง</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="tel" class="form-control @error('tel') is-invalid @enderror"
                                id="floatingInputValue" placeholder="" value="">
                            <label for="floatingInputValue" class="">เบอร์ติดต่อ</label>
                            @error('tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @php($location = DB::table('com_service_list')->select('service_list_id', 'service_list_name')->get())
                        <div class="form-floating mb-3">
                            <select class="form-select" id="service" name="service"
                                aria-label="Floating label select example">
                                @foreach ($location as $locationv)
                                    <option value="{{ $locationv->service_list_id }}"
                                        {{ old('service') == $locationv->service_list_id ? 'selected' : '' }}>
                                        {{ $locationv->service_list_name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">การบริการ</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="input" name="solu" class="form-control  @error('solu') is-invalid @enderror"
                                id="floatingInputValue" placeholder="" value="{{ old('solu') }}">
                            <label for="floatingInputValue" class="">อาการ/ปัญหา</label>
                            @error('solu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
    {{-- @livewireScripts --}}

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
    <script>
        $(document).ready(function() {
            let code = "";
            document.addEventListener('keypress', e => {
                if (e.keyCode === 13) {
                    if (code.charAt(code.length - 10) == "C" && code.charAt(code.length - 9) == "O" && code
                        .charAt(code.length - 8) == "M") {
                        window.location.replace(code);
                        code = "";
                    } else {
                        code = "";
                    }
                } else {
                    code += e.key;
                }
            });
            $('#build').select2({
                dropdownParent: $('#exampleModal'),
                theme: 'bootstrap-5',
            });
            $('#service').select2({
                dropdownParent: $('#exampleModal'),
                theme: 'bootstrap-5',
            });
            //$('#exampleModal').modal('show');
            @isset(request()->id)
                $('#exampleModal').modal('show');
            @endisset

            $('#datatable1').DataTable({
                    initComplete: function() {
                        this.api()
                            .columns([1,2,3])
                            .every(function() {
                                var column = this;
                                var select = $(
                                    '<select class="form-select mx-2"><option value="">' + column
                                    .header().textContent + ' (ทั้งหมด)</option></select>'
                                ).appendTo('#userstable_filter').on('change',
                                    function() {
                                        var val = $.fn.dataTable.util.escapeRegex($(
                                            this).val());

                                        column.search(val ? '^' + val + '$' : '', true,
                                            false).draw();
                                    });

                                column
                                    .data()
                                    .unique()
                                    .sort()
                                    .each(function(d, j) {
                                        select.append('<option>' + d + '</option>');
                                    });
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
                                'columns': [0, 1, 2, 3, 4, 5]

                            },
                            "charset": 'utf-8',
                            "className": 'btn btn-dark'
                        },
                        {
                            "extend": 'print',
                            "exportOptions": {
                                "stripHtml": false,
                                'columns': [0, 1, 2, 3, 4, 5]

                            },
                            "charset": 'utf-8',
                            "className": 'btn btn-dark'
                        },

                    ]

                }).buttons()
                .container()
                .appendTo("#tt");;

        });
    </script>
@endsection
