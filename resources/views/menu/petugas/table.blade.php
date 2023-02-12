<div class="table-responsive">
    <table class="table table-bordered border-dark text-center mb-0">
        <thead style="background: yellow">
            <tr class="text-nowrap">
                <th scope="col">No</th>
                <th scope="col">Nama petugas</th>
                <th scope="col">Username</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $petugas as $p )
                <tr>
                    <th>{{ 'none' }}</th>
                    <td>{{ $p->nama_petugas }}</td>
                    <td>{{ $p->username }}</td>
                    <td>tidak ada</td>
                </tr>
            @endforeach
            {{-- <tr>
                <td colspan="4">halo</td>
            </tr> --}}
        </tbody>
    </table>
</div>

{!! $petugas->links() !!} 