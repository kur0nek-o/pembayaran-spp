<div class="table-responsive">
    <table class="table table-bordered border-dark text-center mb-0">
        <thead style="background: yellow">
            <tr class="text-nowrap">
                <th scope="col">No</th>
                <th scope="col">Nama kelas</th>
                <th scope="col">Kompetensi keahlian</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody id="table-body">
            @if( $kelas->isNotEmpty() )
                @foreach( $kelas as $list )
                    <tr>
                        <th>{{ $index++ }}</th>
                        <td>{{ $list->nama_kelas }}</td>
                        <td>{{ $list->kompetensi_keahlian }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" type="button" onclick="_edit( {{ $list->id_kelas }} )"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-danger btn-sm" type="button" onclick="_delete( {{ $list->id_kelas }}, 'Kamu akan menghapus data kelas!', 'kelas' )"><i class="bi bi-x-circle"></i></button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">Data kelas tidak ditemukan</td>
                </tr>
            @endif
        </tbody>
        <tr class="buffer">
            <td colspan="5"><img width="50" src="/img/buffer.gif" alt="buffering"></td>
        </tr>
    </table>
</div>

{{ $kelas->onEachSide(1)->links() }} 
