@extends('auth.layouts.app')

@section('content')
<!-- Swiper JS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<div class="container-fluid">


    <div class="row project-wrapper">
        <div class="col-xxl-8">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                        <i data-feather="briefcase" class="text-primary"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Jumlah Pesanan Laundry</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="flex-grow-1 mb-0">0 Data</h4>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->

                <div class="col-xl-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-secondary-subtle rounded-2 fs-2">
                                        <i data-feather="award" class="text-secondary"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-medium text-muted mb-3">Pesanan  belum Di bayar</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="flex-grow-1 mb-0">0 Pesanan</h4>
                                    </div>

                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->

                <div class="col-xl-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-warning-subtle text-warning rounded-2 fs-2">
                                        <i data-feather="clock" class="text-warning"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Belum di proses</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="flex-grow-1 mb-0">0 pesanan</h4>
                                    </div>

                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->



</div>
@endsection
