@extends('layouts.app')

@section('content')
<div class="container">
@foreach($supports as $support)
	<form>
		<h3 class="py-3" id="pj_title"></h3>
		<div class="shadow-sm p-3 mb-5 bg-white rounded">
			<p class="py-3 " id="selected_support">支援内容</p>
			<div class="support_container">
				<table class="table selected_support_table">
					<tr>
						<th scope="row"><img src="../../../storage/{{$support->rw_image }}"></th>
						<td>
							<p>{{ $support->rw_title }}</p>
								<input type="hidden" name="rw_title" class="" value="{{ $support->rw_title }}">
							<p>限定 {{ $support->rw_quantity }} 個</p>
								<input type="hidden" name="rw_quantity" class="" value="{{ $support->rw_quantity }}">
							<p>¥ {{ number_format($support->rw_price) }}</p>
								<input type="hidden" name="rw_price" class="" value="¥ {{ number_format($support->rw_price) }}">
							<p>{{ $support->rw_body }}
								<input type="hidden" name="rw_body" class="" value="{{ $support->rw_body }}">
							<p>予定配送時期 {{ $support->rw_season }}
@endforeach
			</div>
		</div>
	</form>
</div>
@endsection
