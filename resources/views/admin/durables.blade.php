@extends('layouts.layout');

@section('title')
    ทะเบียนครุภัณฑ์
@endsection

@section('header')
    ทะเบียนครุภัณฑ์
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" /> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    @livewireStyles
@endsection

@section('body')
    @include('sweetalert::alert')
    <div class="d-flex justify-content-end align-items-center mb-4" id="tt">

    </div>
    <div class="card">
        <h5 class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-primary fw-bold">
                    ทะเบียนครุภัณฑ์
                </div>
                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">เพิ่ม</button>
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
                            {{-- <th class="text-center">รหัส</th> --}}
                            <th class="text-center text-nowrap">เลขครุภัณฑ์</th>
                            <th class="text-center text-nowrap">ประเภทครุภัณฑ์</th>
                            <th class="text-center text-nowrap">ปีที่ได้</th>
                            <th class="text-center text-nowrap">Anydesk</th>
                            <th class="text-center text-nowrap">หน่วยงาน</th>
                            <th class="text-center text-nowrap">จัดการ</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $commo)
                            <tr class="text-nowrap">
                                <td>{{ $loop->iteration }}</td>
                                {{--  <td>{{ $commo->id }}</td> --}}
                                <td>{{ $commo->durable_id }}</td>
                                <td>{{ $commo->com_type_name }}</td>
                                <td>{{ $commo->year_received }}</td>
                                <td class="user-select-all">{{ $commo->anydesk_ip }}</td>
                                <td>{{ $commo->inv_dep_name }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button class="name-button btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal2" data-id="{{ $commo->id }}"
                                            data-name="{{ $commo->durable_name }}" data-comid="{{ $commo->durable_id }}"
                                            data-year="{{ $commo->year_received }}" data-ip="{{ $commo->anydesk_ip }}"
                                            data-comtype="{{ $commo->com_type_id }}"
                                            data-ward="{{ $commo->inv_dep_id }}">แก้ไข</button>

                                        <a href=" {{ route('pdf', $commo->id) }} " target="_blank"
                                            class="btn btn-success btn-sm">พิมพ์</a>
                                        <a href=" {{ route('daruble_del', $commo->id) }} " class="btn btn-danger btn-sm"
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


    <div class="modal fade" data-bs-backdrop="static" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary fw-bold" id="title">แก้ไข ครุภัณฑ์</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('daruble_edit') }}" method="post">
                        @csrf
                        @method('post')
                        <div class="form-floating mb-3">
                            <input type="input" name="eid" class="form-control" id="eid" placeholder=""
                                value="">
                            <label for="eid">ID</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="input" name="ename" class="form-control" id="ename" placeholder=""
                                value="">
                            <label for="ename">ชื่อเครื่อง</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="input" name="ecommoid" class="form-control" id="ecommoid" placeholder=""
                                value="">
                            <label for="ecommoid">ครุภัณฑ์</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="ecomtype" name="ecomtype">
                                @foreach ($comtype as $comtypes)
                                    <option value="{{ $comtypes->com_type_id }}">{{ $comtypes->com_type_name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="ecomtype">ประเภทครุภัณฑ์</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="eyear" placeholder="" value="">
                            <label for="eyear">ปีที่ได้รับ</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="eip" class="form-control" id="eip" placeholder=""
                                value="">
                            <label for="eip">Anydesk</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="ebuild" name="ebuild"
                                aria-label="Floating label select example">

                                @foreach ($invdep as $locationv)
                                    <option value="{{ $locationv->inv_dep_id }}">{{ $locationv->inv_dep_name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="ebuild">หน่วยงาน/ที่ตั้ง</label>
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
    <div class="modal fade" data-bs-backdrop="static" id="exampleModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary fw-bold" id="exampleModalLabel">เพิ่มครุภัณฑ์</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="" action="{{ route('daruble_add') }}" method="POST">
                        @csrf
                        @method('post')
                        <div class="form-floating mb-3">
                            <input type="hidden" name="id" class="form-control" id="floatingInputValue"
                                placeholder=""
                                value="{{ Haruncpi\LaravelIdGenerator\IdGenerator::generate(['table' => 'durable_goods', 'length' => 10, 'prefix' => 'COM']) }}">
                        </div>
                        <div class="form-floating mb-3">
                            <input type="input" class="form-control" id="floatingInputValue" placeholder=""
                                value="{{ Haruncpi\LaravelIdGenerator\IdGenerator::generate(['table' => 'durable_goods', 'length' => 10, 'prefix' => 'COM']) }}"
                                disabled>
                            <label for="floatingInputValue" class="text-dark">ID</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="input" name="name"
                                class="form-control  @error('name') is-invalid @enderror" id="name" placeholder=""
                                value="{{ old('name') }}">
                            <label for="name" class="text-dark">ชื่อเครื่อง</label>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="input" name="commoid"
                                class="form-control @error('commoid') is-invalid @enderror" id="commoid" placeholder=""
                                value="{{ old('commoid') }}">
                            <label for="commoid" class="text-dark">เลขครุภัณฑ์</label>
                            @error('commoid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="comtype" name="comtype"
                                aria-label="Floating label select example">
                                @foreach ($comtype as $comtypes)
                                    <option value="{{ $comtypes->com_type_id }}"
                                        {{ old('comtype') == $comtypes->com_type_name ? 'selected' : '' }}>
                                        {{ $comtypes->com_type_name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="comtype">ประเภทครุภัณฑ์</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="year" class="form-control" id="year" placeholder=""
                                value="{{ old('year') }}">
                            <label for="year" class="">ปีที่ได้รับ</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="ip" class="form-control" id="ip" placeholder=""
                                value="{{ old('ip') }}">
                            <label for="ip" class="">Anydesk</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="build" name="build"
                                aria-label="Floating label select example">

                                @foreach ($invdep as $locationv)
                                    <option value="{{ $locationv->inv_dep_id }}"
                                        {{ old('comtype') == $locationv->inv_dep_id ? 'selected' : '' }}>
                                        {{ $locationv->inv_dep_name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="build">หน่วยงาน/ที่ตั้ง</label>
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
    @livewireScripts

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
            @if ($errors->any())
                $('#exampleModal').modal('show');
            @endif
            $('#ecomtype').select2({
                dropdownParent: $('#exampleModal2'),
                theme: 'bootstrap-5',
            });

            $('#ebuild').select2({
                dropdownParent: $('#exampleModal2'),
                theme: 'bootstrap-5',
            });
            $('#comtype').select2({
                dropdownParent: $('#exampleModal'),
                theme: 'bootstrap-5',
            });
            $('#build').select2({
                dropdownParent: $('#exampleModal'),
                theme: 'bootstrap-5',
            });
            $(".name-button").click(function(event) {
                $('#title').html("แก้ไข " + $(this).attr('data-id'));
                $('#eid').val($(this).attr('data-id'));
                $('#ename').val($(this).attr('data-name'));
                $('#ecommoid').val($(this).attr('data-comid'));
                $('#eip').val($(this).attr('data-ip'));
                $('#eyear').val($(this).attr('data-year'));
                $('#ebuild').val($(this).attr('data-ward')).trigger('change');
                $('#ecomtype').val($(this).attr('data-comtype')).trigger('change');

            });
            $('#datatable1').DataTable({
                    initComplete: function() {
                        this.api()
                            .columns([3, 4, 6])
                            .every(function() {
                                var column = this;
                                var select = $(
                                    '<select class="form-select fter mx-2"><option value="">' + column
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
                        var bt = $('<button class="btn btn-primary">รีเซ็ต</button>').appendTo(
                            '#userstable_filter').on('click',
                            function() {
                                $('.fter').val('');
                                var table = $('#datatable1').DataTable();
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
