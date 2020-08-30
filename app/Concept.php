<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Rorecek\Ulid\HasUlid;
use App\ConceptRealVote;

class Concept extends Model
{
    use HasUlid;


    public $incrementing = false;
  	protected $keyType = 'string';

    protected $guarded = [
        'id'
    ];

    protected $attributes = [
        'votes' => 0,
        'additional_votes' => 0,
        'additional_votes_ratio' => 0,
        'actions' => 0,
        'actions_ratio' => 0,
        'start_rate' => 10
    ];

    protected $casts = [
        'total_votes' => 'integer',
    ];

    protected $appends = ['total_votes'];


    public function scopeFreeword($query, $freeword)
    {
        $query->whereRaw("match(`content`) against (? WITH QUERY EXPANSION)", [$freeword]);
    }

    public function getTotalVotesAttribute()
    {
        return ConceptRealVote::where('concept_id',$this->id)->sum('value');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function upper_covers()
    {
        return $this->hasMany('App\Cover','lower_concept_id');
    }
    public function lower_covers()
    {
        return $this->hasMany('App\Cover','upper_concept_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

}
