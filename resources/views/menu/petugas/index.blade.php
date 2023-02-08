@extends( 'template.main' )

@section( 'content' )
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Petugas</h1>
</div>

<table class="table table-bordered border-dark table-responsive text-center">
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
@endsection