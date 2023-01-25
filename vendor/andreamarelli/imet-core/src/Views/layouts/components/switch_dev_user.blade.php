<?php
use AndreaMarelli\ImetCore\Models\User\Role;

?>

@if(\App::environment('imetglobal_dev'))

    <li>
        <a>{!! \AndreaMarelli\ModularForms\Helpers\Template::icon('random', '', '', 'fa-lg') !!} Change USER</a>
        <ul class="language_selector">

            @foreach(Role::all_roles() as $role)
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('switch_to_{{ $role }}_user-form').submit();">
                        {{ $role }}
                    </a>
                    <form id="switch_to_{{ $role }}_user-form" action="{{ route('imet-core::change_user') }}" method="POST" class="d-none">
                        <input type="hidden" name="imet_role" value="{{ $role }}" />
                        @csrf
                    </form>
                </li>
            @endforeach

        </ul>
    </li>
@endif
