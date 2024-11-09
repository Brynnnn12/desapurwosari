@extends('home.layout')

@section('content')

<div class="max-w-screen-lg mx-auto">
    <main class="mt-20">
        <div class="mb-4 md:mb-0 w-full mx-auto relative">

            <div class="px-4 lg:px-0">
                <h2 class="sm:text-2xl lg:text-4xl font-semibold text-gray-800 leading-tight mb-0 sm:mb-2 font-sans">
                    {{ $berita->judul }} <!-- Judul Berita -->
                </h2>

                <p class="flex justify-between items-center text-gray-600 mb-4 font-sans  sm:text-xs md:text-md lg:text-lg">

                    <span>
                        Dipublikasikan pada: {{ \Carbon\Carbon::parse($berita->tanggal_terbit)->format('d F Y') }} <!-- Tanggal Terbit -->
                    </span>


                </p>
            </div>

            <!-- Gambar berita -->
            @if($berita->foto)
                <img src="{{ asset('storage/' . $berita->foto) }}" class="w-full object-contain sm:object-cover lg:rounded" />
            @endif


        </div>

        <div class="flex flex-col lg:flex-row lg:space-x-12">
            <div class="px-4 lg:px-0 mt-2 sm:mt-6 text-gray-700 text-md leading-relaxed w-full lg:w-3/4 prose prose-lg prose-gray max-w-none font-sans">
                <!-- Isi Berita dengan efek drop cap pada paragraf pertama -->
                <p class="first-letter:text-6xl first-letter:font-bold first-letter:float-left first-letter:mr-4 first-letter:mt-1 first-letter:text-gray-900 first-letter:leading-none">
                    {!! nl2br(e($berita->isi)) !!}
                </p>
            </div>

            <div class="w-full lg:w-1/4 m-auto mt-2 sm:mt-12 max-w-screen-sm p-6 sm:p-0">
                <div class="p-4 border-t border-b md:border md:rounded">
                    <div class="flex py-2">
                        <img src="{{ Storage::url($berita->user->avatar) }}" alt="Avatar"
                             class="h-10 w-10 rounded-full mr-2 object-cover" />
                        <div>
                            <p class="font-semibold text-gray-700 text-sm font-serif">{{ $berita->user->name }}</p> <!-- Nama Penulis -->
                            @foreach ($berita->user->roles as $role)
                                <p class="font-semibold text-gray-600 text-xs font-sans">{{ $role->name }}</p>
                            @endforeach
                        </div>
                    </div>
                    <p class="text-gray-700 py-3 font-serif">
                        Penulis berbagi informasi dan wawasan terkini tentang teknologi dan inovasi.
                    </p>
                    <button class="px-2 py-1 text-gray-100 bg-green-700 flex w-full items-center justify-center rounded font-sans">
                        Follow
                        <i class='bx bx-user-plus ml-2'></i>
                    </button>
                </div>
                @if($berita->video) <!-- Pastikan $berita->video berisi path video -->
                <div class="mt-6 ml-2 lg:ml-0">
                    <h2 class=" mt-4 text-xl  font-semibold text-gray-800 font-sans">Video Terkait</h2>
                    <video class=" border mt-6 w-96 h-48 rounded-lg" controls>
                        <source src="{{ asset('storage/' . $berita->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endif
            </div>
        </div>

        <!-- Bagian Dilihat Juga -->
        <div class="mt-6 sm:mt-12">
            <h2 class="text-xl sm:text-3xl font-semibold text-gray-800 font-sans p-10 sm:p-0 md:p-6">Berita Lainnya</h2>
            <div class="mt-2 sm:mt-6 grid  grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-10 sm:p-0 md:p-6">
                @foreach($relatedBeritas as $relatedBerita)
                    <div class="border rounded-lg overflow-hidden shadow-lg transform transition-transform duration-500 hover:scale-105">
                        <a href="{{ route('berita.show', ['slug' => $relatedBerita->slug]) }}">
                            <img src="{{ $relatedBerita->foto ? asset('storage/' . $relatedBerita->foto) : 'default-image-url.jpg' }}"
                                 class="w-full h-48 object-cover" alt="{{ $relatedBerita->judul }}">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800 font-serif">{{ $relatedBerita->judul }}</h3>
                                <p class="text-gray-600 mt-2 font-sans">{{ \Str::limit($relatedBerita->isi, 50) }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>


    </main>
    <!-- main ends here -->

</div>
@endsection
