@extends('layouts.layout');

@section('title')
    จัดการแจ้งซ่อม
@endsection

@section('header')
    จัดการแจ้งซ่อม
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" /> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    {{-- @livewireStyles --}}
    <link type="text/css" href="{{ asset('uipack/signature/jquery-ui.css') }}"rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('uipack/signature/jquery.signature.css') }}">
    <style>
        .kbw-signature {
            width: 450px;
            height: 200px;
        }

        .child {
            display: none;
        }

        .parent:hover .child {
            display: block;
        }
    </style>
@endsection

@section('body')
    @include('sweetalert::alert')
    <div class="d-flex justify-content-end align-items-center mb-4" id="tt">

    </div>
    <div class="card">
        <h5 class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-primary fw-bold">
                    จัดการแจ้งซ่อม
                </div>
            </div>
        </h5>
        <div class="card-body">
            <div class="d-inline-flex  mb-3" id="userstable_filter">
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered text-start table-striped" id="datatable1">
                    <thead>
                        <tr class="text-nowrap">
                            <th class="text-center">ลำดับ</th>
                            <th class="text-center">สถานะ</th>
                            <th class="text-center">ประเภท</th>
                            <th class="text-center">หน่วยงาน</th>
                            <th class="text-center">เบอร์</th>
                            <th class="text-center">บริการ</th>
                            <th class="text-center">สาเหตุ</th>
                            <th class="text-center">ลายเซ็นรับรอง</th>
                            {{-- <th class="text-center">Anydesk</th> --}}
                            <th class="text-center">วัน/เวลา</th>
                            <th class="text-center">จัดการ</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $value)
                            <tr class="text-center text-nowrap">
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge {{ $value->status_tag }}">{{ $value->status_name }}</span>

                                </td>

                                <td>{{ $value->com_type_name }}</td>
                                <td>{{ $value->inv_dep_name }}</td>
                                <td>{{ $value->tel_number  }}</td>
                                <td>{{ $value->service_list_name }}</td>
                                <td>{{ $value->solution }}</td>
                                
                                <td>
                                    @if (!empty($value->signed))
                                        <p class='parent'>ดู<img class="child"
                                                src="{{ asset('storage/signed/' . $value->signed) }}" width="150"
                                                height="100" /></p>

                                        {{-- <a href="{{ asset('storage/signed/' . $value->signed) }}">ดู</a> --}}
                                    @else
                                        -
                                    @endif

                                </td>
                                {{-- <td class="user-select-all">{{ $value->anydesk_ip }}</td> --}}
                                <td>{{ Carbon\Carbon::parse($value->created_at)->thaidate('j M y H:i:s') }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button class="name-button btn btn-info  btn-sm" data-bs-toggle="modal"
                                            data-repair_id="{{ $value->hos_repiar_id }}" data-bs-target="#exampleModal"
                                            data-name="{{ $value->durable_name }}"
                                            data-evl_type="{{ $value->help_evl_type_id }}"
                                            data-apprv_emp_id="{{ $value->help_apprv_emp_id }}"
                                            data-id="{{ $value->id }}" data-comid="{{ $value->com_id }}"
                                            data-status="{{ $value->status_id }}"
                                            data-score="{{ $value->inv_durable_rate_after_point }}"
                                            data-rate="{{ $value->inv_durable_rate_after_emp_id }}">ประเมิน
                                        </button>
                                        <a href="{{ route('DelRepair', $value->id) }}" class="btn btn-danger btn-sm"
                                            data-confirm-delete="true">ลบ</a>
                                    </div>
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
    $username = DB::connection('pgsql')->table('opduser')->leftJoin('officer', 'officer.officer_login_name', '=', 'opduser.loginname')->leftJoin('doctor', 'doctor.code', '=', 'officer.officer_doctor_code')->leftJoin('emp', 'emp.emp_id', '=', 'officer.emp_id')->where('doctor.active', 'Y')->whereNotNull('emp.emp_id')->whereNotNull('officer.officer_doctor_code')->select('officer.officer_id', 'doctor.name', 'emp.emp_id')->get()) {{-- emp id --}}
    <div class="modal fade" data-bs-backdrop="static" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">แจ้งซ่อม</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="" action="{{ route('updateRepair') }}" method="POST">
                        @csrf
                        @method('post')
                        <div class="form-floating mb-3">
                            <input type="hidden" name="repair_id" class="form-control" id="repair_id" placeholder=""
                                value="">
                            <input type="hidden" name="id" class="form-control" id="id" placeholder=""
                                value="">
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
                            <select class="form-select" id="apparv_emp" name="evaluate_status"
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
                                {{ $sta = DB::table('status')->get() }}
                                @foreach ($sta as $status)
                                    <option value="{{ $status->id }}">{{ $status->status_name }}</option>
                                @endforeach
                            </select>
                            <label for="status">สถานะส่งซ่อม (ช่างซ่อม)</label>
                        </div>
                        <div class="divider">
                            <div class="divider-text">
                               สำหรับผู้แจ้ง
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="username" name="username"
                                aria-label="Floating label select example">
                                <option>
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
                        <div class="mb-3" id="sign">
                            <label class="" for="">เซ็นรับรอง (สำหรับผู้แจ้งซ่อม):</label>
                            <br />
                            <div id="sig"></div>
                            <br />
                            <button id="clear" class="btn btn-danger btn-sm">ลบ</button>
                            <button id="disable" class="btn btn-info btn-sm">ปิดแก้ไข</button>
                            <textarea id="signature64" name="signed" style="display: none"></textarea>
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
    <script type="text/javascript" src="{{ asset('uipack/signature/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('uipack/signature/signature.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"
        integrity="sha512-0bEtK0USNd96MnO4XhH8jhv3nyRF0eK87pJke6pkYf3cM0uDIhNJy9ltuzqgypoIFXw3JSuiy04tVk4AjpZdZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        //var x = document.getElementById("sign");
        //x.style.display = "none";
        $('#floatingSelect').on('change', function() {
            if (this.value == 3) {} else {}

        });
        var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG',
            guideline: true,
            guidelineOffset: 25,
            guidelineIndent: 20,
            guidelineColor: '#ff0000'
        });


        $('#disable').click(function(e) {
            e.preventDefault();
            var disable = $(this).text() === 'ปิดแก้ไข';
            $(this).text(disable ? 'เปิดแก้ไข' : 'ปิดแก้ไข');
            sig.signature(disable ? 'disable' : 'enable');
        });


        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>
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
                $('#apparv_emp').val($(this).attr('data-apprv_emp_id'));
                $('#score').val($(this).attr('data-score'));
                $('#username').val($(this).attr('data-rate')).trigger('change');
            });
            $('#datatable1').DataTable({
                    initComplete: function() {
                        this.api()
                            .columns([1, 2, 3, 4])
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
                                'columns': [1, 2, 3]

                            },
                            "charset": 'utf-8',
                            "className": 'btn btn-dark'
                        },
                        {
                            "extend": 'print',
                            "exportOptions": {
                                "stripHtml": false,
                                'columns': [1]

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
