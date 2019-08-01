@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">管理者一覧</a></li>
@endsection

@section('content')

<div class="border rounded">
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">名前</th>
				<th scope="col">メールアドレス</th>
				<th scope="col">登録日</th>
				<th scope="col">ステータス</th>
				<th scope="col">無効理由</th>
			</tr>
		</thead>
		<tbody>
			@foreach($admins as $admin)
			<tr>
				<td>{{ $admin->id }}</td>
				<td>{{ $admin->name }}</td>
				<td>{{ $admin->email }}</td>
				<td>{{ date('Y/m/d',  strtotime($admin->created_at)) }}</td>
				<td>
				@if($admin->status === 1)
					<label><span class="badge badge-success">有効</span>
				@else
					<span class="badge badge-danger">無効</span>
				@endif
					<a href="{{ route('admin.show', ['id' => $admin->id]) }}">変更</a>
				</td>
				<td>
					@if($admin->dis_reason == null)
					<span>N/A</span>
					@else
					<span class="mt-2">{{ $admin->dis_reason }}</span>
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
