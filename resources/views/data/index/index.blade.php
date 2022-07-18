@extends('layouts.main', ['title' => 'Upload data', 'header' => __("Upload data") ])

@include('includes.datatable_assets')
@section('content')

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <section class="card mb-4">
                {{--Start: Datatable--}}
                <div class="card-body">

                    {{--            @include('hr.employee.includes.employee_summary')--}}
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Country population</h3>
                        </div>
                        <div class="col-auto float-end ms-auto">
                            <a href="{{route('data.upload', 18) }}" class="btn  btn-outline-success"><i class="fas fa-file-excel"></i> {{__('Upload data') }}</a>
                        </div>
                    </div>

                    <br/>
                    <div class="row">
                        <div class="col-md-6">
                                                @include('data.includes.advance_search')
                        </div>
                        <div class="col-md-6">
                            <div class="pull-right">
                                {{--                        @include('operation.stock.offering.includes.general.column_visibility')--}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover  table-responsive-md" id="population-table">
                                <thead>
                                <tr>
                                    <th>@lang('Sn')</th>
                                    <th class="dt_column" id="dt_col1">{{__('Country Name') }}</th>
                                    <th class="dt_column col_vis_false" id="dt_col2">{{__('Country Code') }}</th>
                                    <th class="dt_column" id="dt_col4">{{__('Indicator Name') }}</th>
                                    <th class="dt_column" id="dt_col5">{{__('Year') }}</th>
                                    <th class="dt_column" id="dt_col6">{{__('Population') }}</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


@endsection

@push('after-scripts')


    <script type="text/javascript">
        var url = "{{url("/") }}";
        function columnSetting() {
            document.getElementById("column_setting_dropdown").classList.toggle("show");
        }

        $(function () {
            var table =     $('#population-table').DataTable({
                processing: true,
                serverSide: true,
                dom: 'lrtip',
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,

                ajax:{
                    url : '{{route('data.get_all_for_dt') }}',
                    type : 'get'
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    { data: 'country_name', name: 'countries.name', orderable: true, searchable: true },
                    { data: 'code', name: 'countries.code', orderable: true, searchable: true },
                    { data: 'indicator_name', name: 'indicator_name', orderable: false, searchable: false },
                    { data: 'year', name: 'year', orderable: false, searchable: false },
                    { data: 'population', name: 'population', orderable: false, searchable: false },
                ],
            });


            // view client
            $(document).on('click','#view_employee',function (e) {
                var data = table.row( $(this).parents('tr') ).data();
                document.location.href = url + "/hr/employee/profile/" + data.uuid ;
            });
            // edit client
            $(document).on('click','#edit_employee',function (e) {
                var data = table.row( $(this).parents('tr') ).data();
                document.location.href = url + "/hr/employee/edit/" + data.uuid ;
            });
            //custom search
            $('#myInputTextField').keyup(function(){
                table.search($(this).val()).draw() ;
            });


        })


    </script>
@endpush
