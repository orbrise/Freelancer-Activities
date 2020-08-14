@extends('frontend.layouts.home')

@section('content')
@if(!empty(session('successmsg'))) 
        <div class="notification success closeable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                {{session('successmsg')}} 
        </div> 
    @endif
    @if(!empty(session('errorsmsg'))) 
       <div class="notification error closeable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            {{session('errorsmsg')}} 
        </div>
    @endif
<div class="row">

                <!-- Dashboard Box -->
                <div class="col-xl-12">
                    <div class="dashboard-box">

                        <!-- Headline -->
                        <div class="headline">
                            <h3><i class="icon-line-awesome-gear"></i> Upload New Images</h3>
                        </div>

                        <div class="content">
                            <ul class="fields-ul">
                            <li>
                                <div class="row">
                                   
                                    <form action="{{route('gallarypost')}}" method="post" enctype="multipart/form-data">
										{{csrf_field()}}
  <div class="uploadButton margin-top-0">
												<input class="uploadButton-input" name="gallary[]" type="file" accept="image/*" id="upload" multiple="" required>
												<label class="uploadButton-button ripple-effect" for="upload">Upload Files</label>
												<span class="uploadButton-file-name">multiple images you can upload</span>
											</div>
  <input type="submit" value="Upload Image" name="Upload">
</form>

                                    

                                </div>
                            </li>
                        </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="dashboard-box">

                        <!-- Headline -->
                        <div class="headline">
                            <h3><i class="icon-line-awesome-gear"></i> Your Gallary</h3>
                        </div>
						
                        <form action="{{route('user.gallary.delete.multiple')}}" method="post">
                            {{csrf_field()}}
                            <button type="submit" style="margin:10px 10px" id="submit" class="button red">Delete Selected</button>
						<div class="categories-container">

					<!-- Category Box -->
				
					@if(!empty($images))
						@forelse($images as $img)
					<a href="#" class="category-box">
						<div class="category-box-icon">
							<img src="{{asset('public/assets/userimages')}}/{{$img->image_name}}">
						</div>
                        
						<div class="category-box-content" style="margin-top: 10px">
                            <p><div class="col-sm-2 checkbox">
                                     <input type="checkbox" name="deletimg[]" id="chekcbox2{{$img->id}}" value="{{$img->id}}">
                                     <label for="chekcbox2{{$img->id}}"><span class="checkbox-icon"></span></label>
                                     </div> <button type="button" onclick="location.href='{{route('user.gallary.delete', $img->id)}}'" class="button red ripple-effect">Delete</button></p>                  
                        </div>
					</a>
                    
                    
					@empty
					@endforelse
					@endif
            
                </div>
            </form>

				
					

				

					

					

				
					

				</div>

                        
                    </div>
                </div>
 
                
            </div>

@endsection

@push('js')
<script>
    $("#submit").hide();
$('input[type="checkbox"]').click(function(){
var atLeastOneIsChecked = $('input[name="deletimg[]"]:checked').length;
if(atLeastOneIsChecked >= 1)
{
    $("#submit").show();
} else {
    $("#submit").hide();
}
});

</script>
@endpush