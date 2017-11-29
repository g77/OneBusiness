@extends('layouts.custom')

@section('content')
<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-9">
                <h4>CRR COLLECTION</h4>
                
              </div>
              <div class="col-xs-3">
                <div class="pull-right">
                  <a href="{{ route('branch_remittances.create', ['corpID' => $corpID]) }}">Add Collection</a>
                  
                </div> 
              </div>
            </div>
          </div>

          <div class="panel-body" style="margin: 30px 0px;">
            <div class="row" style="margin-bottom: 20px;">
              <form class="col-xs-3 pull-right" method="GET">
                <select name="status" class="form-control" >
                  <option value="checked">Checked</option>
                  <option value="unchecked">Unchecked</option>
                </select>
              </form>
            </div>
            @if($remittance_collections->count())
            <form action="">
              <table class="table table-striped table-bordered">
                <tbody>
                  <tr>
                    <th >TXN No.</th>
                    <th>Date/Time</th>
                    <th>Pick-up Teller</th>
                    <th>Subtotal</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  @foreach($remittance_collections as $remittance_collection)
                    <tr class="text-center">
                      <td>{{ $remittance_collection->ID }}</td>
                      <td>{{ $remittance_collection->Time_Create ? $remittance_collection->Time_Create->format('Y-m-d H:i a') : "" }}</td>
                      <td>{{ $remittance_collection->user()->first()->Full_Name }}</td>
                      <td>{{ $remittance_collection->Total_Collection }}</td>
                      <td>
                        <input type="checkbox" name="status" id="" onclick="return false;" >
                      </td>
                      <td>

                        <a href="{{ route('branch_remittances.show', [$remittance_collection, 'corpID' => $corpID]) }}" style="margin-right: 10px;" 
                          class="btn btn-success btn-xs"
                          title="View">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('branch_remittances.edit', [$remittance_collection, 'corpID' => $corpID]) }}" style="margin-right: 10px;" 
                          class="btn btn-primary btn-xs"
                          title="Edit">
                          <i class="fa fa-pencil"></i>
                        </a>

                        <a href="{{ route('branch_remittances.destroy', [$remittance_collection, 'corpID' => $corpID]) }}" style="margin-right: 10px;" 
                          class="btn btn-danger btn-xs"
                          title="Delete">
                          <i class="fa fa-trash"></i>
                        </a>

                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </form>
            @else
              <div class="error">
                Not found
              </div>
            @endif

            <div class="row">
              <div class="col-md-4">
                <form class="" id="date_range" action="{{ route('branch_remittances.index', ['corpID' => $corpID]) }}" method="GET">
                  <input type="hidden" name="corpID" value="{{$corpID}}">
                  <div class="checkbox col-xs-12">
                    <label for="" class="control-label">
                      <input type="checkbox" {{$checked ? 'checked': ""}} id="view_date_range" value="1">
                      View by Date Range
                    </label>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-6">
                        <input type="date" name="start_date" id="start_date" {{ $checked ? '': 'disabled="true"' }} class="form-control datepicker " value="{{$start_date}}">
                      </div>
                      <div class="col-xs-6">
                        <input type="date" name="end_date" id="end_date"  {{ $checked ? '': 'disabled="true"' }}  class="form-control datepicker"  value="{{$end_date}}">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-12">
                        <button id="button_ranger_date" {{ $checked ? '': 'disabled="true"' }} class="btn btn-primary">Show</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="row" style="margin-top: 20px;" >
              <div class="col-xs-12">
                <button class="btn btn-default">
                  <i class="fa fa-reply"></i>
                  Back
                </button>
              </div>
              
            </div>
          </div>
          
        </div>
      </div>
    </div>
</section>
@endsection