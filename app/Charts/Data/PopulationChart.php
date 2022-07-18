<?php

namespace App\Charts\Data;

use App\Repositories\Data\CountryPopulationRepository;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;


class PopulationChart extends Chart
{

    protected $arr;
    protected $sum_arr;

    /**
     * Initializes the chart.
     *
     */
    public function __construct()
    {
        parent::__construct();

    }

    public function getChartView()
    {
        $transactionRepo = new CountryPopulationRepository();



        $yesterday = Carbon::now()->subDays(6);
        $arr = [];
        $sum_arr = [];
        $days = 7;
        while ($days) {
            $sum = $transactionRepo->query()->sum("population");
            $arr[] = $yesterday->format('d M');
            $sum_arr[] = $sum;
            $yesterday->addDay();
            $days--;
        }
        $this->labels($arr);
//        $this->dataset(trans('label.sms_traffic'), 'line', $sum_arr)->color('#000000')->backgroundColor('#a1650e');
        $this->dataset(trans('population'), 'line', $sum_arr);
    }
}
