<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Data\Country;
use App\Repositories\Data\CountryPopulationRepository;
use App\Repositories\Data\CountryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DataController extends Controller
{


    /*
     * data index - list
     */
    public function index()
    {
        return view('data.index.index');
    }
    /*
     * upload data file
     */
    public function upload()
    {
        return view('data.includes.upload');
    }
    /*
     *store uploaded data
     */
    public function storeUploadedData()
    {
        $input = request()->all();
        $data = json_decode($input['json_data'], true);
        $collection = collect($data);
        $population_data = $collection;

        foreach ($population_data as $data)
        {
            $input = [
                'country_name' => $data['Country Name'],
                'country_code' => $data['Country Code'],
                'indicator_name' => $data['Indicator Name'],
//                'salary_loan' => $data['salary_loan'],
//                'other_deduction' => $data['other_deductions'],
//                'absent_deduction' => $data['absent_deduction'],
            ];
            /*
             * create country
             *
             */
            $country =  (new CountryRepository())->store($input);
            /*
             * create country population
             */
            $this->saveCountryPopulation($data,$country);
            //create employee
        }
        return redirect()->route('data.index');
        }
        /*
         * save population country
         */
        public function saveCountryPopulation($data,$country)
        {
            foreach ($data  as $key => $value) {
                if (strpos($key, 'Country Name') !== false || strpos($key, 'Country Code') !== false || strpos($key, 'Indicator Name') !== false) {

                }else{
                    $new_array = [
                        'year' =>$key,
                        'population' => $value,
                        'indicator_name' => $data['Indicator Name'],
                    ];

                    (new CountryPopulationRepository())->store($new_array,$country);
                }
            }
        }


        /*
         * get all for datatable
         */
        public function getAllForDt()
        {
            $result_list =(new CountryPopulationRepository())->getAllForDt()->orderByDesc('id');
            return DataTables::of($result_list)
                ->addIndexColumn()
                ->rawColumns([''])
                ->make(true);
        }

}
