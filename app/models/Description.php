<?php
	class Description extends Eloquent{
		protected $table = 'template_description';
		protected $primaryKey = 'id';

		public function getAll(){
			$data_description = DB::table('template_description')->orderBy('nama','asc')->get();

			return $data_description;
		}

		public function insertDescription($category_id, $nama, $deskripsi, $satuan, $temp_deskripsi, $level){

			$data_description = new Description();
			$data_description->category_id = $category_id;
			$data_description->nama = $nama;
			$data_description->deskripsi = $deskripsi;
			$data_description->satuan = $satuan;
			$data_description->temp_deskripsi = $temp_deskripsi;
			$data_description->level = $level;
			$data_description->save();
		}

		public function editDescription($id, $category_id, $nama, $deskripsi, $satuan, $temp_deskripsi, $level){
			$data_description = Description::find($id);
			
			$data_description->category_id = $category_id;
			$data_description->nama = $nama;
			$data_description->deskripsi = $deskripsi;
			$data_description->satuan = $satuan;
			$data_description->temp_deskripsi = $temp_deskripsi;
			$data_description->level = $level;
			$data_description->save();

		}
	}
?>