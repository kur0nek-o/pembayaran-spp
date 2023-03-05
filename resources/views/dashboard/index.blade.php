@extends( 'template.main' )

@section( 'main' )
<div class="pagetitle">
    <h1>Dashboard</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <div class="col-lg-4">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Siswa</h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3"><h6>{{ $siswa }}</h6></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Kelas</h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-door-closed"></i>
                        </div>
                        <div class="ps-3"><h6>{{ $kelas }}</h6></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Petugas</h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="ps-3"><h6>{{ $petugas }}</h6></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
