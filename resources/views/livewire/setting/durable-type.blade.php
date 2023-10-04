<div>
    <div class="d-flex justify-content-end align-items-center mb-4" id="tt">
    </div>
    <div class="card">
        <h5 class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-primary fw-bold">
                    ประเภทครุภัณฑ์
                </div>
                <div>
                    <button wire:click='resetinput' class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#StoreModal">เพิ่ม</button>
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
                            <th class="text-center text-nowrap">ประเภทครุภัณฑ์</th>
                            <th class="text-center text-nowrap">จัดการ</th>
                    </thead>

                    <tbody>
                        @foreach ($data as $commo)
                            <tr class="text-nowrap">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $commo->com_type_name }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        {{-- <button wire:click="EditDurable('{{ $commo->com_type_id }}')"
                                            class="name-button btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#EditModal">แก้ไข</button> --}}
                                        <button class="name-button btn btn-info btn-sm"
                                            wire:click="$dispatch('EditClick', { id: {{ $commo->com_type_id }} })">แก้ไข</button>
                                        <button wire:click.prevent="$dispatch('al-del', { id: {{ $commo->com_type_id }} })"
                                            class="btn btn-danger btn-sm">ลบ</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" data-bs-backdrop="static" id="StoreModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary fw-bold" id="exampleModalLabel">เพิ่มประเภทครุภัณฑ์</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='storeDurableData'>
                        <div class="form-floating mb-3">
                            <input type="input" class="form-control  @error('durable_type') is-invalid @enderror"
                                id="durable_type" wire:model="durable_type" placeholder="">
                            <label for="name" class="text-dark">ประเภทครุภัณฑ์</label>
                            @error('durable_type')
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
    {{-- edit --}}
    <div wire:ignore.self class="modal fade" data-bs-backdrop="static" id="EditModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary fw-bold" id="exampleModalLabel">แก้ไขประเภทครุภัณฑ์</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='EditDurableData'>
                        <div class="form-floating mb-3">
                            <input type="input" class="form-control  @error('durable_type') is-invalid @enderror"
                                id="durable_type" wire:model="durable_type" placeholder="">
                            <label for="name" class="text-dark">การบริการ</label>
                            @error('durable_type')
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
        document.addEventListener('EditClick', event => {
            @this.dispatch('EditDurable', {
                id: event.detail.id
            });
        });
        document.addEventListener('datatable', event => {
            $(document).ready(function() {
                /* localStorage.removeItem('DataTables_datatable1') */
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
                    /* initComplete: function() {
                        this.api()
                            .columns([1])
                            .every(function() {

                                var column = this;
                                var select = $(
                                    '<select class="form-select mx-2"><option value="">' +
                                    column.header().textContent +
                                    ' (ทั้งหมด)</option></select>').appendTo(
                                    '#userstable_filter').on('change',
                                    function() {
                                        column.search($(this).val())
                                            .draw();
                                    });

                                column
                                    .data()
                                    .unique()
                                    .sort()
                                    .each(function(d, j) {
                                        select.append('<option>' + d + '</option>');
                                    });
                                var state = this.state.loaded();
                                if (state) {
                                    var val = state.columns[this.index()];
                                    select.val(val.search.search);
                                }
                                var bt = $('<button class="btn btn-info">รีเซ็ต</button>').appendTo(
                                    '#userstable_filter').on('click',
                                    function() {
                                        select.val("");
                                        localStorage.removeItem('DataTables_datatable1')
                                        column.search($(this).val()).draw();
                                        
                                    });
                            });
                    }, */
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
                                'columns': [1]

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

                }).rows().invalidate('data').draw(false).buttons().container().appendTo("#tt");
            });
        });

        document.addEventListener('close-modal', event => {
            $('#StoreModal').modal('hide');
            $('#EditModal').modal('hide');
        });
        document.addEventListener('show-modal-edit', event => {
            $('#EditModal').modal('show');
        });
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
    </script>
@endpush
