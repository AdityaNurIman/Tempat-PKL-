<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PklApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'industry_partner_id',
        'student_name',
        'nisn',
        'school_name',
        'major',
        'whatsapp_number',
        'guardian_teacher_name',
        'internship_period',
        'portfolio_url',
        'status',
        'notes',
    ];

    public function partner(): BelongsTo
    {
        return $this->belongsTo(IndustryPartner::class, 'industry_partner_id');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'review_school' => 'Menunggu Verifikasi Sekolah',
            'accepted' => 'Diterima DUDI',
            'rejected' => 'Belum Memenuhi Syarat',
            default => 'Dalam Proses',
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'review_school' => 'bg-amber-100 text-amber-900 border-amber-300',
            'accepted' => 'bg-emerald-100 text-emerald-900 border-emerald-300',
            'rejected' => 'bg-rose-100 text-rose-900 border-rose-300',
            default => 'bg-slate-100 text-slate-800 border-slate-300',
        };
    }
}
