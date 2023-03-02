@extends( 'template.main' )

@section( 'main' )
<!---------------- Main Section ---------------->
<div name="msg_storage" data-message="{{ session()->get('successMessage') }}" ></div>

<div class="pagetitle">
    <h1>Preview Kuitansi</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item">History & Pembayaran</li>
            <li class="breadcrumb-item">Preview Kuitansi</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<a href="/pembayaran" class="btn btn-warning mb-3 btn-sm">Kembali</a>
<a target="_blank" href="/cetak-kuitansi/{{ $pembayaran->id_pembayaran }}" class="btn btn-primary btn-sm mb-3"><i class="bi bi-printer me-2"></i>Cetak Kuitansi</a>

<section class="section">
    <div class="row">
        <div class="col">
            <div class="card p-3">
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <tr>
                            <td>NISN</td>
                            <td>:</td>
                            <td>{{ $pembayaran->siswa->nisn }}</td>
                        </tr>
                        <tr>
                            <td>Nama Siswa</td>
                            <td>:</td>
                            <td>{{ $pembayaran->siswa->nama }}</td>
                        </tr>
                        <tr>
                            <td>Nama kelas</td>
                            <td>:</td>
                            <td>{{ $pembayaran->siswa->kelas->nama_kelas }}</td>
                        </tr>
                        <tr>
                            <td>Pembayaran SPP</td>
                            <td>:</td>
                            <td>{{ $pembayaran->bulan_dibayar . ' | ' . $pembayaran->tahun_dibayar }}</td>
                        </tr>
                        <tr>
                            <td>Nominal</td>
                            <td>:</td>
                            <td>{{ convert_to_rupiah($pembayaran->jumlah_bayar) }}</td>
                        </tr>
                        <tr>
                            <td>Petugas</td>
                            <td>:</td>
                            <td>{{ $pembayaran->petugas->nama_petugas }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Bayar</td>
                            <td>:</td>
                            <td>{{ $pembayaran->tgl_bayar }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const theMessage  = $( 'div[name="msg_storage"]' ).data( 'message' );

    $(document).ready(function() {
        if ( theMessage ) {
            Swal.fire('', `${theMessage}`, 'success');
        }
    });
</script>
@endsection
