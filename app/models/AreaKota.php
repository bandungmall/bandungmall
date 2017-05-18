<?php
	class AreaKota extends Eloquent{
		protected $table = 'area_kota';
		protected $primaryKey = 'id';

		public function getAll(){
			$data = DB::table('area_kota')
						->orderBy('id_provinsi','asc')
						->orderBy('name','asc')
						->get();

			return $data;
		}

		public function getKota($id){
			$data = DB::table('area_kota')
						->where('id_provinsi','=',$id)
						->orderBy('tipe','asc')
						->orderBy('name','asc')
						->get();

			return $data;
		}
	}
?>