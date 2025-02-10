<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;

    protected $fillable = [
        'intervenant',
        'objects',
        'activites',
        'date_performance',
        'performance_value'
    ];


    protected $guarded = [];

    public function activiteObjectif()
    {
        return $this->belongsTo(DomaineValeurElement::class, 'activites',)
            ->with('objectif');
    }
    public static function getPerformancesJournalières($intervenantId, $date)
    {
        return self::where('intervenant', $intervenantId)
            ->whereDate('date_performance', Carbon::parse($date))
            ->selectRaw('activites, SUM(performance_value) as total_performance')
            ->groupBy('activites')
            ->with('activiteObjectif')
            ->get();
    }

    public static function getPerformancesJournalièresTous($date)
    {
        return self::whereDate('date_performance', Carbon::parse($date))
            ->selectRaw('intervenant, activites, SUM(performance_value) as total_performance')
            ->groupBy('intervenant', 'activites')
            ->with(['intervenantInfo', 'activiteObjectif'])
            ->get();
    }

    public function intervenantInfo()
    {
        return $this->belongsTo(Intervenant::class, 'intervenant');
    }
}
