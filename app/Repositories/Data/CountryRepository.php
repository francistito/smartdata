<?php

namespace App\Repositories\Data;

use App\Models\Data\Country;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CountryRepository extends BaseRepository
{
    const MODEL = Country::class;

    /*
     * store country
     */
    public function store(array $input)
    {
        $code = $input['country_code'];
        $country = $this->getCountryByCode($code);

        if ($country)
        {
            return $country;
        }else{
            return  DB :: transaction(function() use ($input){
                $country = $this->query()->create([
                    'name'=>$input['country_name'],
                    'code' =>$input['country_code']
                ]);
                return $country;
            });
        }

    }

    /*
     * get country by code
     */
    public function getCountryByCode($code)
    {
        return $this->query()->where('code', $code)->first();
    }

    /*Get all for Datatable EmployeeHistoryRecord*/
    public function getAllForDt()
    {
        $query = $this->query();
        return $query;
    }


}
