@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">プロジェクト一覧</a></li>
@endsection

@section('content')
<div class="border rounded">
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">プロジェクト名</th>
				<th scope="col">起案者名</th>
				<th scope="col">目標金額</th>
				<th scope="col">達成率</th>
				<th scope="col">総支援額</th>
				<th scope="col">総支援者数</th>
				<th scope="col">開始日</th>
				<th scope="col">終了日</th>
				<th scope="col">募集期間</th>
				<th scope="col">ステータス</th>
				<th scope="col">キャンセル理由</th>
			</tr>
		</thead>
		<tbody>
			@foreach($projects as $project)
			<tr>
				<td>{{ $project->id }}</td>
				<td>{{ $project->pj_title }}</td>
				<td>{{ $project->planner_id }}</td>
				<td>¥ {{ number_format($project->target_amount) }}</td>
				<td>{{ $percent_complete }} %</td>
				<td>¥ {{ number_format($total_amount) }}</td>
				<td>{{ $total_supporter }} 人</td>
				<td>{{ date('Y/m/d',  strtotime($project->created_at)) }}</td>
				<td>{{ date('Y/m/d',  strtotime($end_day)) }}</td>
				<td>{{ $project->period }} 日</td>
				<td>
				@if($project->status === 1)
					<label><span class="badge badge-success">有効</span>
				@elseif($project->status === 2)
					<span class="badge badge-dark"></span>
				@else
					<span class="badge badge-danger">キャンセル</span>
				@endif
					<a href="{{ route('project.show.edit', ['id' => $project->id]) }}">変更</a>
				</td>
				<td>
					@if($project->dis_reason == null)
					<span>N/A</span>
					@else
					<span class="mt-2">{{ $project->dis_reason }}</span>
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
