    <div class="alert @if(isset($alert_type)) alert-popup alert-{{ $alert_type }} @else alert-info @endif" id="session_alert">
        <b>{!! ucfirst($message) !!}</b>
    </div>
    <script>
        $("#session_alert").fadeTo(2000, 500).slideUp(500, function(){
            $("#session_alert").slideUp(500);
        });
    </script>