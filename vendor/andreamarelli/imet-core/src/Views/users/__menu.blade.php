<?php
/** @var string $selected */

use \AndreaMarelli\ImetCore\Models\User\Role;

?>

<nav class="steps">
    @foreach(Role::all_roles() as $role)
        <a class="step @if($role===$selected) selected @endif "
           href="{{ route('imet-core::users', ['role_type' => $role]) }}">
            {{ ucfirst(trans_choice('imet-core::users.role.' . $role, 2)) }}
        </a>
    @endforeach
</nav>

@push('scripts')

    <style>
        nav.steps a.step{
            padding: 20px 10px;
            overflow-wrap: normal;
            min-width: auto;
        }
    </style>


@endpush
