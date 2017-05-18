<?php
	class CategoryGrandChild extends Eloquent{
		protected $table = 'category_grand_child';
		protected $primaryKey = 'id';

		public function getAll(){
			$data_category_grand_child = DB::table('category_grand_child')
										->orderBy('name','asc')
										->get();

			return $data_category_grand_child;
		}

		public function getAllSelectedGrandChild($id_child){
			$data_category_grand_child = DB::table('category_grand_child')
								->where('id_child','=',$id_child)
								->orderBy('name','asc')
								->get();

			return $data_category_grand_child;
		}

		public function getGrandChild($id){
			$data_category_grand_child = DB::table('category_grand_child')
								->where('id_child','=',$id)
								->orderBy('name','asc')
								->get();

			return $data_category_grand_child;
		}
	}
?>