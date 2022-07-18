
{{ Form::open(['route' => 'dashboard', 'autocomplete' => 'off','method' => 'get', 'name' => 'create', 'class' => 'needs-validation', 'novalidate' , ]) }}
<div class="row">
    <div class="col-sm-12 ">
        <div class="row ">
            <div class="col-md-2">
                <div class="form-group">
                    <div class="form-group">
                        {{ Form::select('country_id',$countries,null, ['id'=>'country_id', 'class' => 'form-control select2','placeholder' => 'All', 'autocomplete'=>"off",
                        'style' =>  'background-color:
                        white;']) }}
                    </div>
                </div>
            </div>

            <div class="col-md-2" style="color:#1f90ff;">
                <div class="form-group ">
                    <div class="form-group pull-left">
                        {{ Form::button(trans('Search'),['class' => 'btn btn-xs btn-primary site-btn save_button', 'type'=>'submit']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
