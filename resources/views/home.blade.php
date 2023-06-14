@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Activity Summaries</h1>
</div>
<div class="row">
@role('super_admin')
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Users</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
        </div>
        <div class="col-auto">
          <i class="fa fa-users fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

@endrole

@role('member_admin|admin')
<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <a href="#" title="Total number of members registered on IAP.">
    <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Registered Members</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_members}}</div>
        </div>
        <div class="col-auto">
          <i class="fa fa-users fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
  </a>
</div>


<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">New Members</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$new_member}}</div>
        </div>
        <div class="col-auto">
          <i class="fa fa-users fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Old Members</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$old_member}}</div>
        </div>
        <div class="col-auto">
          <i class="fa fa-users fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
  <a href="#" title="Members have registered for IAP services but have not applied any services.">
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Registered Members Without Services</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$not_applied_services}}</div>
        </div>
        <div class="col-auto">
          <i class="fa fa-users fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
  </a>
</div>

<div class="col-xl-3 col-md-6 mb-4">
  <a href="#" >
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Registered Members With Services</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$members_applied_services}}</div>
        </div>
        <div class="col-auto">
          <i class="fa fa-users fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
  </a>
</div>

<div class="col-xl-3 col-md-6 mb-4">
  <a href="#">
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Registered Today</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$today_regis_members}}</div>
        </div>
        <div class="col-auto">
          <i class="fa fa-users fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</a>
</div>


</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Approval Summaries</h1>
</div>
<div class="row">

<div class="col-xl-3 col-md-6 mb-4">

  <a href="#{{-- {{url('approval/service_request/P/0')}} --}}" title="Members have applied for services but approval is pending by the administrator. Once the services is approved, email will be sent to the member for payments.">
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1" >Pending Services Before Payments</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pending_for_service}}</div>
        </div>
        <div class="col-auto">
          <i class="fa fa-users fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
  </a>
</div>
<div class="col-xl-3 col-md-6 mb-4">
  <a href="#{{-- {{url('approval/service_request/A/0')}} --}} " title="Members have payed for the approved services but the approval of payment is pending by the administrator.">
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Service Approved But Payment Pending</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pending_for_payment}}</div>
        </div>
        <div class="col-auto">
          <i class="fa fa-users fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
  </a>
</div>

<div class="col-xl-3 col-md-6 mb-4">
  <a href="" title="Members approved"></a>
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pending Members</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pending_member}}</div>
        </div>
        <div class="col-auto">
          <i class="fa fa-users fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Approved Members</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$active_member}}</div>
        </div>
        <div class="col-auto">
          <i class="fa fa-users fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- 
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Services</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_services}}</div>
        </div>
        <div class="col-auto">
          <i class="fa fa-users fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>
 --}}
<div class="col-xl-12 col-md-12 mb-4">
  <div class="card shadow">
    <div class="card-header">
      <h5 class="card-title font-weight-bold text-primary"> Paid Members Pending For Final Approval ({{count($services_pay)}})</h5>
    </div>
    <div class="card-body" style="height: 400px; overflow-y: scroll;">
      <div class="row">
        <div class="col-xl-12 col-md-12 col-sm-12 col-xl-12 table-responsive">
          <table class="table table-bordered">
            <thead >
              <tr>
                <th>#</th>
                <th>Service Name</th>
                <th>Member Name</th>
                <th>Member Type</th>
                <th>Service Amount</th>
                <th>Payment ID</th>
                <th>Service Type</th>
                <th>Payment Pay Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php $count = 0; @endphp
                @foreach($services_pay as $service)
                  <tr>
                    <td>{{++$count}}</td>
                    <td>
                      {{$service->service->name}}
                    </td>
                    <td>
                      {{member_name($service->member) }}
                    </td>
                    <td>{{$service->member->old_or_new != '1' ? 'New' : 'Old'}} Member</td>
                    <td>
                      <i class="fa fa-rupee"></i> {{$service->service->charges}}
                    </td>
                    <td>{{$service->payment_id}}</td>
                    <td>
                      {{$service->old_or_new == '0' ? 'New Service' : 'Old Service'}} 

                    </td>
                    <td>
                      {{date('d-m-Y',strtotime($service->updated_at))}}
                    </td>
                    <td>                     
                        <button class="btn btn-sm btn-success approveBtn" id="{{$service->id}}" data-id="{{$service->payment_id}}">Approve</button>  
                         {{-- <a class="declinedBtn text-white btn btn-sm btn-danger mt-2" id="{{$service->id}}" data-id="{{$service->payment_id}}">Declined</a>                     --}}
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>    
      </div> 
    </div>
  </div>
</div>

<div class="modal modal-fade model-lg " id="assignModalService">
  <div class="modal-dialog ">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Verify Payment ID Submited By User & Assign IAP Number</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>        
        </div>
         <div class="modal-body" >
          <div class="row">
            <div class="col-md-12 form-group">  
              {{Form::label('txn_id','Payment Transaction ID')}}
          {{Form::text('txn_id',old('txn_id'),['class' => 'form-control','readonly' => 'readonly'])}}   
            </div>  
          </div>
          <div class="row">         
        <div class="col-md-12 form-group">  
          {{Form::label('iap_no','Enter IAP Number')}}
          {{Form::text('iap_no',old('iap_no'),['class' => 'form-control','placeholder' => 'Enter IAP number','required' => 'required'])}}       
        </div>  
      </div>
      <div class="modal-footer">          
        {{Form::hidden('service_id','',['class' => 'service_id'])}}
        {{Form::submit('submit',['class' => 'btn btn-sm btn-success','id' => 'iapFormSubmit'])}}
      </div>
      </div>
    </div>              
  </div> 
</div>





<div class="modal modal-fade model-lg " id="delinedModalService">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Declined Payment ID Submited By User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>        
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 form-group">  
              {{Form::label('txn_id1','Payment Transaction ID')}}
              {{Form::text('txn_id1',old('txn_id1'),['class' => 'form-control','readonly' => 'readonly','id' => 'txn_id'])}}   
            </div>  
          </div>
          <div class="row">         
        <div class="col-md-12 form-group">  
          {{Form::label('payment_reason','Enter Reason')}}
          {{Form::textarea('payment_reason',old('payment_reason'),['class' => 'form-control','placeholder' => 'Enter Reason number','required' => 'required','id' => 'payment_reason'])}}       
        </div>  
      </div>
      <div class="modal-footer">          
        {{Form::hidden('service_id1','',['class' => 'service_id1', 'id' => 'service_id'])}}
        {{Form::submit('submit',['class' => 'btn btn-sm btn-success','id' => 'declinedSubmit'])}}
      </div>
      </div>
    </div>              
  </div> 
</div>



@endrole
{{-- <!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
            </div>
            <div class="col">
              <div class="progress progress-sm mr-2">
                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-warning shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
        </div>
        <div class="col-auto">
          <i class="fas fa-comments fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div> --}}
</div>

@role('member')
@if(!empty(service_check()))
  @if(service_check()->status == 'A')

    <div class="row">
      <div class="col-lg-11 m-auto alert-success p-2">    
          <h4 class="">Service active</h4>       
      </div>
    </div>
  @else
    <div class="row">
      <div class="col-lg-11 m-auto alert-warning p-2">
         @php $mem_doc = get_member_details(); @endphp
      @if($mem_doc->ten_doc != null && $mem_doc->twelve_doc != null && $mem_doc->internship_doc != null && $mem_doc->bpt_doc != null && $mem_doc->gov_proof != null && $mem_doc->gov_proof1 != null && $mem_doc->any_other_doc != null)
              @if(service_check()->status == 'S')
              <h4 class="">Service is declined by the IAP.</h4> 
              @else

            <h4 class="">Member service is not active please wait</h4> 
              @endif
      @else
            <h4 class="">All required documents are not uploaded. Please upload.</h4>
             <h6>{{doc_missing_notification()}}</h6>

      @endif      
      </div>
    </div>
  @endif
@else

  <div class="row">
    <div class="col-lg-11 m-auto alert-warning p-2">    
        @if(get_member_details()->old_or_new !=0)
          <h4 class="">All Existing / Old members should first apply for old member services. After Your Service is active, All details of your services can be previewed on the dashboard
         </h4> 
        @else
          @if(get_member_details()->member_type !=null)
          <h4 class="">Service is Created but can not be active until documents are not uploaded. Upload all required Documents.</h4> 
          <h6>{{doc_missing_notification()}}</h6>
          @else
          <h4 class="">Apply member service</h4>
          @endif
        @endif
    </div>
  </div>

@endif
@if(!empty(get_member_details()))
   @if(get_member_details()->gender != null)
     @include('member_dashboard')
   @endif
@endif
@endrole

<script>
  $(document).ready(function(){
      $(document).on('click','.approveBtn',function(e){
          // alert('test')
          e.preventDefault();
          $('input[name="txn_id"]').val($(this).data('id'));
          $('input[name="service_id"]').val($(this).attr('id'));
          $('#assignModalService').modal('show');
      });

      $(document).on('click','.declinedBtn',function(e){
          // alert('test')
          e.preventDefault();
          $('input[name="txn_id1"]').val($(this).data('id'));
          $('input[name="service_id1"]').val($(this).attr('id'));
          $('#payment_reason').val('');
          $('#delinedModalService').modal('show');
      });


      $(document).on('click','#iapFormSubmit',function(e){
        e.preventDefault();
        var iap_no = $('input[name="iap_no"]').val();
        var service_id = $('input[name="service_id"]').val();
        if(iap_no !=''){
          $.ajax({
            type:'POST',
            url:"{{url('/approval/payment_approve')}}",
            data:{service_id:service_id,iap_no:iap_no},
            success:function(res){
              $.notify(res, "success");
            setTimeout(window.location.reload(), 10000);
            }
          }); 
        }else{
          $.notify('Iap number field required.','error');
        }
      });


       $(document).on('click','#declinedSubmit',function(e){
        e.preventDefault();
        var payment_reason = $('#payment_reason').val();
        var service_id1 = $('input[name="service_id1"]').val();

    
        if(payment_reason.length !='6'){
          $.ajax({
            type:'POST',
            url:"{{url('/approval/payment_declined')}}",
            data:{service_id1:service_id1,payment_reason:payment_reason},
            success:function(res){
              // $.notify(res, "success");/
              // setTimeout(window.location.reload(), 10000);
            }
          }); 
        }else{
          $.notify('Payment Reason field required.','error');
        }
      });



  });

</script>
@endsection