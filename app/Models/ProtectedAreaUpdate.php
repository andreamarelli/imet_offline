<?php

namespace App\Models;

use AndreaMarelli\ImetCore\Models\ProtectedArea;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class ProtectedAreaUpdate extends Model
{
    protected $table = 'imet_pas_update';
    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = ['country', 'last_update_date'];

    /**
     * Get last update date for each country
     */
    public static function getUpdated(): array
    {
        $pas_iso = array_combine(ProtectedArea::getCountriesISO(), array_fill(0, count(ProtectedArea::getCountriesISO()), null));
        $updates = ProtectedAreaUpdate::all()
            ->map(function ($item) {
                $item->last_update_date = Carbon::parse($item->last_update_date)->format('Y-m');
                return $item;
            })
            ->pluck('last_update_date', 'country')
            ->toArray();

        return array_merge($pas_iso, $updates);
    }

    /**
     * Set last update date for a country
     */
    public static function setUpdated(string $country): void
    {
        ProtectedAreaUpdate::updateOrCreate(
            ['country' => $country],
            ['last_update_date' => Carbon::now()]
        );
    }

}
