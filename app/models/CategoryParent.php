<?php
	class CategoryParent extends Eloquent{
		protected $table = 'category_parent';
		protected $primaryKey = 'id';

		public function getAll(){
			$data_category_parent = DB::table('category_parent')
								->orderBy('name','asc')
								->get();

			return $data_category_parent;
		}

		public function getAllSelectedParent($id_root){
			$data_category_parent = DB::table('category_parent')
								->where('id_root','=',$id_root)
								->orderBy('name','asc')
								->get();

			return $data_category_parent;
		}

		public function getParent($id){
			$data_category_parent = DB::table('category_parent')
								->where('id_root','=',$id)
								->orderBy('name','asc')
								->select('id','name')
								->get();

			return $data_category_parent;
		}
	}
?>