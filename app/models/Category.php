<?php
	class Category extends Eloquent{
		protected $table = 'category';
		protected $primaryKey = 'id';

		public function getAll(){
			$data_category = DB::table('category as c1')
								->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
								->select('c1.*', 'c2.name as parent_name')
								->where('c1.parent', '!=', 0)
								->orderBy('c1.parent','asc')
								->orderBy('c1.name','asc')
								->get();

			return $data_category;
		}
		public function getAllWithRoot(){
			$data_category = DB::table('category as c1')
								->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
								->select('c1.*', 'c2.name as parent_name')
								->orderBy('c1.parent','asc')
								->orderBy('c1.name','asc')
								->get();

			return $data_category;
		}
	}
?>