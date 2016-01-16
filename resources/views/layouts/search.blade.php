<!-- views/layouts/search.blade.php -->
<div class="container" id="content">    
  	{!! Form::open(array('route' => 'search', 'method' => 'get', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'form_search', 'name' => 'form_search')) !!}
        
        <div id="custom-search-input">
            <div class="input-group col-md-12">
                {!! Form::text('search', Input::get('search'), 
            	array('class' => 'form-control input-lg','placeholder' => 'Search TITLE here')) !!}
                <span class="input-group-btn">
                    <button class="btn btn-info btn-lg" type="submit" form="form_search">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </span>
            </div>
        </div>
    {!! Form::close() !!} 
    
</div>