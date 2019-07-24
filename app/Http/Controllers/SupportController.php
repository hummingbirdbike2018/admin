<?php

namespace App\Http\Controllers;

use App\Project;
use App\Reward;
use App\Support;
use App\User;
use App\Card;
use Carbon\Carbon;
use App\Mail\SupportConfirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;



class SupportController extends Controller
{
	public function index (int $id) {
		// プロジェクトを取得
		$project = Project::find($id);
		// プロジェクトIDに紐づくリワードテーブルを取得
		$reward = Reward::where('pj_id', $id)->get();

		$total_amount   = 0;			// 総支援額
		$supporter_list = array();		// Rewardごとの支援者数を格納する配列
		$stock_list     = array();		// Rewardごとの残り個数を格納する配列

		for($i = 0; $i < $reward->count(); $i++) {
			$supporter_list[] = Support::where('reward_id', $id++)->get()->count();
			$total_amount += $reward[$i]['rw_price'] * $supporter_list[$i];
			$stock_list[] = $reward[$i]['rw_quantity'] - $supporter_list[$i];
		}

		// プロジェクトの終了日
		$end_day = new Carbon($project->created_at);
		$end_day->addDay($project->period);
		$end_day_str = date_format($end_day , 'Y年m月d日');
		$end_time = $end_day_str.'23:59';									// 終了までの日数
		$now_datetime = Carbon::now();
		$period = $end_day->diffInDays($now_datetime);						// 残り日数
		$target_amount = $project->target_amount; 							// 目標金
		$percent_complete = floor($total_amount / $target_amount * 100);	// 達成率

		//view側へ値を渡す処理
		return view('projects.select_support',
		[
			'project' => $project,
			'total_amount' => $total_amount,
			'supporter_list' => $supporter_list,
			'period' => $period,
			'end_time' => $end_time,
			'percent_complete' => $percent_complete,
			'rewards' => $reward,
			'stock_list' => $stock_list,
		]);
	}

	public function showSelectedReward($id,$reward_id) {

		// プロジェクトを取得
		$project = Project::find($id);
		// 選択されたリターンIDに紐づくリワードテーブルを取得
		$reward = Reward::where('id', $reward_id)->get();

		// プロジェクトの開始日
		$start_day = new Carbon($project->created_at);
		// プロジェクトの終了日
		$end_day = new Carbon($project->created_at);
		$end_day->addDay($project->period);
		$end_day_str = date_format($end_day , 'Y年m月d日');
		$end_time = $end_day_str.'23:59';									// 終了までの日数
		$period = $start_day->diffInDays($end_day); 						// 残り日数
		$target_amount = $project->target_amount; 							// 目標金
		$percent_complete = floor($project->target_amount / $target_amount * 100);	// 達成率
		$supporter =  Support::where('reward_id', $reward_id)->count();//支援者数
		$user = User::Where('id', Auth::id())->get(); //usersテーブルからIDに紐づくユーザ情報を取得
		$payment = Card::where('user_id', Auth::id())->get();//card_infoテーブルからIDに紐づくカード情報を取得

		return view('projects.selected_support',
		[
			'project' => $project,
			'period' => $period,
			'end_time' => $end_time,
			'percent_complete' => $percent_complete,
			'rewards' => $reward,
			'supporter' => $supporter,
			'users' => $user,
			'payments' => $payment,
		]);
	}

	public function storeSelectedReward(Request $request) {

		//view側へ値を渡す処理
		return view('projects.selected_support');
	}


	public function confirmSelectedReward (Request $request) {

		//うけとったリクエスト内容を格納
		$support_data = $request->all();
		//二重送信防止
		$request->session()->regenerateToken();
		//配送先情報にチェックが入っている場合の処理
		if($request->address_check != NULL) {
			//POSTで取得したデータを配列に格納
			$user_data = [
				'name' => $request->name,
				'name_kana' => $request->name_kana,
				'tel' => $request->tel,
				'post_code' => $request->post_code,
				'address' => $request->address,
				'building' => $request->building,
			];
			//usersテーブルからログインユーザIDの一致するものを探し、データを上書き
			User::where('id', Auth::id())->update($user_data);
		}

		//カード情報保存にチェックが入っている場合の処理
		if($request->card_check != NULL) {
			//createメソッドでcard_infoテーブルにRequestで受けとった情報を保存
			$card_data = Card::create([
				'user_id' => Auth::id(),
				'card_no' => $request->card_no,
				'exp_mon' => $request->exp_mon,
				'exp_year' => $request->exp_year,
				'card_csv' => $request->card_csv,
				'first_name' => $request->first_name,
				'last_name' => $request->last_name,
			]);
		}

			//確認ページに$support_data(Requestで受けとったデータ)を渡す
			return view('projects.support_confirm', $support_data);
		}


		public function completeSelectedReward (Request $request) {

			//うけとったリクエスト内容を格納
			$support_data = $request->all();

			//戻るボタン押下時、リクエスト内容を持たせて入力画面へリダイレクト
			if($request->action === 'back') {
					return back()->withInput([$support_data,]);
			}

			//二重送信防止
			$request->session()->regenerateToken();
			//ログインユーザのメールアドレスにメールを送信
			Mail::to(Auth::user()->email)->send(new SupportConfirm($support_data));

			return view('projects.support_complete', $support_data);
		}
}
