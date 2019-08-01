@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.list') }}">管理者一覧</a></li>
<li class="breadcrumb-item active" aria-current="page">管理者情報編集</a></li>
@endsection

@section('content')
	<div class="container">
		<form action="{{ route('admin.edit', ['id' => $admin->id]) }}" method="POST">
			<p class="mt-5" id="selected_reward">管理者情報</p>
			<table class="table shipping_table">
				<thead class="thead-light">
				<tr>
					<th scope="row">管理者名</th>
						<td class="w-75">
							<input type="text" name="name" class="form-control" id="name" value="{{ $admin->name }}">
						</td>
				</tr>
					<th scope="row">ステータス</th>
						<td class="w-75">
							<div id="status">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="enable"  v-on:change="handler" value="1" @if ($admin->status == 1) checked @endif>
									<label class="form-check-label" for="enable">有効</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="disable" v-on:change="handler" value="3" @if ($admin->status == 3) checked @endif>
									<label class="form-check-label" for="disable">無効</label>
								</div>
								<p v-if="show">
									<input type="text" class="form-control" name="dis_reason" id="dis_reason" placeholder="無効理由を入力" value="{{ $admin->dis_reason }}">
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
