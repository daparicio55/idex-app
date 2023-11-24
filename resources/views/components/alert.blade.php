<div class="mt-3">
	@if (session('info'))
		<div class="alert alert-success" id='info'>
			<strong>{{session('info')}}</strong>
		</div>
	@endif
	@if (session('error'))
		<div class="alert alert-danger" id='error'>
			<strong>{{session('error')}}</strong>
		</div>
	@endif
</div>


<script>
    $(document).ready(function(){
		setTimeout(() => {
			$("#info").hide();
		}, 12000);
		});
		$(document).ready(function(){
			setTimeout(() => {
			$("#error").hide();
		}, 12000);
	});
</script>
