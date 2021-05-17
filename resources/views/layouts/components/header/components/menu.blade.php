    <?php
    $breadcrumbs = App\Library\Ofac\Breadcrumbs::get();
?>



<nav id="menu">

    <ul class="menu-header">

        <li {!! ($breadcrumbs[0]=='ofac') ? 'class="selected"' : '' !!}>
            <a href="{{ url('/') }}/ofac/observatory">@lang('layout.menu.ofac.ofac')</a>
            <ul>
                <?php
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'ofac', 'observatory');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'ofac', 'activity');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'ofac', 'projects_appui');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'ofac', 'partners');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'ofac', 'contacts');
                ?>
            </ul>
        </li>


        <li {!! ($breadcrumbs[0]=='africa') ? 'class="selected"' : '' !!}>
            <a href="{{ url('/') }}/africa/context_physical">@lang('layout.menu.africa.africa')</a>
            <ul>
                <?php
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'africa', 'context_physical');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'africa', 'biodiversity');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'africa', 'forest_ecosystems');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'africa', 'ap');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'africa', 'forest_management');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'africa', 'context_human');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'africa', 'context_legal');
                ?>
            </ul>
        </li>

        <li {!! ($breadcrumbs[0]=='monitoring_system') ? 'class="selected"' : '' !!}>
            <a href="{{ url('/') }}/analytical_platform">@lang('layout.menu.monitoring_system.monitoring_system')</a>
            <ul>
                <?php
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'monitoring_system', 'introduction', url('/').'/monitoring_system/monitoring_system');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'monitoring_system', 'analytical_platform', url('/').'/analytical_platform');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'monitoring_system', 'national_indicators', url('/').'/monitoring_system/national_indicators/n1');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'monitoring_system', 'conservation');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'monitoring_system', 'concessions');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'monitoring_system', 'national_synthesis');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'monitoring_system', 'regional_synthesis');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'monitoring_system', 'imet');
                ?>
            </ul>
        </li>

        <li {!! ($breadcrumbs[0]=='activity_competencies') ? 'class="selected"' : '' !!}>
            <a href="{{ url('/') }}/activity_competencies">@lang('layout.menu.activity_competencies.activity_competencies')</a>
            <ul>
                <?php
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'activity_competencies', 'projects');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'activity_competencies', 'experts');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'activity_competencies', 'trainings');
                ?>
            </ul>
        </li>

        <li {!! ($breadcrumbs[0]=='publications') ? 'class="selected"' : '' !!}>
            <a href="{{ url('/') }}/publications/edf">@lang('layout.menu.publications.publications')</a>
            <ul>
                <?php
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'publications', 'edf');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'publications', 'edap', '/publications/edap');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'publications', 'other_publications');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'publications', 'library');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'publications', 'policy_briefs');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'publications', 'newsletter');
                ?>
            </ul>
        </li>

        <li {!! ($breadcrumbs[0]=='cartography') ? 'class="selected"' : '' !!}>
            <a href="{{ url('/') }}/cartography/geoportal">@lang('layout.menu.cartography.cartography')</a>
            <ul>
                <?php
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'cartography', 'geoportal', '/geo/ofacgeo/');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'cartography', 'download', '/gisrepository/');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'cartography', 'products');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'cartography', 'atlas', '/geo/atlas/');
                    echo App\Library\Utils\Template::menuItem($breadcrumbs[1], 'cartography', 'inventory');
                ?>
            </ul>
        </li>

    </ul>

</nav>
