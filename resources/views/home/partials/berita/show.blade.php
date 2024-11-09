@extends('home.layout')

@section('content')
<section class="py-8">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <h2 class="font-manrope text-4xl font-bold text-gray-900 text-center mb-14">Berita Desa</h2>
        <div class="flex justify-center mb-14 gap-y-8 lg:gap-y-0 flex-wrap md:flex-wrap lg:flex-nowrap lg:flex-row lg:justify-between lg:gap-x-8">
            @if (isset($beritas) && $beritas->isNotEmpty())
                @foreach ($beritas as $berita)
                    <div class="group cursor-pointer w-full max-lg:max-w-xl lg:w-1/3 border border-gray-300 rounded-2xl p-5 transition-all duration-300 hover:border-indigo-600">
                        <a href="{{ route('berita.show', ['slug' => $berita->slug]) }}">
                            <div class="flex items-center mb-6">
                                <img src="{{ $berita->foto ? asset('storage/' . $berita->foto) : 'default-image-url.jpg' }}" alt="{{ $berita->judul }}" class="rounded-lg w-full object-cover">
                            </div>
                            <div class="block">
                                <h4 class="text-gray-900 font-medium leading-8 mb-9">{{ $berita->judul }}</h4>
                                <div class="flex items-center justify-between font-medium">
                                    <h6 class="text-sm text-gray-500">By {{ $berita->user->name }}</h6> <!-- Menampilkan nama penulis -->
                                    <span class="text-sm text-indigo-600">{{ \Carbon\Carbon::parse($berita->tanggal_terbit)->diffForHumans() }}</span> <!-- Waktu terbit -->
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <p>Tidak ada berita untuk ditampilkan.</p>
            @endif
        </div>
        {{-- <a href="{{ route('berita.blog')}}" class="cursor-pointer border border-gray-300 shadow-sm rounded-full py-3.5 px-7 w-52 flex justify-center items-center text-gray-900 font-semibold mx-auto transition-all duration-300 hover:bg-gray-100">
view all        </a> --}}
    </div>
</section>

@endsection
