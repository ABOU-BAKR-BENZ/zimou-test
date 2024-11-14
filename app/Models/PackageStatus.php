<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PackageStatus extends Model
{
    use HasFactory;

    protected $table = "package_statuses";

    protected $fillable = [
        'name'
    ];

    /**
     * Get all of the packages for the PackageStatus
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function packages(): HasMany
    {
        return $this->hasMany(Package::class);
    }
}
