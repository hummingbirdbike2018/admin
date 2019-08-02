@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">会員一覧</a></li>
@endsection

@section('content')
<div class="border rounded">
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">アイコン</th>
				<th scope="col">表示名</th>
				<th scope="col">名前</th>
				<th scope="col">ふりがな</th>
				<th scope="col">電話番号</th>
				<th scope="col">郵便番号</th>
				<th scope="col">住所</th>
				<th scope="col">建物名</th>
				<th scope="col">メールアドレス</th>
				<th scope="col">登録日</th>
				<th scope="col">ステータス</th>
				<th scope="col">無効理由</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
				@if($user->user_img == null)
				<td><img src="../../../CrowdFunding/public/storage/user_default_img.png" width="30rem" height="30rem"></td>
				@else
				<td><img src="../../../CrowdFunding/public/storage/{{ $user->user_img }}" width="30rem" height="30rem"></td>
				@endif

				@if($user->display != null)
				<td>{{ $user->display }}</td>
				@else
				<td>未設定</td>
				@endif
				<td>{{ $user->name }}</td>
				<td>{{ $user->name_kana }}</td>
				<td>{{ $user->tel }}</td>
				<td>〒{{ $user->post_code }}</td>
				<td>{{ $user->address }}</td>
				<td>{{ $user->building }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ date('Y/m/d',  strtotime($user->created_at)) }}</td>
				<td>
				@if($user->status === 1)
					<label><span class="badge badge-success">有効</span>
				@elseif($user->status === 2)
					<span class="badge badge-dark">退会</span>
				@else
					<span class="badge badge-danger">無効</span>
				@endif
					<a href="{{ route('member.show', ['id' => $user->id]) }}">変更</a>
				</td>
				<td>
					@if($user->dis_reason == null)
					<span>N/A</span>
					@else
					<span class="mt-2">{{ $user->dis_reason }}</span>
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
