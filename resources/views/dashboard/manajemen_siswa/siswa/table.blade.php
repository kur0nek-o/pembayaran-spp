<div class="table-responsive">
    <table class="table table-bordered border-dark text-center mb-0">
        <thead style="background: yellow">
            <tr class="text-nowrap">
                <th scope="col">No</th>
                <th scope="col">NISN</th>
                <th scope="col">NIS</th>
                <th scope="col">Nama siswa</th>
                <th scope="col">Kelas</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody id="table-body">
            @if( $siswa->isNotEmpty() )
                @foreach( $siswa as $list )
                    <tr>
                        <th>{{ $index++ }}</th>
                        <td>{{ $list->nisn }}</td>
                        <td>{{ $list->nis }}</td>
                        <td>{{ $list->nama }}</td>
                        <td>{{ $list->kelas_id }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" type="button" onclick="_edit( {{ $list->id }} )"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-danger btn-sm" type="button" onclick="_delete( {{ $list->id }}, 'Kamu akan menghapus data siswa!', 'siswa' )"><i class="bi bi-x-circle"></i></button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">Data siswa tidak ditemukan</td>
                </tr>
            @endif
        </tbody>
        <tr class="buffer">
            <td colspan="5"><img width="50" src="/img/buffer.gif" alt="buffering"></td>
        </tr>
    </table>
</div>

{!! $siswa->links() !!} 