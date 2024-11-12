<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Tidak Mampu</title>
    <style>
        body {
            background-color: #f3f4f6; /* bg-gray-100 */
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 48rem; /* max-w-3xl */
            margin: 0 auto;
            padding: 2.5rem; /* p-10 */
            background-color: #ffffff; /* bg-white */
            border-radius: 0.5rem; /* rounded-lg */
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1); /* shadow-lg */
        }

        .text-center {
            text-align: center;
        }

        .mb-6 {
            margin-bottom: 0.5rem;
        }

        .w-10{
            width: 80px;
        }

        .font-bold {
            font-weight: 700;
        }

        .font-semibold {
            font-weight: 600;
        }

        .text-xl {
            font-size: 1.25rem;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .border-b {
            border-bottom: 1px solid #000;
        }

        .pb-1 {
            padding-bottom: 0.25rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .w-full {
            width: 100%;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .mr-4 {
            margin-right: 1rem;
        }

        .mr-8 {
            margin-right: 2rem;
        }

        .text-right {
            text-align: right;
            margin-bottom: 2rem;
        }

        .flex {
            display: flex;
            justify-content: flex-end;
            margin-top: 1rem;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .font-semibold {
            font-weight: 600;
        }

        .ttd {
            width: 80px;
        }

        /* Adjusting signature and name position */
        .signature-container {
            text-align: right;
            margin-top: 1rem; /* Space for the signature */
        }

        .signature-container img {
            width: 5rem; /* Adjust size of signature */
        }

        .signature-container p {
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="text-center mb-6">
            <img src="{{ public_path('assets/images.png') }}" class="w-10" alt="Logo">
            <h1 class="text-xl font-bold uppercase">PEMERINTAH KABUPATEN PEMALANG</h1>
            <h2 class="text-lg font-semibold">KECAMATAN COMAL</h2>
            <h2 class="text-lg font-semibold">DESA PURWOSARI</h2>
        </div>

        <!-- Title -->
        <div class="text-center mb-6">
            <h3 class="text-lg font-bold border-b pb-1">
                {{ $suratPengantar->jenisLayanan->nama_layanan ?? 'Nama Layanan Tidak Tersedia' }}
            </h3>
            <p class="mt-2">Nomor: {{ $suratPengantar->nomor_surat ?? 'Nomor Surat Tidak Tersedia' }}</p>
        </div>

        <!-- Body of the letter -->
        <p class="mb-4">Yang bertanda tangan di bawah ini Kepala Desa Purwosari Kecamatan Comal Kabupaten Pemalang, menerangkan dengan sebenarnya bahwa warga kami:</p>

        <!-- Table for personal data (from user) -->
        <table class="w-full mb-6">
            <tr>
                <td class="font-semibold" style="width: 33%;">Nama</td>
                <td>: {{ $suratPengantar->user->name ?? 'Data tidak tersedia' }}</td>
            </tr>
            <tr>
                <td class="font-semibold">Tempat / Tgl Lahir</td>
                <td>: {{ $suratPengantar->user->tempat_lahir ?? 'Data tidak tersedia' }}, {{ \Carbon\Carbon::parse($suratPengantar->user->tanggal_lahir)->format('d F Y') ?? 'Data tidak tersedia' }}</td>
            </tr>
            <tr>
                <td class="font-semibold">Jenis Kelamin</td>
                <td>: {{ $suratPengantar->user->jenis_kelamin ?? 'Data tidak tersedia' }}</td>
            </tr>
            <tr>
                <td class="font-semibold">Agama</td>
                <td>: {{ $suratPengantar->user->agama ?? 'Data tidak tersedia' }}</td>
            </tr>
            <tr>
                <td class="font-semibold">Pekerjaan</td>
                <td>: {{ $suratPengantar->user->pekerjaan ?? 'Data tidak tersedia' }}</td>
            </tr>
            <tr>
                <td class="font-semibold">Status Perkawinan</td>
                <td>: {{ $suratPengantar->user->status_perkawinan ?? 'Data tidak tersedia' }}</td>
            </tr>
            <tr>
                <td class="font-semibold">Alamat</td>
                <td>: {{ $suratPengantar->user->alamat ?? 'Data tidak tersedia' }}</td>
            </tr>
        </table>

        <!-- Statement -->
        <p class="mb-6">Bersama ini kami menerangkan bahwa warga tersebut di atas adalah warga Desa Purwosari yang belum memiliki Kartu Tanda Penduduk (KTP) dan sedang mengajukan permohonan pembuatan KTP untuk keperluan administrasi kependudukan.</p>

        <p class="mb-6">Demikian Surat Pengantar KTP ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>

        <!-- Footer with date and signature -->
        <div class="text-right">
            <p>Purwosari, {{ now()->format('d F Y') }}</p>
            <p>Kepala Desa Purwosari</p>
        </div>

        <!-- Signature -->
        <div class="signature-container">
            <img class="ttd" src="{{ public_path('assets/signature.png') }}" alt="Tanda Tangan Kepala Desa">
            <p class="font-semibold">SAIFUDIN</p>
            <p>(SEKDES)</p>
        </div>
    </div>
</body>
</html>
