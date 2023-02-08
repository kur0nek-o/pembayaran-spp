@extends( 'template.main' )

@section( 'main' )
<div class="pagetitle">
    <h1>Petugas</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item">Data Management</li>
            <li class="breadcrumb-item">Petugas</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col">
            <div class="card p-3">
                <div class="card-body p-0">
                    <table class="table table-bordered border-dark table-responsive text-center mb-0">
                        <thead style="background: yellow">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama petugas</th>
                                <th scope="col">Username</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $petugas as $p )
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $p->nama_petugas }}</td>
                                    <td>{{ $p->user->username }}</td>
                                    <td>tidak ada</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection