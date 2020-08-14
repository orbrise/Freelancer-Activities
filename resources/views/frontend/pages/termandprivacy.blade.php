@extends('frontend.layouts.master');
@section('content')
<div class="container">
	<div class="row">

		<div class="col-xl-12">
			<div class="mt-50  margin-bottom-50" style="margin-top:20px">
				{!! $page->content !!}
			</div>
		</div>

		</div>
</div>
@endsection

@push('js')

@endpush