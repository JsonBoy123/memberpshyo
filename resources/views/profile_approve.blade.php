@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 ml-3 text-gray-800">Activity Summaries</h1>
</div>

{{-- @if(!empty(service_check()))
   @if(service_check()->status == 'A')
      <div class="row">
         <div class="col-lg-11 m-auto alert-success p-2">    
            <h4 class="">Your profile is approve, </h4>       
         </div>
      </div>
   @endif
@endif --}}

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
      @if(session('success'))
         <div class="col-lg-11 m-auto alert alert-success p-2 h4 text-center">    
             {{ session('success') }}
         </div>
      
      @else
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
      @endif

  </div>

@endif
@if(!empty(get_member_details()))
@if(get_member_details()->gender != null)
@include('member_dashboard')
@endif
@endif

@endsection