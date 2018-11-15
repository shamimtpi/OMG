@extends('backend.app')
@section('content')

<div class="tab_content">

  <h3 class="box_title">Pages
</h3>
        <table class="table table-striped table-hover table-bordered center_table" id="my_table">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Page Name</th>
                    <th>Page Link </th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <? $i=1; ?>
            @foreach($allData as $data)
                <tr>
                    <td>{{$i++}}</td>
                    <td><a href="{{route('pages.show',$data->id)}}">{{$data->name}}</a></td>
                    <td><a href="{{URL::to('page/'.$data->link)}}" target="_blank">{{URL::to('page/'.$data->link)}}</a></td>

                    <td><i class="{{($data->status==1)? 'fa fa-check success' : 'ion-ios-close danger'}}"></i></td>
                    <td>{{$data->created_at}}</td>
                    <td>
        {!! Form::open(array('route' => ['pages.destroy',$data->id],'method'=>'DELETE')) !!}
            <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
        {!! Form::close() !!}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
        {{$allData->render()}} 
        </div>
  </div>


@endsection
