@extends('layouts.app')

@section('content')
	<div class="container">
	@foreach($users as $user)
		<form action="{{ route('member.edit', ['id' => $user->id]) }}" method="POST">
			<p class="mt-5" id="selected_reward">会員情報</p>
			<table class="table shipping_table">
				<thead class="thead-light">
				<tr>
					<th scope="row">氏名</th>
						<td class="w-75">
							<input type="text" name="name" readonly class="form-control-plaintext" id="name" value="{{ $user->name }}">
						</td>
				</tr>
				<tr>
					<th scope="row">フリガナ</th>
						<td class="w-75">
							<input type="text" name="name_kana" readonly class="form-control-plaintext" id="name_kana" value="{{ $user->name_kana }}">
						</td>
				</tr>
				<tr>
					<th scope="row">郵便番号</th>
						<td class="w-75">
							<input type="text" name="post_code" readonly class="form-control-plaintext" id="post_code" value="〒{{ $user->post_code }}">
						</td>
				</tr>
				<tr>
					<th scope="row">都道府県市区町村</th>
						<td class="w-75">
							<input type="text" name="address" readonly class="form-control-plaintext" id="address" value="{{ $user->address }}">
				</tr>
				<tr>
					<th scope="row">番地・建物名</th>
						<td class="w-75">
							<input type="text" name="building" readonly class="form-control-plaintext" id="building" value="{{ $user->building }}">
						</td>
				</tr>
				<tr>
					<th scope="row">電話番号</th>
						<td class="w-75">
							<input type="text" name="tel" readonly class="form-control-plaintext" id="tel" value="{{ $user->tel }}">
						</td>
				</tr>
				<tr>
					<th scope="row">ステータス</th>
						<td class="w-75">
							<div id="status">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="enable"  v-on:change="handler" value="1" @if ($user->status == 1) checked @endif>
									<label class="form-check-label" for="enable">有効</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="unsubscribe" v-on:change="handler" value="2" @if ($user->status == 2) checked @endif>
									<label class="form-check-label" for="unsubscribe">退会</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="disable" v-on:change="handler" value="3" @if ($user->status == 3) checked @endif>
									<label class="form-check-label" for="disable">無効</label>
								</div>
								<p v-if="show">
									<input type="text" class="form-control" name="dis_reason" id="dis_reason" placeholder="無効理由を入力" value="{{ $user->dis_reason }}">
								</p>
							</div>
						</td>
				</tr>
		@endforeach
			</table>
			@csrf
			<div id="edit">
				<button type="submit" class="btn btn-primary float-right" name="action" @click="success">ステータスを変更する</button>
			</div>
		</form>
	</div>
@endsection

@section('scripts')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection
