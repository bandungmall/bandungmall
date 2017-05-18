<?php
	class CategoryChild extends Eloquent{
		protected $table = 'category_child';
		protected $primaryKey = 'id';

		public function getAll(){
			$data_category_child = DB::table('category_child')
								->orderBy('name','asc')
								->get();

			return $data_category_child;
		}

		public function getAllSelectedChild($id_parent){
			$data_category_child = DB::table('category_child')
								->where('id_parent','=',$id_parent)
								->orderBy('name','asc')
								->get();

			return $data_category_child;
		}

		public function getAllHasGrandChild(){
			$data_category_child = DB::table('category_child')
								->where('has_grand_child','=','yes')
								->orderBy('name','asc')
								->get();

			return $data_category_child;
		}

		public function getChild($id){
			$data_category_child = DB::table('category_child')
								->where('id_parent','=',$id)
								->where('has_grand_child','=','yes')
								->orderBy('name','asc')
								->get();

			return $data_category_child;
		}

		public function getChildAll($id){
			$data_category_child = DB::table('category_child')
								->where('id_parent','=',$id)
								->orderBy('name','asc')
								->get();

			return $data_category_child;
		}
	}
?>