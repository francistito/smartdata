
<div class="row">
    <div class="col-md-4">
        <input class="form-control input-rounded " type="text" id="myInputTextField" placeholder="Search Employee">

    </div>
    <div class="col-md-6">

{{--        <div class="dropdown mb-2 mt-2">--}}
{{--            <a onclick="showSearchDropdown()" class="dropbtn"><i class="fa fa-search fa-1x"></i> </a>--}}

{{--            <div id="advanced_search_dropdown" class="dropdown-content">--}}


{{--                <label>{{trans('label.status')}}</label>--}}
{{--                {{ Form::select('client_status',[1 =>trans('label.active'),0=>trans('label.inactive')],null,['class'=>'form-control form-control-sm search_input','', 'id' => 'client_status','placeholder' => 'All', 'autocomplete' => 'off']) }}--}}


{{--                <label>{{trans('label.client.client_type')}}</label>--}}
{{--                {{ Form::select('client_type',[1 =>trans('label.company'),0=>trans('label.individual')],null,['class'=>'form-control form-control-sm search_input','', 'id' => 'client_type','placeholder' => 'All', 'autocomplete' => 'off']) }}--}}


{{--                <label>{{trans('label.other_criteria')}}</label>--}}
{{--                {{ Form::select('other_criteria',$other_criteria_options,null,['class'=>'form-control form-control-sm search_input','', 'id' => 'other_criteria','placeholder' => 'All', 'autocomplete' => 'off']) }}--}}

{{--                <button type="button" class="mb-1 mt-1 ml-2  btn btn-light search" id="reset"  style="border-radius: 55px;border-width:3px; border-color:#5bc0de;  padding: 5px 15px 5px 15px;" data-title="reset">{{trans('label.reset')}} <span class="caret"></span></button>--}}

{{--                <button type="button" class="mb-1 mt-1 btn btn-info pull-right search" id="search"  data-type="1" style="border-radius: 55px;padding: 5px 15px 5px 15px;" data-title="search">{{trans('label.search')}} <span class="caret"></span></button>--}}
{{--            </div>--}}

{{--        </div>--}}
    </div>
</div>

@push('after-scripts')
<script>
    function showSearchDropdown() {
        document.getElementById("advanced_search_dropdown").classList.toggle("show");
    }

    /*reset search on advance search*/
    $("#reset").click(function () {
        clearOfferingSearchInputs();
        hide_show('hide_id', 'reset_summary');
    });


    /*clear advance search for offering*/
    function clearOfferingSearchInputs() {
        $('.search_input').val(null).change();
        $('.radio_check_offering_input').prop('checked', false);

    }

</script>

@endpush
