{{-- File: resources/views/portofolio.blade.php --}}

@extends('layouts.app')



@section('title', 'Portofolio — Arya Advertising')



@section('content')



    {{-- HEADER PAGE --}}

    <div class="bg-primary-dark text-white py-5 mb-5" style="background-color: var(--primary-dark); margin-top: 80px;">

        <div class="container text-center">

            <h1 class="fw-bold">Portofolio Kami</h1>

            <p class="lead">Kumpulan hasil karya terbaik yang telah kami kerjakan</p>

        </div>

    </div>



    {{-- GALERI GRID --}}

    <div class="container pb-5">

        <div class="row g-4">

            @forelse($galleries as $gallery)

                <div class="col-md-4 col-sm-6" data-aos="fade-up">

                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden group">

                        <div class="position-relative overflow-hidden" style="height: 280px;">

                            <img src="{{ $gallery->image_url }}" 

                                 class="w-100 h-100 object-fit-cover transition-transform duration-500 hover:scale-110" 

                                 alt="{{ $gallery->title }}"

                                 style="transition: transform 0.5s ease;">

                            

                            {{-- Overlay info saat hover --}}

                            <div class="position-absolute bottom-0 start-0 w-100 p-3 text-white bg-dark bg-opacity-75">

                                <h5 class="fw-bold mb-1">{{ $gallery->title }}</h5>

                                <small class="text-white-50">{{ $gallery->service->nama_layanan ?? 'Project' }}</small>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12 text-center py-5">

                    <img src="{{ asset('images/empty.svg') }}" alt="Kosong" style="width: 150px; opacity: 0.5;">

                    <p class="mt-3 text-muted">Belum ada portofolio yang ditambahkan.</p>

                </div>

            @endforelse

        </div>



        {{-- PAGINATION --}}

        <div class="d-flex justify-content-center mt-5">

        {{ $galleries->onEachSide(1)->links('pagination::bootstrap-5') }}

        </div>

    </div>



@endsection



@push('styles')

<style>

    /* Hover effect zoom gambar */

    .card:hover img {

        transform: scale(1.1);

    }

</style>

@endpush