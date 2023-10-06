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
                    <button wire:click='reinput' class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">เพิ่ม</button>
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
                                        <button wire:click="$dispatch('EditClick', { id: '{{ $commo->id }}'})"
                                            class="name-button btn btn-info btn-sm">แก้ไข</button>
                                        <a href="{{ route('pdf', $commo->id) }}" target="_blank"
                                            class="btn btn-success btn-sm">พิมพ์</a>
                                        <button wire:click.prevent="$dispatch('al-del', { id: '{{ $commo->id }}' })" class="btn btn-danger btn-sm">ลบ</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" data-bs-backdrop="static" id="exampleModal2" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary fw-bold" id="title">แก้ไข ครุภัณฑ์</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='EditDurableData'>
                        <div class="form-floating mb-3">
                            <input type="input" class="form-control" id="floatingInputValue" wire:model='durable_id'
                                disabled>
                            <label for="floatingInputValue" class="">ID</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="input" wire:model='durable_name'
                                class="form-control  @error('durable_name') is-invalid @enderror" id="durable_name" placeholder="">
                            <label for="durable_name" class="">ชื่อเครื่อง</label>
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
                            <label for="durable_code" class="">เลขครุภัณฑ์</label>
                            @error('durable_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-floating mb-3">
                            <select id="ecomtype" wire:model='durable_type'
                                class="form-select @error('durable_type') is-invalid @enderror"
                                aria-label="Floating label select example">
                                <option></option>
                                @foreach ($comtype as $comtypes)
                                    <option value="{{ $comtypes->com_type_id }}" @selected($durable_type == $comtypes->com_type_id)>
                                        {{ $comtypes->com_type_name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="comtype">ประเภทครุภัณฑ์ </label>
                            @error('durable_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{ $durable_name }}
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" placeholder="" wire:model='durable_year'>
                            <label for="year" class="">ปีที่ได้รับ</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" placeholder="" wire:model='durable_anydesk'>
                            <label for="ip" class="">Anydesk</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select id="ebuild" class="form-select @error('durable_dep') is-invalid @enderror"
                                wire:model='durable_dep' aria-label="Floating label select example">
                                <option></option>
                                @foreach ($invdep as $locationv)
                                    <option value="{{ $locationv->inv_dep_id }}" @selected($durable_dep == $locationv->inv_dep_id)>
                                        {{ $locationv->inv_dep_name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="build">หน่วยงาน/ที่ตั้ง</label>
                            @error('durable_dep')
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
                            <label for="floatingInputValue" class="">ID</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="input" wire:model='durable_name'
                                class="form-control  @error('durable_name') is-invalid @enderror" id="durable_name" placeholder="">
                            <label for="durable_name" class="">ชื่อเครื่อง</label>
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
                            <label for="durable_code" class="">เลขครุภัณฑ์</label>
                            @error('durable_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-floating mb-3">
                            <select id="comtype" wire:model='durable_type'
                                class="form-select @error('durable_type') is-invalid @enderror"
                                aria-label="Floating label select example" >
                                <option></option>
                                @foreach ($comtype as $comtypes)
                                    <option value="{{ $comtypes->com_type_id }}">
                                        {{ $comtypes->com_type_name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="comtype">ประเภทครุภัณฑ์ </label>
                            @error('durable_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{ $durable_name }}
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" placeholder="" wire:model='durable_year'>
                            <label for="year" class="">ปีที่ได้รับ</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" placeholder="" wire:model='durable_anydesk'>
                            <label for="ip" class="">Anydesk</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select id="build" class="form-select @error('durable_dep') is-invalid @enderror"
                                wire:model='durable_dep' aria-label="Floating label select example">
                                <option></option>
                                @foreach ($invdep as $locationv)
                                    <option value="{{ $locationv->inv_dep_id }}">
                                        {{ $locationv->inv_dep_name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="build">หน่วยงาน/ที่ตั้ง</label>
                            @error('durable_dep')
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
</div>
@push('scripts')
    <script>
        document.addEventListener('al-del', event => {
            Swal.fire({
                title: 'คุณแน่ใจที่จะลบหรือไหม?',
                text: "เมื่อลบแล้วไม่สามารถย้อนกลับได้!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง!',
                cancelButtonText: 'ยกเลิก!'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.dispatch('DeleteConfirm', {
                        id: event.detail.id
                    });
                }
            })
        });
        document.addEventListener('EditClick', event => {
            @this.dispatch('EditDurable', {
                id: event.detail.id
            });
        });
        document.addEventListener('show-modal-edit', event => {
            $('#exampleModal2').modal('show');
        });
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
