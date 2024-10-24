
<!-- Incluse this for debug js records -->
<b>RECORDS</b>
<div class="text-sm" v-for="item in Object.entries(records)">
    <div><b>@{{ item[0] }}</b>: @{{ item[1] }}</div>
</div>
<b>BACKUP</b>
<div class="text-sm" v-for="item in Object.entries(records_backup)">
    <div><b>@{{ item[0] }}</b>: @{{ item[1] }}</div>
</div>
