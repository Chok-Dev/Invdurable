@extends('layouts.layout');

@section('title')
    Qr-Code แจ้งซ่อมครุภัณฑ์
@endsection

@section('header')
    Qr-Code แจ้งซ่อมครุภัณฑ์
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" /> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" /> --}}
    {{-- @livewireStyles --}}
    <style></style>
@endsection

@section('body')
    {{-- @include('sweetalert::alert') --}}
    <div class="d-flex justify-content-end align-items-center mb-4" id="tt">

    </div>
    <div class="card">

        <h5 class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-primary fw-bold">
                    Qr-Code แจ้งซ่อมครุภัณฑ์
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
                            <th>ลำดับ</th>
                            <th>Qr-Code</th>
                            <th>ประเภท</th>
                            <th>หน่วยงาน</th>
                            <th>ปีที่ได้รับ</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $commo)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center flex-row">
                                        <div class="p-1">{!! QrCode::size(50)->generate(url('fix?id=') . $commo->id) !!}</div>
                                        <div class="">
                                            <div class="col col-auto">
                                                <p class="mb-1 text-nowrap" style="font-size: 8px">ID: {{ $commo->id }}</p>
                                                <p class="mb-1 text-nowrap" style="font-size: 8px">ประเภท:
                                                    {{ $commo->com_type_name }}</p>
                                                <p class="mb-1 text-nowrap" style="font-size: 8px">หน่วยงาน:
                                                    {{ $commo->inv_dep_name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $commo->com_type_name }}</td>
                                <td>{{ $commo->inv_dep_name }}</td>
                                <td>{{ $commo->year_received }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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

    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('#datatable1').DataTable({
                    initComplete: function() {
                        this.api()
                            .columns([2, 3])
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
