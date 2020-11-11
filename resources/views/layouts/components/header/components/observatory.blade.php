<section id="home_title">
    <h1>
        <span class="label">
        @if (\App::getLocale()==='fr')
                Des connaissances aux services de tous
            @else
                Knowledge for everybody
            @endif
        </span>
        @if (\App::getLocale()==='fr')
            Observatoire des forêts d’Afrique Centrale
        @else
            Central Africa Forest Observatory
        @endif
    </h1>
    <a href="{{ url('/') }}/analytical_platform" class="btn-nav big rounded">
        @if (\App::getLocale()==='fr')
            Nouveau portail de l'OFAC
        @else
            New OFAC portal
        @endif
    </a>
</section>
