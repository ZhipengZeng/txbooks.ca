<!-- views/layouts/sidebar.blade.php -->

<div class="col-lg-12">
<div id="cssmenu">
    <ul>
        @foreach(App\School::all() as $key => $school)
            @if($key == 7)
                <li class="has-sub last"><a href=""><span>{{ $school['school_name'] }}</span></a>
            @else
                <li class="has-sub"><a href=""><span>{{ $school['school_name'] }}</span></a>
            @endif
            <ul>
                <?php $programs = App\Program::where('school_id', '=', $school['id'])->get();
                  end($programs); $end = key($programs); ?>
                @foreach( $programs as $key => $program)
                    @if($key == $end)
                    <li class="last"><a href="{{ URL::route('getBooks', array('id'=>$program['id'])) }}"><span>{{ $program['program_name'] }}</span></a></li>   
                    @else
                    <li><a href="{{ URL::route('getBooks', array('id'=>$program['id'])) }}"><span>{{ $program['program_name'] }}</span></a></li>   
                    @endif
                @endforeach
            </ul>
            </li>
        @endforeach
    </ul>
</div>
</div>
<!-- sidebar's stylesheet -->
@section('style')
@parent

<style type="text/css">
    
#cssmenu {
  padding: 0;
  margin: 0;
  border: 0;
}
#cssmenu ul,
li {
  list-style: none;
  margin: 0;
  padding: 0;
}
#cssmenu ul {
  position: relative;
  z-index: 597;
  float: left;
}
#cssmenu ul li {
  float: left;
  min-height: 1px;
  line-height: 1em;
  vertical-align: middle;
}
#cssmenu ul li.hover,
#cssmenu ul li:hover {
  position: relative;
  z-index: 599;
  cursor: default;
}
#cssmenu ul ul {
  /*visibility: hidden;*/
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 598;
  width: 100%;
}
#cssmenu ul ul li {
  float: none;
}
#cssmenu ul li:hover > ul {
  /*visibility: visible;*/
  display: block;
}
#cssmenu ul ul {
  top: 0;
  left: 100%;
}
#cssmenu ul li {
  float: none;
}
/* Custom Stuff */
#cssmenu {
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  -moz-background-clip: padding;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  -moz-box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.15);
  -webkit-box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.15);
  box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.15);
  /*width: 200px;*/
}
#cssmenu span,
#cssmenu a {
  display: inline-block;
  font-family: Arial, Helvetica, sans-serif;
  font-size: 12px;
  text-decoration: none;
}
#cssmenu:after,
#cssmenu ul:after {
  content: '';
  display: block;
  clear: both;
}
#cssmenu > ul > li:first-child {
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
  -moz-background-clip: padding;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
}
#cssmenu > ul > li:last-child {
  -moz-border-radius: 0 0 5px 5px;
  -webkit-border-radius: 0 0 5px 5px;
  border-radius: 0 0 5px 5px;
  -moz-background-clip: padding;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
}
#cssmenu > ul > li ul ul {
  -moz-border-radius: 0 6px 6px 0;
  -webkit-border-radius: 0 6px 6px 0;
  border-radius: 0 6px 6px 0;
  -moz-background-clip: padding;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
}
#cssmenu > ul > li ul ul li:first-child {
  -moz-border-radius: 0 5px 0 0;
  -webkit-border-radius: 0 5px 0 0;
  border-radius: 0 5px 0 0;
  -moz-background-clip: padding;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
}
#cssmenu > ul > li ul ul li:last-child {
  -moz-border-radius: 0 0 5px 0;
  -webkit-border-radius: 0 0 5px 0;
  border-radius: 0 0 5px 0;
  -moz-background-clip: padding;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
}
#cssmenu ul,
#cssmenu li {
  width: 100%;
}
#cssmenu li {
  background: #dddddd url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAJCAMAAAA8eE0hAAAAUVBMVEX////MzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzNzc3l5eXg4ODZ2dnMzMzi4uLS0tLe3t7Q0NDV1dXj4+PW1tbk5OTc3NzPz8/R0dH0Zv5RAAAAC3RSTlMAM2YekAmlPHuEAwArv7wAAAA/SURBVHheY2Dl5mdigABGKV5BNnYok4dHQpKFGcrkEefj5gAzQUBABM7kFYQyRcX4mUBMkEpOLrA2IWGwfgYAn0UDZszv8IwAAAAASUVORK5CYII=) repeat-x;
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #e5e5e5), color-stop(1, #dddddd));
  background-image: -webkit-linear-gradient(top, #e5e5e5, #dddddd);
  background-image: -moz-linear-gradient(top, #e5e5e5, #dddddd);
  background-image: -ms-linear-gradient(top, #e5e5e5, #dddddd);
  background-image: -o-linear-gradient(top, #e5e5e5, #dddddd);
  background-image: linear-gradient(#e5e5e5, #dddddd);
}
#cssmenu li:hover {
  background: #f6f6f6;
}
#cssmenu a {
  color: #666666;
  line-height: 160%;
  padding: 11px 28px 11px 28px;
  /*width: 144px;*/
}
#cssmenu ul ul {
  /*width: 200px;*/
  border: 1px solid #dddddd;
  -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
  -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
}
#cssmenu ul ul li {
  background: #f6f6f6;
}
#cssmenu ul ul li:hover {
  background: #dddddd;
}
#cssmenu ul ul li:hover a {
  color: #AE0001;
}
#cssmenu ul ul li ul li {
  background: #dddddd;
}
#cssmenu ul ul li ul li:hover {
  background: #b7b7b7;
}
#cssmenu .has-sub {
  position: relative;
}
#cssmenu .has-sub:after,
#cssmenu .has-sub > ul > .has-sub:hover:after {
  content: '';
  display: block;
  width: 10px;
  height: 9px;
  position: absolute;
  right: 5px;
  top: 50%;
  margin-top: -5px;
  background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAJCAMAAAA8eE0hAAAAUVBMVEX////MzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzNzc3l5eXg4ODZ2dnMzMzi4uLS0tLe3t7Q0NDV1dXj4+PW1tbk5OTc3NzPz8/R0dH0Zv5RAAAAC3RSTlMAM2YekAmlPHuEAwArv7wAAAA/SURBVHheY2Dl5mdigABGKV5BNnYok4dHQpKFGcrkEefj5gAzQUBABM7kFYQyRcX4mUBMkEpOLrA2IWGwfgYAn0UDZszv8IwAAAAASUVORK5CYII=);
  -moz-transform: rotate(360deg);
  -o-transform: rotate(360deg);
  -ms-transform: rotate(360deg);
  -webkit-transform: rotate(360deg);
  transform: rotate(360deg);
}
#cssmenu .has-sub > ul > .has-sub:after,
#cssmenu .has-sub:hover:after {
  background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAJCAMAAAA8eE0hAAAAUVBMVEX////d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3e3t729vbx8fHq6urd3d3z8/Pj4+Pv7+/h4eHm5ub09PTn5+f19fXt7e3g4ODi4uLUsVdlAAAAC3RSTlMAM2YekAmlPHuEAwArv7wAAAA/SURBVHheY2Dl5mdigABGKV5BNnYok4dHQpKFGcrkEefj5gAzQUBABM7kFYQyRcX4mUBMkEpOLrA2IWGwfgYAn0UDZszv8IwAAAAASUVORK5CYII=);
}

</style>
@endsection

@section('script')
@parent

<script type="text/javascript">
    $('#cssmenu li.active').children('ul').show();
    $('#cssmenu li.has-sub>a').on('click', function(){
        $(this).removeAttr('href');
        var element = $(this).parent('li');
        if (element.hasClass('active')) {
            element.removeClass('active');
            element.find('li').removeClass('active');
            element.find('ul').slideUp();
        }
        else {
            element.addClass('active');
            element.children('ul').slideDown();
            element.siblings('li').children('ul').slideUp();
            element.siblings('li').removeClass('active');
            element.siblings('li').find('li').removeClass('active');
            element.siblings('li').find('ul').slideUp();
        }
    });
</script>
@endsection
