@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row mb-4">
		<div class="col-sm-6">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">管理者管理</h5>
					<p class="card-text">管理者情報閲覧・ステータスの変更</p>
					<a href="{{ route('admin.list') }}" class="btn btn-primary">管理者管理画面へ</a>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">会員管理</h5>
					<p class="card-text">会員情報閲覧・ステータスの変更</p>
					<a href="{{ route('member.list') }}" class="btn btn-primary">会員管理画面へ</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">起案者管理</h5>
					<p class="card-text">起案者情報閲覧・ステータスの変更</p>
					<a href="{{ route('planner.list') }}" class="btn btn-primary">起案者管理画面へ</a>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">プロジェクト管理</h5>
					<p class="card-text">プロジェクトの作成・変更・取り消し</p>
					<a href="{{ route('project.list') }}" class="btn btn-primary">プロジェクト管理画面へ</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
