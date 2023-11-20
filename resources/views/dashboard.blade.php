@extends('layouts.layout')
@section('title')
รายงานการแจ้งซ่อม
@endsection
@section('css')
@endsection
@section('js')
    {{-- <script src="{{ asset('uipack/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script> --}}
@endsection

@section('body')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 col-md-12 order-1">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card border border-secondary shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-label-secondary fw-bold fs-6">รอรับเรื่อง</span>
                                    <span class="fs-6 fw-bold">{{ DB::connection('pgsql')
                                        ->table('inv_durable_good_repair')
                                        ->select('inv_durable_good_repair_id')
                                        ->where('inv_durable_good_repair_dep_id',2)->whereDate('inv_durable_good_repair_date', date("Y-m-d"))->where('inv_durable_good_rstatus_id', null)->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card border border-primary shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-label-primary fs-6 fw-bold">รับเรื่องแล้ว</span>
                                    <span class="fs-6 fw-bold">{{ DB::connection('pgsql')
                                        ->table('inv_durable_good_repair')
                                        ->select('inv_durable_good_repair_id')
                                        ->where('inv_durable_good_repair_dep_id',2)->whereDate('inv_durable_good_repair_date', date("Y-m-d"))->where('inv_durable_good_rstatus_id', 5)->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card border border-info shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-label-info fs-6 fw-bold">กำลังซ่อม</span>
                                    <span class="fs-6 fw-bold">{{ DB::connection('pgsql')
                                        ->table('inv_durable_good_repair')
                                        ->select('inv_durable_good_repair_id')
                                        ->where('inv_durable_good_repair_dep_id',2)->whereDate('inv_durable_good_repair_date', date("Y-m-d"))->where('inv_durable_good_rstatus_id', 2)->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card border border-success shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-label-success fs-6 fw-bold">ซ่อมเรียบร้อย</span>
                                    <span class="fs-6 fw-bold">{{ DB::connection('pgsql')
                                        ->table('inv_durable_good_repair')
                                        ->select('inv_durable_good_repair_id')
                                        ->where('inv_durable_good_repair_dep_id',2)->whereDate('inv_durable_good_repair_date', date("Y-m-d"))->where('inv_durable_good_rstatus_id', 1)->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <!-- Order Statistics -->
            <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-center pb-0">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">รายงานแจ้งซ่อมทั้งหมด</h5>
                            <small class="text-muted">ทั้งหมด</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <div class="d-flex flex-column align-items-center gap-1">
                                <h2 class="mb-2">{{ DB::connection('pgsql')
                                    ->table('inv_durable_good_repair')
                                    ->select('inv_durable_good_repair_id')
                                    ->where('inv_durable_good_repair_dep_id',2)->count() }}</h2>
                                <span>Total Orders</span>
                            </div>
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-secondary"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-secondary fw-bold">รอรับเรื่อง</span>
                                        </h6>
                                        <small class="text-muted">รอรับเรื่องจากช่างซ่อม</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', null)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-primary fw-bold">รับเรื่องแล้ว</span>
                                        </h6>
                                        <small class="text-muted">ช่างซ่อมรับเรื่องแล้ว</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', 5)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-info fw-bold">กำลังซ่อม</span></h6>
                                        <small class="text-muted">ช่างซ่อมกำลังซ่อม</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', 2)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-warning"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-warning fw-bold">ส่งภายนอก</span></h6>
                                        <small class="text-muted">ส่งซ่อมภายนอก</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', 3)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-danger"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-danger fw-bold">แทงชำรุด</span></h6>
                                        <small class="text-muted">แทงชำรุด</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', 4)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-success fw-bold">ซ่อมเรียบร้อย</span>
                                        </h6>
                                        <small class="text-muted">ช่างซ่อมเสร็จสิ้น</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', 1)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-center pb-0">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">รายงานแจ้งซ่อมประจำเดือนนี้</h5>
                            <small class="text-muted">{{ thaidate('เดือน F พ.ศ. Y') }}</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <div class="d-flex flex-column align-items-center gap-1">
                                <h2 class="mb-2">{{ DB::connection('pgsql')
                                    ->table('inv_durable_good_repair')
                                    ->select('inv_durable_good_repair_id')
                                    ->whereMonth('inv_durable_good_repair_date', date("m"))
                                    ->where('inv_durable_good_repair_dep_id',2)->count() }}</h2>
                                <span>Total Orders</span>
                            </div>
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-secondary"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-secondary fw-bold">รอรับเรื่อง</span>
                                        </h6>
                                        <small class="text-muted">รอรับเรื่องจากช่างซ่อม</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->whereMonth('inv_durable_good_repair_date', date("m"))
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', null)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-primary fw-bold">รับเรื่องแล้ว</span>
                                        </h6>
                                        <small class="text-muted">ช่างซ่อมรับเรื่องแล้ว</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->whereMonth('inv_durable_good_repair_date', date("m"))
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', 5)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-info fw-bold">กำลังซ่อม</span></h6>
                                        <small class="text-muted">ช่างซ่อมกำลังซ่อม</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->whereMonth('inv_durable_good_repair_date', date("m"))
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', 2)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-warning"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-warning fw-bold">ส่งภายนอก</span></h6>
                                        <small class="text-muted">ส่งซ่อมภายนอก</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->whereMonth('inv_durable_good_repair_date', date("m"))
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', 3)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-danger"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-danger fw-bold">แทงชำรุด</span></h6>
                                        <small class="text-muted">แทงชำรุด</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->whereMonth('inv_durable_good_repair_date', date("m"))
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', 4)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-success fw-bold">ซ่อมเรียบร้อย</span>
                                        </h6>
                                        <small class="text-muted">ช่างซ่อมเสร็จสิ้น</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->whereMonth('inv_durable_good_repair_date', date("m"))
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', 1)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-center pb-0">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">รายงานแจ้งซ่อมประจำปีนี้</h5>
                            <small class="text-muted">{{ thaidate('ปี พ.ศ. Y') }}</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <div class="d-flex flex-column align-items-center gap-1">
                                <h2 class="mb-2">{{ DB::connection('pgsql')
                                    ->table('inv_durable_good_repair')
                                    ->select('inv_durable_good_repair_id')
                                    ->whereYear('inv_durable_good_repair_date', date("Y"))
                                    ->where('inv_durable_good_repair_dep_id',2)->count() }}</h2>
                                <span>Total Orders</span>
                            </div>
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-secondary"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-secondary fw-bold">รอรับเรื่อง</span>
                                        </h6>
                                        <small class="text-muted">รอรับเรื่องจากช่างซ่อม</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->whereYear('inv_durable_good_repair_date', date("Y"))
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', null)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-primary fw-bold">รับเรื่องแล้ว</span>
                                        </h6>
                                        <small class="text-muted">ช่างซ่อมรับเรื่องแล้ว</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->whereYear('inv_durable_good_repair_date', date("Y"))
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', 5)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-info fw-bold">กำลังซ่อม</span></h6>
                                        <small class="text-muted">ช่างซ่อมกำลังซ่อม</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->whereYear('inv_durable_good_repair_date', date("Y"))
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', 2)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-warning"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-warning fw-bold">ส่งภายนอก</span></h6>
                                        <small class="text-muted">ส่งซ่อมภายนอก</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->whereYear('inv_durable_good_repair_date', date("Y"))
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', 3)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-danger"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-danger fw-bold">แทงชำรุด</span></h6>
                                        <small class="text-muted">แทงชำรุด</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->whereYear('inv_durable_good_repair_date', date("Y"))
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', 4)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success"><i
                                            class='bx bx-objects-vertical-bottom'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><span class="badge bg-label-success fw-bold">ซ่อมเรียบร้อย</span>
                                        </h6>
                                        <small class="text-muted">ช่างซ่อมเสร็จสิ้น</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ DB::connection('pgsql')
                                            ->table('inv_durable_good_repair')
                                            ->select('inv_durable_good_repair_id')
                                            ->whereYear('inv_durable_good_repair_date', date("Y"))
                                            ->where('inv_durable_good_repair_dep_id',2)->where('inv_durable_good_rstatus_id', 1)->count() }}</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
