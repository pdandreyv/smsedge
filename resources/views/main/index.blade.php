@extends('layout')

@section('content')
<h1>SMSEdge</h1>

<form action="" method="post">
    {{ csrf_field() }}
    Date From<span style="color:red">*</span>: <input id="date_from" type="date" name="date_from" value="{{$post['date_from']}}"> &nbsp; 
    Date To<span style="color:red">*</span>: <input id="date_to" type="date" name="date_to" value="{{$post['date_to']}}"> &nbsp; 
    User: <select name="usr_id">
        <option value="0">All</option>
        @foreach($users as $d)
            @if ($post['usr_id'] == $d->usr_id)
                <option value="{{$d->usr_id}}" selected>{{$d->usr_name}}</option>
            @else
                <option value="{{$d->usr_id}}">{{$d->usr_name}}</option>
            @endif
        @endforeach
    </select> &nbsp; 
    Country: <select name="cnt_id">
        <option value="0">All</option>
        @foreach($countries as $d)
            @if ($post['cnt_id'] == $d->cnt_id)
                <option value="{{$d->cnt_id}}" selected>{{$d->cnt_title}} ({{$d->cnt_code}})</option>
            @else
                <option value="{{$d->cnt_id}}">{{$d->cnt_title}} ({{$d->cnt_code}})</option>
            @endif
        @endforeach
    </select> &nbsp; 
    <input type="submit">
</form>

@if(count($data))
<table border="1">
    <tr>
        <th>Date</th>
        <th>Successfully</th>
        <th>Failed</th>
    </tr>
    @foreach($data as $d)
        <tr>
            <td>{{$d->date_at}}</td>
            <td>{{$d->success}}</td>
            <td>{{$d->failed}}</td>
        </tr>
    @endforeach
</table>
@else
    <div class="no-data">No Data. Select date inderval and other filters</div>
@endif

  <script>
  $( function() {
    var dateFormat = "yy-mm-dd",
      from = $( "#date_from" )
        .datepicker({
          defaultDate: "-5d",
          changeMonth: true,
          numberOfMonths: 1,
          dateFormat: dateFormat
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#date_to" ).datepicker({
        defaultDate: "now",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat: dateFormat
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
  </script>

@endsection