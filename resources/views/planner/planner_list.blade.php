@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">起案者一覧</a></li>
@endsection

@section('content')
<div class="border rounded">
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">アイコン</th>
				<th scope="col">個人名 / 法人名</th>
				<th scope="col">フリガナ</th>
				<th scope="col">電話番号</th>
				<th scope="col">郵便番号</th>
				<th scope="col">住所</th>
				<th scope="col">建物名</th>
				<th scope="col">メールアドレス</th>
				<th scope="col">紹介文</th>
				<th scope="col">登録日</th>
				<th scope="col">ステータス</th>
				<th scope="col">無効理由</th>
			</tr>
		</thead>
		<tbody>
			@foreach($planners as $planner)
			<tr>
				<td>{{ $planner->id }}</td>
				<td><img src="../../../CrowdFunding/public/storage/{{ $planner->planner_img }}" width="30rem" height="30rem"></td>
				<td>{{ $planner->name }}</td>
				<td>{{ $planner->name_kana }}</td>
				<td>{{ $planner->tel }}</td>
				<td>〒{{ $planner->post_code }}</td>
				<td>{{ $planner->address }}</td>
				<td>{{ $planner->building }}</td>
				<td>{{ $planner->email }}</td>
				<td>{{ $planner->intro }}</td>
				<td>{{ date('Y/m/d',  strtotime($planner->created_at)) }}</td>
				<td>
				@if($planner->status === 1)
					<label><span class="badge badge-success">有効</span>
				@elseif($planner->status === 2)
					<span class="badge badge-dark">退会</span>
				@else
					<span class="badge badge-danger">無効</span>
				@endif
					<a href="{{ route('planner.show', ['id' => $planner->id]) }}">変更</a>
				</td>
				<td>
					@if($planner->dis_reason == null)
					<span>N/A</span>
					@else
					<span class="mt-2">{{ $planner->dis_reason }}</span>
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
