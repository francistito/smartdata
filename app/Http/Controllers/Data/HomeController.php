<?php

namespace App\Http\Controllers\Data;

use App\Charts\Data\PopulationChart;
use App\Http\Controllers\Controller;
use App\Models\Data\Country;
use App\Models\Data\CountryPopulation;
use App\Repositories\Data\CountryPopulationRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function dashboard()
    {
        $input = request()->all();
        $pop_chart = new PopulationChart();
        $pop_chart->getChartView();
        $countries = Country::all();
        $total_countries = $countries->count();
        $population_by_country = CountryPopulation::select('population')->where('country_id',$input['country_id'])->pluck('population');
        $population_year= CountryPopulation::where('country_id',251)->pluck('year');
        $total_population = CountryPopulation::all()->sum('population');
        $max_population = CountryPopulation::all()->max('population');

        return view('welcome')
            ->with('population_by_country',strip_tags(json_encode($population_by_country)))
            ->with('total_population',$total_population)
            ->with('countries',$countries->pluck('name','id'))
            ->with('pop_chart',$pop_chart)
            ->with('max_population',$max_population)
            ->with('total_countries',$total_countries);
    }
}
