@extends('layouts.app')

@section('title', $title)

@section('content')
<section class="max-w-4xl mx-auto px-4 py-10 text-[#06003F]">
    <h1 class="text-center text-4xl font-bold mb-10">Tentang Kami</h1>

    <article class="prose lg:prose-lg text-lg text-[#06003F] space-y-6 mb-4 prose-p:text-justify text-justify">
        <p>
            Nama <strong>VoiceLib</strong> merupakan akronim dari kata “Voice” dan “Library”. VoiceLib diharapkan dapat menjadi perantara bagi mahasiswa tunanetra Universitas Negeri Malang dalam memenuhi kebutuhan informasi mereka. VoiceLib merupakan salah satu bentuk implementasi transformasi layanan perpustakaan berbasis inklusi, sehingga seluruh sivitas akademika dapat mengakses informasi secara adil dan merata, termasuk mahasiswa tunanetra. Platform ini memanfaatkan teknologi alih media <em>text-to-speech</em> yang secara otomatis mengonversi teks, seperti abstrak tugas akhir, menjadi format audio. Dengan demikian, VoiceLib diharapkan dapat menyajikan akses informasi akademik yang lebih mudah, kapan saja, dan di mana saja.
        </p>
        <p>
            Produk ini dikembangkan oleh <strong>Risa Annisa</strong> sebagai bagian dari tugas akhirnya pada Program Studi D4 Perpustakaan Digital, Universitas Negeri Malang, di bawah bimbingan <strong>Ibu Inawati, S.I.P., M.M</strong>. Pengembangan VoiceLib juga memperhatikan pedoman aksesibilitas konten web (<em>WCAG</em>) untuk memastikan aksesibilitasnya bagi seluruh pengguna.
        </p>
    </article>

</section>
@endsection
