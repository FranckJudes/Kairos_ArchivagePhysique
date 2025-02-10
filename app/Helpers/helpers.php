<?php
use App\Models\JourFerier;
use Illuminate\Support\Carbon;


if(!function_exists('getWorkingDaysInMonth')){
    function getWorkingDaysInMonth($year, $month)
    {
        $startDate = Carbon::create($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();

        // Récupérer tous les jours fériés du mois en une seule requête
        $holidays = JourFerier::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->pluck('date')
            ->toArray();

        $workingDays = 0;

        while ($startDate <= $endDate) {
            if (!$startDate->isWeekend() && !in_array($startDate->format('Y-m-d'), $holidays)) {
                $workingDays++;
            }
            $startDate->addDay();
        }

        return $workingDays;
    }
//
//    function getWorkingDays($startDate, $endDate)
//    {
//        // Récupérer tous les jours fériés dans l'intervalle donné
//        $holidays = JourFerier::whereBetween('date', [$startDate, $endDate])
//            ->pluck('date')
//            ->toArray();
//
//        $workingDays = 0;
//
//        while ($startDate <= $endDate) {
//            if (!$startDate->isWeekend() && !in_array($startDate->format('Y-m-d'), $holidays)) {
//                $workingDays++;
//            }
//            $startDate->addDay();
//        }
//
//        return $workingDays;
//    }
//
//    // ✅ Jours ouvrés pour un mois donné
//    function getWorkingDaysInMonth($year, $month)
//    {
//        $start = Carbon::create($year, $month, 1);
//        $end = $start->copy()->endOfMonth();
//        return getWorkingDays($start, $end);
//    }
//
//// ✅ Jours ouvrés pour un trimestre (Q1, Q2, Q3, Q4)
//    function getWorkingDaysInQuarter($year, $quarter)
//    {
//        $start = Carbon::create($year, ($quarter - 1) * 3 + 1, 1);
//        $end = $start->copy()->addMonths(2)->endOfMonth();
//        return getWorkingDays($start, $end);
//    }
//
//// ✅ Jours ouvrés pour un semestre (S1 ou S2)
//    function getWorkingDaysInSemester($year, $semester)
//    {
//        $start = Carbon::create($year, $semester == 1 ? 1 : 7, 1);
//        $end = $start->copy()->addMonths(5)->endOfMonth();
//        return getWorkingDays($start, $end);
//    }
//
//// ✅ Jours ouvrés pour toute l'année
//    function getWorkingDaysInYear($year)
//    {
//        $start = Carbon::create($year, 1, 1);
//        $end = Carbon::create($year, 12, 31);
//        return getWorkingDays($start, $end);
//    }
}
