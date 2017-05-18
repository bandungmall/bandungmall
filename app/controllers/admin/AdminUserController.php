<?php

class AdminUserController extends BaseController {

	public function getIndex(){
		//if(!Session::has("admin")) return Redirect::to(URL::to("superuserr/login"))->with("message", "Session Expired");

		$data['users'] = DB::table('user')
            ->leftJoin('mlm', 'mlm.downline_id', '=', 'user.id')
            ->select('user.*', 'mlm.upline_id')
            ->get();

            /*
        $list_id = DB::table('user as u')
            ->leftJoin('mlm as m', 'm.downline_id', '=', 'u.id')
            ->lists('u.id');

        //$data['total_downline'] = Mlm::whereIn('upline_id', '=', $data['users'][0]->id)->count();
       	$data['total_downline'] = DB::table('mlm')
				                     ->select(DB::raw('count(*) as user_count'))
				                     ->whereIn('upline_id', '=', $list_id)
				                     ->get();
				            */
		return View::make('admin/user', $data);
	}
}
