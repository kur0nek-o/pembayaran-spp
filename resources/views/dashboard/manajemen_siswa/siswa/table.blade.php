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
                        <td>{{ $list->nama_kelas }}</td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="/siswa/{{ $list->id }}/edit"><i class="bi bi-pencil-square"></i></a>
                            <button class="btn btn-danger btn-sm" type="button" onclick="_delete( {{ $list->id }}, 'Menghapus data siswa berarti menghapus semua record transaksi dan history siswa yang bersangkutan!', 'siswa' )"><i class="bi bi-x-circle"></i></button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">Data siswa tidak ditemukan</td>
                </tr>
            @endif
        </tbody>
        <tr class="buffer">
            <td colspan="6"><img width="50" src="/img/buffer.gif" alt="buffering"></td>
        </tr>
    </table>
</div>

{!! $siswa->links() !!} 
