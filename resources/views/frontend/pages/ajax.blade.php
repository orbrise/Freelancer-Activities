@if(!empty($services))
<style>
    select.bs-select-hidden, select.selectpicker {
    display: block !important;
}

.cust {padding:10px;}

</style>
					<select name="s" class="selectpicker cust">
						<option value="">Select </option>
						@forelse($services as $service)
						<option value="{{$service->id}}">{{$service->name}}</option>
						@empty
						@endforelse
						
					</select>


@endif


