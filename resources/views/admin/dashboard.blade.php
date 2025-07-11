@extends('layouts.admin')
@section('title')
Dashboard
@endsection

@section('content')
<div id="dashboard-section">
	<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
		<!-- Summary Cards -->
		<div class="bg-white rounded-lg shadow p-6">
			<div class="flex items-center">
				<div class="p-3 rounded-full bg-blue-100 text-blue-600">
					<i class="fas fa-briefcase text-xl"></i>
				</div>
				<div class="ml-4">
					<p class="text-sm font-medium text-gray-500">Portfolio Items</p>
					<p class="text-2xl font-semibold text-gray-800">{{ $portofolio }}</p>
				</div>
			</div>
		</div>
		<div class="bg-white rounded-lg shadow p-6">
			<div class="flex items-center">
				<div class="p-3 rounded-full bg-blue-100 text-blue-600">
					<i class="fas fa-comments text-xl"></i>
				</div>
				<div class="ml-4">
					<p class="text-sm font-medium text-gray-500">Product Items</p>
					<p class="text-2xl font-semibold text-gray-800">{{$product}}</p>
				</div>
			</div>
		</div>
		<div class="bg-white rounded-lg shadow p-6">
			<div class="flex items-center">
				<div class="p-3 rounded-full bg-blue-100 text-blue-600">
					<i class="fas fa-envelope text-xl"></i>
				</div>
				<div class="ml-4">
					<p class="text-sm font-medium text-gray-500">Feedback</p>
					<p class="text-2xl font-semibold text-gray-800">{{$feedback}}</p>
				</div>
			</div>
		</div>
	</div>

	<!-- Recent Activity -->
	<!-- <div class="bg-white rounded-lg shadow p-6 mb-6">
		<h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Activity</h2>
		<div class="space-y-4">
			<div class="flex items-start">
				<div class="p-2 rounded-full bg-blue-100 text-blue-600">
					<i class="fas fa-plus"></i>
				</div>
				<div class="ml-3">
					<p class="text-sm font-medium text-gray-800">Added new portfolio item "Mobile App"</p>
					<p class="text-xs text-gray-500">2 hours ago</p>
				</div>
			</div>
			<div class="flex items-start">
				<div class="p-2 rounded-full bg-blue-100 text-blue-600">
					<i class="fas fa-edit"></i>
				</div>
				<div class="ml-3">
					<p class="text-sm font-medium text-gray-800">Updated product description</p>
					<p class="text-xs text-gray-500">4 hours ago</p>
				</div>
			</div>
			<div class="flex items-start">
				<div class="p-2 rounded-full bg-blue-100 text-blue-600">
					<i class="fas fa-trash"></i>
				</div>
				<div class="ml-3">
					<p class="text-sm font-medium text-gray-800">Removed outdated testimonial</p>
					<p class="text-xs text-gray-500">1 day ago</p>
				</div>
			</div>
		</div>
	</div> -->
</div>
@endsection
@section('script')
@endsection