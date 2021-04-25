<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;

class ChartController extends Controller
{
    /**
     * @throws \Exception
     */
    function getAllDates(): array {
        $daysArr = [];
        $monthsArr = [];

        $ordersDates = Order::orderBy('created_at')->pluck('created_at')->toArray();

        if(!empty($ordersDates)) {
            foreach($ordersDates as $date) {
                $day = Carbon::parse($date)->format('D');
                $dayNo = Carbon::parse($date)->format('d');
                $month = Carbon::parse($date)->format('M');
                $monthNo = Carbon::parse($date)->format('m');

                $daysArr[$dayNo] = $day;
                $monthsArr[$monthNo] = $month;
            }
        }

        return array('days' => $daysArr, 'months' => $monthsArr);
    }

    function getDailyOrderCount($day = null) {
        //  Where Day/Month/Year/Time/Date --- --- --- --- --- --- --- --- --- --- LARAVEL WHERE FUNCTIONS
        if(!$day) {
            $day === Carbon::now()->format('d');
        }

        return Order::whereDay('created_at', $day)->count();
    }

    function getMonthlyOrderCount($month = null) {
        //  Where Day/Month/Year/Time/Date --- --- --- --- --- --- --- --- --- --- LARAVEL WHERE FUNCTIONS
        if(!$month) {
            $month === Carbon::now()->format('m');
        }

        return Order::whereMonth('created_at', $month)->count();
    }

    function getTimelyOrderData(): array {
        $datesArr = $this->getAllDates();
        $dailyOrderCountArr = [];
        $monthlyOrderCountArr = [];

        if(!empty($datesArr)) {
            foreach($datesArr['days'] as $dayNo => $day) {
                $dailyOrderCount = $this->getDailyOrderCount($dayNo);
                $dailyOrderCountArr[] = $dailyOrderCount;
            }

            foreach($datesArr['months'] as $monthNo => $month) {
                $monthlyOrderCount = $this->getMonthlyOrderCount($monthNo);
                $monthlyOrderCountArr[] = $monthlyOrderCount;
            }
        }

        return [
            'days' => array_values($datesArr['days']),
            'months' => array_values($datesArr['months']),
            'dailyCountData' => $dailyOrderCountArr,
            'monthlyCountData' => $monthlyOrderCountArr,
            'maxDay' => round((max($dailyOrderCountArr) + 5) / 10) * 10,
            'maxMonth' => round((max($monthlyOrderCountArr) + 5) / 10) * 10,
        ];
    }
}
