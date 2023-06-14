@extends('dashboard.layouts.master')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Services</h1>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">{{$service->name}}
						{{link_to('/service/'.$service->id, $title = 'Back', $attributes = ['class' => 'btn btn-sm btn-primary pull-right'], $secure = null)}}
					</h5>
				</div>
				<div class="card-body">
					<h4 class="text-center">Coming Soon...</h4>
					<p class="text-center">Our website is currently undergoing scheduled maintenance. </p>
					<p class="text-center">We should be back shortly. Thankyou for your patience.</p>
				</div>
			</div>
		</div>
	</div>
@endsection