<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'articles';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public function project(){
        return $this->belongsTo(Project::class);
    }
    protected $fillable = [
        'project_id',
        'page_id',
        'name',
        'content',
        'topics',
        'notes',
        'status',
        'dt_requested',
        'dt_received',
        'dt_drafted',
        'dt_published',
        'dt_promoted',
        'marketing',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
