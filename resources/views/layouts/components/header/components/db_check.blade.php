@if(!App::environment('production') &&
    substr_count(env('DB_HOST'), 'pgsql96-srv3.jrc.org')>0)

    <br />
    <div class="wrap">
        <div class="alert alert-danger" role="alert">
            <b>WARNING!!!</b>
            Database connection points to PRODUCTION!!!
        </div>
    </div>

@endif