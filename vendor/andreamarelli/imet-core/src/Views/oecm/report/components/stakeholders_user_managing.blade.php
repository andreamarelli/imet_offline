<?php
/** @var array $stake_holders */
?>

<h4>2. @lang('imet-core::oecm_report.stakeholder_users_managing_oecm')</h4>
<table>
    <tr>
        <th>
            <b>@lang('imet-core::oecm_report.stakeholder_direct_users')</b>
        </th>
        <th>
            <b>@lang('imet-core::oecm_report.stakeholder_indirect_users') </b>
        </th>
    </tr>
    <tr>
        <td>
            <table>
                @foreach($stake_holders['direct'] as $key => $elem)
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-8">{{ $key }}</div>
                                <div class="col-4 text-left">{{ $elem }}</div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </td>
        <td>
            <table>
                @foreach($stake_holders['indirect'] as $key => $elem)
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-8">{{ $key }}</div>
                                <div class="col-4 text-left">{{ $elem }}</div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
</table>
