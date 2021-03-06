@extends('backend.app')
@section('content')
<style type="text/css">
  .form-group{margin:10px 0;}

</style>
<div class="tab_content col-md-12" style="padding-top:0;">
<h3 class="box_title">View Custom Order Attribute</h3>
    
    <hr class="col-md-12">
    <div class="col-md-12">

        <section class="panel">
            <header class="panel-heading">
              All Custom Order Attribute
                <span class="tools pull-right">
                <a href="{{URL::to('/customOrderAttribute')}}" class="btn btn-info">Add Custom Order Attribute</a>
                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                    <a href="javascript:;" class="fa fa-cog"></a>
                    <a href="javascript:;" class="fa fa-times"></a>
                 </span>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Custom Order Type Name</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <? $i=0; ?>
                    @foreach($customOrderAttributes as $data)
                      <?php $i++; ?>
                        
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->title}}</td>
                            <td>
                            <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$data->id}}"> View </a>

                                <!-- Modal -->
                            <div class="modal fade" id="myModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">View</h4>
                                  </div>
                                  <div class="modal-body">
                                    <table class="table table-bordered" cellspacing="0">
                                        <tr>
                                          <th width="50%">Sl No.</th>
                                          <td>{{ $i }}</td>
                                        </tr>
                                        <tr>
                                          <th width="50%">name</th>
                                          <td>{{ $data->name }}</td>
                                        </tr>
                                        
                                        <tr>
                                          <th width="50%">Custom Order Type Name</th>
                                          <td>{{ $data->title }}</td>
                                        </tr>
                                        
                                        <tr>
                                          <th width="50%">Created At</th>
                                          <td>{{ $data->created_at }}</td>
                                        </tr>
                                        
                                      </table>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    
                                  </div>
                                </div>
                              </div>
                            </div>
                            </td>
                            <td>
                            <!-- edit section -->
                            <a href="customOrderAttributeUpdate/<?php echo $data->id; ?>" class="btn btn-info waves-effect w-xs waves-light m-r-5 m-b-10"> Edit </a>
                            <!-- end edit section -->
                            </td>
                            <td>
                            <!-- delete section -->
                            {{Form::open(array('route'=>['customOrderAttribute.destroy',$data->id],'method'=>'DELETE'))}}
                            {{ Form::hidden('id',$data->id)}}
                              <button type="submit" class="btn btn-danger" onclick="return deleteConfirm()">Delete</button>
                            {!! Form::close() !!}
                            <!-- end delete section -->

                          </td>
                            
                        </tr>
                        
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
 
    </div>        
</div>

@endsection




<script type="text/javascript">

function deleteConfirm(){
  var con= confirm("Do you want to delete?");
  if(con){
    return true;
  }else 
  return false;
}
</script>

