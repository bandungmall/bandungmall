<?php
	class AreaProvinsi extends Eloquent{
		protected $table = 'area_provinsi';
		protected $primaryKey = 'id';

		public function getAll(){
			$data = DB::table('area_provinsi')
						->orderBy('id_pulau','asc')
						->orderBy('name','asc')
						->get();

			return $data;
		}
	}
?>