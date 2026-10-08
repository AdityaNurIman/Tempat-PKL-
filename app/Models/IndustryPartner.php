<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IndustryPartner extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'industry_sector',
        'city',
        'address',
        'vocational_majors',
        'total_quota',
        'filled_quota',
        'allowance',
        'duration',
        'requirements',
        'job_description',
        'mentor_name',
        'contact_email',
        'is_verified',
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(PklApplication::class);
    }

    public function getAvailableQuotaAttribute(): int
    {
        return max(0, $this->total_quota - $this->filled_quota);
    }

    public function getMajorsListAttribute(): array
    {
        return array_map('trim', explode(',', $this->vocational_majors));
    }
}
