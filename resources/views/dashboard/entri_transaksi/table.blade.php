<div class="table-responsive">
    <table class="table table-bordered border-dark text-center mb-0">
        <thead style="background: yellow">
            <tr class="text-nowrap">
                <th scope="col">No</th>
                <th scope="col">NISN</th>
                <th scope="col">NIS</th>
                <th scope="col">Nama siswa</th>
                <th scope="col">Kelas</th>
                <th scope="col">Spp</th>
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
                        <td>{{ "Spp tahun $list->tahun | " . convert_to_rupiah($list->nominal) }}</td>
                        <td><a class="btn btn-primary btn-sm" href="/transaksi-pembayaran/{{ $list->id }}" >Bayar</a></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7">Data siswa tidak ditemukan</td>
                </tr>
            @endif
        </tbody>
        <tr class="buffer">
            <td colspan="7"><img width="50" src="/img/buffer.gif" alt="buffering"></td>
        </tr>
    </table>
</div>

{!! $siswa->links() !!} 
