<?php
	class Mlm extends Eloquent{
		protected $table = 'mlm';
		protected $primaryKey = 'id';

		public function getUpline($id){

			$rs = Mlm::where('downline_id', '=', $id)
					->leftJoin('user', 'user.id', '=', 'mlm.upline_id')
					->first();

			return $rs;
		}
	}
?>