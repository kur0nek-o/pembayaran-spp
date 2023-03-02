<div class="table-responsive">
    <table class="table table-bordered border-dark text-center mb-0">
        <thead style="background: yellow">
            <tr class="text-nowrap">
                <th scope="col">No</th>
                <th scope="col">Tahun</th>
                <th scope="col">Nominal</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody id="table-body">
            @if( $spp->isNotEmpty() )
                @foreach( $spp as $list )
                    <tr>
                        <th>{{ $index++ }}</th>
                        <td>{{ $list->tahun }}</td>
                        <td>{{ convert_to_rupiah($list->nominal) }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" type="button" onclick="_edit( {{ $list->id_spp }} )"><i class="bi bi-pencil-square"></i></button>

                            @if(! $list->siswa->count())
                                <button class="btn btn-danger btn-sm" type="button" onclick="_delete( {{ $list->id_spp }}, 'Kamu akan menghapus data spp!', 'spp' )"><i class="bi bi-x-circle"></i></button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">Data spp tidak ditemukan</td>
                </tr>
            @endif
        </tbody>
        <tr class="buffer">
            <td colspan="5"><img width="50" src="/img/buffer.gif" alt="buffering"></td>
        </tr>
    </table>
</div>

{!! $spp->links() !!} 
