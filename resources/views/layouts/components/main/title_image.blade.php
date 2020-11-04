<section class="container-fluid header-image">
    <div class="wrap">
        <img src="{{ asset('images') }}{{ isset($image_url) ? $image_url : '/ofac.jpg' }}" alt="Forêts d'Afrique Centrale">
        <h1>
            {{ $title }}
            <span class="subtitle">{{ $slot }}</span>
        </h1>
    </div>
</section>