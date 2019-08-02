@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('member.list') }}">会員一覧</a></li>
<li class="breadcrumb-item active" aria-current="page">会員情報編集</a></li>
@endsection

@section('content')
	<div class="container">
		<form action="{{ route('member.edit', ['id' => $user->id]) }}" method="POST">
			<p class="mt-5" id="selected_reward">会員情報</p>
			<table class="table shipping_table">
				<thead class="thead-light">
					<tr>
						<th scope="row">表示名</th>
							<td class="w-75">
								<input type="text" name="display"  class="form-control" id="display" value="{{ $user->display }}">
							</td>
					</tr>
					<tr>
						<th scope="row">氏名</th>
							<td class="w-75">
								<input type="text" name="name"  class="form-control" id="name" value="{{ $user->name }}">
							</td>
					</tr>
					<tr>
						<th scope="row">フリガナ</th>
							<td class="w-75">
								<input type="text" name="name_kana"  class="form-control" id="name_kana" value="{{ $user->name_kana }}">
							</td>
					</tr>
					<tr>
						<th scope="row">郵便番号</th>
							<td class="w-75">
								<input type="text" name="post_code"  class="form-control" id="post_code" value="{{ $user->post_code }}">
							</td>
					</tr>
					<tr>
						<th scope="row">都道府県市区町村</th>
							<td class="w-75">
								<input type="text" name="address"  class="form-control" id="address" value="{{ $user->address }}">
					</tr>
					<tr>
						<th scope="row">番地・建物名</th>
							<td class="w-75">
								<input type="text" name="building"  class="form-control" id="building" value="{{ $user->building }}">
							</td>
					</tr>
					<tr>
						<th scope="row">電話番号</th>
							<td class="w-75">
								<input type="text" name="tel"  class="form-control" id="tel" value="{{ $user->tel }}">
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
										<input type="text" class="form-control mt-2" name="dis_reason" id="dis_reason" placeholder="無効理由を入力" value="{{ $user->dis_reason }}">
									</p>
								</div>
							</td>
					</tr>
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
@endsection
