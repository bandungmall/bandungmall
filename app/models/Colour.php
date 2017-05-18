<?php
	class Colour extends Eloquent{
		protected $table = 'template_colour';
		protected $primaryKey = 'id';

		public function getAll(){
			$data_colour = DB::table('template_colour')->get();

			return $data_colour;
		}

		public function insertColour($nama, $kode_colour){
			
			$data_colour = new Colour();
			$data_colour->nama = $nama;
			$data_colour->kode = $kode_colour;
			$data_colour->save();
		}

		public function editColour($id, $nama, $kode){
			$data_colour = Colour::find($id);
			
			$data_colour->nama = $nama;
			$data_colour->kode = $kode;
			$data_colour->save();

		}
	}
?>