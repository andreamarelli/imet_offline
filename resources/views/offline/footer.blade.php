<?php
use App\Helpers\SoftwareUpdater;
?>
<section id="imet_footer">
    <div>
        <span class="mr-4 font-bold">IMET Offline Tool</span>
        Version: <span class="version">{{ SoftwareUpdater::getCurrentVersion() }}</span>
        @if(SoftwareUpdater::isBetaChannel())
            Channel: <span class="channel">BETA</span>
        @endif
    </div>

</section>
