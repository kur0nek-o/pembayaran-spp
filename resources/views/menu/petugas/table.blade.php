<div class="table-responsive">
    <table class="table table-bordered border-dark text-center mb-0">
        <thead style="background: yellow">
            <tr class="text-nowrap">
                <th scope="col">No</th>
                <th scope="col">Nama petugas</th>
                <th scope="col">Username</th>
                <th scope="col">Level</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody id="table-body">
            @if( $petugas->isNotEmpty() )
                @foreach( $petugas as $p )
                    <tr>
                        <th>{{ $index++ }}</th>
                        <td>{{ $p->nama_petugas }}</td>
                        <td>{{ $p->username }}</td>
                        <td>{{ ucfirst($p->level) }}</td>
                        <td>
                            <button class="btn bg-warning btn-sm" type="button" onclick="_edit( {{ $p->id_petugas }} )"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-danger btn-sm" type="button" onclick="_delete( {{ $p->id_petugas }}, 'Kamu akan menghapus data petugas!', 'petugas' )"><i class="bi bi-x-circle"></i></button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">Data petugas tidak ditemukan</td>
                </tr>
            @endif
        </tbody>
        <tr class="buffer">
            <td colspan="5"><img width="50" src="/img/buffer.gif" alt="buffering"></td>
        </tr>
    </table>
</div>

{!! $petugas->links() !!} 