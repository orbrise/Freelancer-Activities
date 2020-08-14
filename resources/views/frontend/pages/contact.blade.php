@extends('frontend.layouts.master');
@section('content')
<div class="container">
	<div class="row">

	

		<div class="col-xl-8 col-lg-8 offset-xl-2 offset-lg-2">

			<section id="contact" class="margin-bottom-60">
				<h3 class="headline margin-top-15 margin-bottom-35">Any questions? Feel free to contact us!</h3>

					<div class="row">
						<div class="col-md-6">
							<div class="input-with-icon-left">
								<input class="with-border" name="name" type="text" id="name" placeholder="Your Name" required="required" />
								<i class="icon-material-outline-account-circle"></i>
							</div>
						</div>

						<div class="col-md-6">
							<div class="input-with-icon-left">
								<input class="with-border" name="email" type="email" id="email" placeholder="Email Address" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required="required" />
								<i class="icon-material-outline-email"></i>
							</div>
						</div>
					</div>

					<div class="input-with-icon-left">
						<input class="with-border" name="subject" type="text" id="subject" placeholder="Subject" required="required" />
						<i class="icon-material-outline-assignment"></i>
					</div>

					<div>
						<textarea class="with-border" name="comments" cols="40" rows="5" id="comments" placeholder="Message" spellcheck="true" required="required"></textarea>
					</div>

					<input type="button" class="submit button margin-top-15" id="submit" value="Submit Message" />
					<div id="resinsert"></div>

			</section>

		</div>

	</div>
</div>
@endsection

@push('js')
<script>
	$("#submit").click(function(){
		var csrf = $("meta[name='_token']").attr('content');
		var name = $("#name").val();
		var email = $("#email").val();
		var subject = $("#subject").val();
		var comments = $("#comments").val();
		$.post("{{route('postcontact')}}",{_token:csrf, name:name,email:email,subject:subject,comments:comments}, function(data){
			$('#resinsert').html(data);
		});

	});
</script>
@endpush