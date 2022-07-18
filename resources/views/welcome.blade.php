@extends('layouts.main', ['title' => 'Home', 'header' => isset($page_title) ?  $page_title  :__("label.home") ])


@push('after-styles')
    <style>

    </style>
@endpush

@section('content')


    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">overview</h2>
                        <button class="au-btn au-btn-icon au-btn--blue">
                            <a href="{{route('data.upload')}}" class="text-light">
                            <i class="zmdi zmdi-plus"></i>Upload data</a></button>
                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="text">
                                    <h2>{{$total_countries}}</h2>
                                    <span>Total Countries</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">

                                <div class="text">
                                    <h2>{{$max_population}}</h2>
                                    <span>Highest Population</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">

                                <div class="text">
                                    <h2>{{$total_population}}</h2>
                                    <span>Total Population</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.search_home')
                    <div class="au-card recent-report">
                        <div class="au-card-inner">

                            <div class="recent-report__chart">

                                <canvas id="myChart" width="50" height="50"></canvas>

{{--                                <canvas id="recent-rep-chart"></canvas>--}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>



@endsection

@push('after-scripts')
    {!! Html::script(url("https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js
")) !!}
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        {{--var  data = JSON::parse({{$population_by_country}});--}}
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['1990', '1991', '1992', '1993', '1994', '1995','1996','1997', '1998', '1999', '2000', '2001', '2002','2003','2004', '2005', '2006', '2007', '2008', '2008','20010','2011', '2012', '2013', '2014', '2015', '2016','2017','2018', '2019','2020'],
                datasets: [{
                    label: 'Report',
                    data: '{{$population_by_country}}',
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

@endpush
