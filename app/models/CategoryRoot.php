<?php
	class CategoryRoot extends Eloquent{
		protected $table = 'category_root';
		protected $primaryKey = 'id';

		public function getAll(){
			$data_category_root = DB::table('category_root')
								->orderBy('name','asc')
								->get();

			return $data_category_root;
		}
	}
?>