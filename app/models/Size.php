<?php
	class Size extends Eloquent{
		protected $table = 'template_size';
		protected $primaryKey = 'id';

		public function getAll(){
			$data_size = DB::table('template_size')->get();

			return $data_size;
		}

		public function insertSize($category_id, $nama, $size, $level){

			$data_size = new Size();
			$data_size->category_id = $category_id;
			$data_size->nama = $nama;
			$data_size->size = $size;
			$data_size->level = $level;
			$data_size->save();
		}

		public function editSize($id, $category_id, $nama, $size, $level){
			$data_size = Size::find($id);
			
			$data_size->category_id = $category_id;
			$data_size->nama = $nama;
			$data_size->size = $size;
			$data_size->level = $level;
			$data_size->save();

		}
	}
?>