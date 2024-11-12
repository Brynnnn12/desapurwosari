<html>
<head>
    <title>Surat Keterangan Tidak Mampu</title>
    <link href="./output.css" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body >
    <div class=" p-10 rounded-lg shadow-lg ">
        <!-- Header -->
        <div class="text-center mb-6">
            <img alt="Logo Pemerintah Kabupaten Pemalang" class="mx-auto w-20 h-20 mb-4"  src="images/image.png"  />
            <h1 class="text-xl font-bold uppercase">PEMERINTAH KABUPATEN PEMALANG</h1>
            <h2 class="text-lg font-semibold">KECAMATAN COMAL</h2>
            <h2 class="text-lg font-semibold">DESA PURWOSARI</h2>
        </div>

        <!-- Title -->
        <div class="text-center mb-6">
            <h3 class="text-lg font-bold border-b pb-1">
                {{ $suratPengantar->jenisLayanan->nama_layanan }}            </h3>
            <p class="mt-2">
                Nomor: {{ $suratPengantar->nomor_surat }}
            </p>
        </div>

        <!-- Body of the letter -->
        <p class="mb-4">
            Yang bertanda tangan dibawah ini Kepala Desa Purwosari Kecamatan Comal Kabupaten Pemalang, menerangkan dengan sebenarnya bahwa warga kami :
        </p>

        <!-- Table for personal data (from user) -->
        <table class="w-full mb-6">
            <tr>
                <td class="font-semibold w-1/3">Nama</td>
                <td>: {{ $suratPengantar->user->name }}</td>
            </tr>
            <tr>
                <td class="font-semibold">Tempat / Tgl Lahir</td>
                <td>: {{ $suratPengantar->user->tempat_lahir }}, {{ $suratPengantar->user->tanggal_lahir }}</td>
            </tr>
            <tr>
                <td class="font-semibold">Jenis Kelamin</td>
                <td>: {{ $suratPengantar->user->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td class="font-semibold">Agama</td>
                <td>: {{ $suratPengantar->user->agama }}</td>
            </tr>
            <tr>
                <td class="font-semibold">Pekerjaan</td>
                <td>: {{ $suratPengantar->user->pekerjaan }}</td>
            </tr>
            <tr>
                <td class="font-semibold">Status Perkawinan</td>
                <td>: {{ $suratPengantar->user->status_perkawinan }}</td>
            </tr>
            <tr>
                <td class="font-semibold">Alamat</td>
                <td>: {{ $suratPengantar->user->alamat }}</td>
            </tr>
        </table>
        <!-- Statement -->
        <p class="mb-6">
            Bersama ini kami menerangkan bahwa warga tersebut di atas adalah warga Desa Purwosari yang belum memiliki Kartu Tanda Penduduk (KTP) dan sedang mengajukan permohonan pembuatan KTP untuk keperluan administrasi kependudukan.
        </p>

        <p class="mb-6">
            Demikian Surat Pengantar KTP ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.
        </p>

        <!-- Footer with date and signature -->
        <div class="text-right">
            <p>Purwosari, {{ now()->format('d F Y') }}</p>
            <p>Kepala Desa Purwosari</p>
        </div>

        <!-- Signature -->
        <div class="flex justify-end items-center ml-auto ">
            <div class="text-center">
                <img alt="Tanda Tangan Kepala Desa" class="mx-auto" height="100" src="images/signature.png" width="120" />
                <p class="mt-4 font-semibold">SAIFUDIN</p>
                <p>(SEKDES)</p>
            </div>
        </div>

        <!-- Print Button -->

    </div>

</body>
</html>
