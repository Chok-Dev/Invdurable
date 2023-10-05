<div>
    <div class="d-flex justify-content-end align-items-center mb-4" id="tt">
    </div>
    <div class="card">
        <h5 class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-primary fw-bold">
                    ทะเบียนครุภัณฑ์
                </div>
                <div>
                    <button wire:click='reinput' class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">เพิ่ม</button>
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
                                {{-- <td>{{ $commo->id }}</td> --}}
                                <td>{{ $commo->durable_id }}</td>
                                <td>{{ $commo->com_type_name }}</td>
                                <td>{{ $commo->year_received }}</td>
                                <td class="user-select-all">{{ $commo->anydesk_ip }}</td>
                                <td>{{ $commo->inv_dep_name }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button class="name-button btn btn-info btn-sm">แก้ไข</button>
                                        <a href="{{ route('pdf', $commo->id) }}" target="_blank"
                                            class="btn btn-success btn-sm">พิมพ์</a>
                                        <a href="{{ route('daruble_del', $commo->id) }}" class="btn btn-danger btn-sm"
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


    <div class="modal fade" data-bs-backdrop="static" id="exampleModal2" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <div wire:ignore.self class="modal fade" data-bs-backdrop="static" id="exampleModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary fw-bold" id="exampleModalLabel">เพิ่มครุภัณฑ์</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='DurableAdd'>
                        <div class="form-floating mb-3">
                            <input type="input" class="form-control" id="floatingInputValue"
                                wire:model='durable_id' disabled>
                            <label for="floatingInputValue" class="text-dark">ID</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="input" wire:model='durable_name'
                                class="form-control  @error('durable_name') is-invalid @enderror" id="durable_name" >
                            <label for="durable_name" class="text-dark">ชื่อเครื่อง</label>
                            @error('durable_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="input" wire:model='durable_code'
                                class="form-control @error('durable_code') is-invalid @enderror" id="durable_code"
                                placeholder="">
                            <label for="durable_code" class="text-dark">เลขครุภัณฑ์</label>
                            @error('durable_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-floating mb-3">
                            <select wire:model='durable_type' class="form-select"
                                aria-label="Floating label select example">
                                @foreach ($comtype as $comtypes)
                                    <option value="{{ $comtypes->com_type_id }}"
                                        {{ old('durable_type') == $comtypes->com_type_name ? 'selected' : '' }}>
                                        {{ $comtypes->com_type_name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="comtype">ประเภทครุภัณฑ์</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" placeholder="" wire:model='durable_year'>
                            <label for="year" class="">ปีที่ได้รับ</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" placeholder="" wire:model='durable_anydesk'>
                            <label for="ip" class="">Anydesk</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" wire:model='durable_dep'
                                aria-label="Floating label select example">
                                @foreach ($invdep as $locationv)
                                    <option value="{{ $locationv->inv_dep_id }}"
                                        {{ old('durable_dep') == $locationv->inv_dep_id ? 'selected' : '' }}>
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
</div>
@push('scripts')
    <script>
        document.addEventListener('alert_success', event => {
            Swal.fire(
                'สำเร็จแล้ว!',
                'การกระทำของคุณสำเร็จแล้ว!',
                'success'
            )
        });
        document.addEventListener('alert_error', event => {
            Swal.fire(
                'ไม่สำเร็จ!',
                'การกระทำของคุณไม่สำเร็จ!',
                'error'
            )
        });
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
        document.addEventListener('close-modal', event => {
            $('#exampleModal').modal('hide');
            $('#exampleModal2').modal('hide');
        });
        document.addEventListener('datatable', event => {
            $(document).ready(function() {
                $('#datatable1').DataTable({
                    stateSave: true,
                    "stateSaveParams": function(settings, data) {
                        data.search.search = "";
                    },
                    stateSaveCallback: function(settings, data) {
                        localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(
                            data))
                    },
                    stateLoadCallback: function(settings) {
                        return JSON.parse(localStorage.getItem('DataTables_' + settings
                            .sInstance))
                    },
                    initComplete: function() {
                        this.api()
                            .columns([2, 3, 5])
                            .every(function() {
                                var column = this;
                                var select = $(
                                    '<select class="form-select fter mx-2"><option value="">' +
                                    column
                                    .header().textContent +
                                    ' (ทั้งหมด)</option></select>'
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

                }).rows().invalidate('data').draw(false).buttons().container().appendTo("#tt");
            });
        });
    </script>
@endpush
