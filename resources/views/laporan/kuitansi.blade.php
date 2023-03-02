<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kuitansi</title>

	<style type="text/css">
		body {
			font-family: sans-serif;
		}

		main {
			width: 80%;
			margin: auto;
		}

		h1 {
			text-align: center;
			margin-bottom: 20px;
		}

		hr {
			margin-bottom: 20px;
		}

		table {
			width: 100%;
			margin: auto;
			margin-bottom: 20px;
		}

		.date {
			margin-bottom: 60px;
		}
	</style>
</head>
<body>
	<h1>Kuitansi Pembayaran</h1>

	<main>
		<hr>
		<table>
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

		<hr>
		<p class="date">Sumedang, {{ date('d M Y') }}<br>Bendahara</p>
		<p>{{ $pembayaran->petugas->nama_petugas }}</p>
	</main>
</body>
</html>
