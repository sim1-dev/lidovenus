@php
$order = \App\Order::where('delivered',"!=", 1)->count();
@endphp
<script> 

	$( document ).ready(function() {
		$(".badge").html(
			@if ($order)
			{{ $order }}
			@else
			"No Order"
			@endif
			);
	});


</script>