<?php

namespace App\Repositories\Data;

use App\Models\Data\CountryPopulation;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CountryPopulationRepository extends BaseRepository
{
    const MODEL = CountryPopulation::class;
    /*
     * store country population
     */
    public function store(array $input,$country)
    {

        $country_id = $country->id;
        return  DB :: transaction(function() use ($input,$country_id){
            $population = $this->query()->create([
                'country_id'=>$country_id,
                'indicator_name' =>$input['indicator_name'],
                'year' =>$input['year'],
                'population' =>$input['population'],
            ]);
            return $population;
        });
    }


    //query staff leave
    public function queryAll()
    {
        return $this->query()
            ->select([
                DB::raw('country_populations.id as id'),
                DB::raw('country_populations.year as year'),
                DB::raw('country_populations.population as population'),
                DB::raw('country_populations.indicator_name as indicator_name'),
                DB::raw('countries.name as country_name'),
                DB::raw('countries.code as code'),
            ])
            ->join('countries', 'countries.id', '=', 'country_populations.country_id');

    }

    /*Get all for Datatable EmployeeHistoryRecord*/
    public function getAllForDt()
    {
        $query = $this->queryAll();
        return $query;
    }

}
