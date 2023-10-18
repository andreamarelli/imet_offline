<?php

namespace AndreaMarelli\ImetCore\Models\Imet;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ImetScores extends Model
{
    /**
     * @var string[]
     */
    protected $table = 'imet.imet_scores';
    protected $fillable = ['FormID', 'scores'];
    protected $casts = [
        'scores' => 'json'
    ];

    public const CREATED_AT = 'UpdateDate';
    public const UPDATED_AT = 'UpdateDate';

    /**
     * Indicates whether the `updated_at` timestamp should always be updated.
     *
     * @var bool
     */
    protected $alwaysUpdateUpdatedAt = true;

    /**
     * Update the model's update timestamp when using updateOrInsert or updateOrCreate.
     *
     * @return bool
     */
    protected function shouldUpdateUpdatedAt(): bool
    {
        return $this->alwaysUpdateUpdatedAt;
    }

    /**
     * Manually update the "updated_at" timestamp.
     *
     * @return $this
     */
    public function touch()
    {
        $this->timestamps = false;
        $this->UpdateDate = $this->freshTimestamp();
        $this->save();
        $this->timestamps = true;
        Log::info('Job Polulate Imet Scores : update timestamp ' . $this->UpdateDate . ' to ' . $this->freshTimestamp());
        return $this;
    }
}
