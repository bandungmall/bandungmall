<?php

class AdminConfigController extends BaseController {

	
	public function getIndexColour(){

		$data['error_code'] = Session::get('error_code');

		$colour = new Colour();
		$data['colours'] = $colour->getAll();
		return View::make('admin/configColour',$data);
	}

	public function doInsertConfigColour(){

		$nama = Input::get('nama');
		$kode = Input::get('kode');

		$colour = new Colour();
		$data['colour'] = Colour::where('nama', '=', $nama)->first();
		if(count($data['colour']) > 0){
			return Redirect::to('admin/configColour')->with('error_code', "Nama warna sudah ada");
		}
		$col = $colour->insertColour($nama,$kode);
		
		return Redirect::to('admin/configColour');
	}

	public function getIndexEditColour(){

		$colour_id = Input::get('id');

		$colour = new Colour();
		$data['colour'] = Colour::where('id', '=', $colour_id)->first();
		return View::make('admin/editColour',$data);
	}

	public function doEditConfigColour(){

		$id = Input::get('id');
		$nama = Input::get('nama');
		$kode = Input::get('kode');

		$colour = new Colour();
		$col = $colour->editColour($id,$nama,$kode);
		
		return Redirect::to('admin/configColour');
	}

	public function doDeleteConfigColour(){

		$id = Input::get('id');

		$col = Colour::where('id', '=', $id);
		$col->delete();
		
		return Redirect::to('admin/configColour');
	}

	public function getIndexSize(){

		$data['error_code'] = Session::get('error_code');

		$size = new Size();
		$data['sizes'] = $size->getAll();

		$category_root = new CategoryRoot();

		$data['categories_root'] = $category_root->getAll();

		$category_grand_child = DB::table('category_grand_child as cgc')
								->leftJoin('category_child as cc', 'cgc.id_child', '=', 'cc.id')
								->leftJoin('category_parent as cp', 'cc.id_parent', '=', 'cp.id')
								->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
								->select(
									'cr.id as crid',
									'cr.name as crname',
									'cp.id as cpid',
									'cp.name as cpname',
									'cc.id as ccid',
									'cc.name as ccname',
									'cc.commision as cccommision',
									'cgc.id as cgcid',
									'cgc.name as cgcname',
									'cgc.commision as cgccommision'
									)
								->orderBy('cr.name','asc')
								->orderBy('cp.name','asc')
								->orderBy('cc.name','asc')
								->orderBy('cgc.name','asc')
								->get();
		$data['categories_grand_child'] = $category_grand_child;

		$category_child = DB::table('category_child as cc')
								->leftJoin('category_parent as cp', 'cc.id_parent', '=', 'cp.id')
								->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
								->select(
									'cr.id as crid',
									'cr.name as crname',
									'cp.id as cpid',
									'cp.name as cpname',
									'cc.id as ccid',
									'cc.name as ccname',
									'cc.commision as cccommision'
									)
								->orderBy('cr.name','asc')
								->orderBy('cp.name','asc')
								->orderBy('cc.name','asc')
								->get();
		$data['categories_child'] = $category_child;

		$category_parent = DB::table('category_parent as cp')
								->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
								->select(
									'cr.id as crid',
									'cr.name as crname',
									'cp.id as cpid',
									'cp.name as cpname'
									)
								->orderBy('cr.name','asc')
								->orderBy('cp.name','asc')
								->get();
		$data['categories_parent'] = $category_parent;
		return View::make('admin/configSize',$data);
	}

	public function doInsertConfigSize(){

		$category = Input::get('category_grand_child') != 0 ? Input::get('category_grand_child') : Input::get('category_child');

		$level = Input::get('category_grand_child') != 0 ? 4 : 3;
		$nama = Input::get('nama');
		$size = Input::get('size');

		$in_size = new Size();
		$data['size'] = Size::where('nama', '=', $nama)->first();
		if(count($data['size']) > 0){
			return Redirect::to('admin/configSize')->with('error_code', "Nama size sudah ada");
		}
		$siz = $in_size->insertSize($category,$nama,$size,$level);
		
		return Redirect::to('admin/configSize');
	}

	public function getIndexEditSize($id){

		$size_id = $id;

		$size = new Size();
		$data['size'] = Size::where('id', '=', $size_id)->first();
		$category_id = $data['size']['category_id'];

		$category_root = new CategoryRoot();

		$category = new CategoryChild();
		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category'] = CategoryGrandChild::where('id', '=', $category_id)->first();
		if($data['size']['level'] == 4){
			$data['categories'] = DB::table('category_grand_child as cgc')
									->leftJoin('category_child as cc', 'cgc.id_child', '=', 'cc.id')
									->leftJoin('category_parent as cp', 'cc.id_parent', '=', 'cp.id')
									->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
									->select(
										'cr.id as crid',
										'cr.name as crname',
										'cp.id as cpid',
										'cp.name as cpname',
										'cc.id as ccid',
										'cc.name as ccname',
										'cc.commision as cccommision',
										'cgc.id as cgcid',
										'cgc.name as cgcname',
										'cgc.commision as cgccommision'
										)
									->orderBy('cr.name','asc')
									->orderBy('cp.name','asc')
									->orderBy('cc.name','asc')
									->orderBy('cgc.name','asc')
									->where('cgc.id', '=', $category_id)
									->first();
		}else{
			$data['categories'] = DB::table('category_child as cc')
									->leftJoin('category_parent as cp', 'cc.id_parent', '=', 'cp.id')
									->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
									->select(
										'cr.id as crid',
										'cr.name as crname',
										'cp.id as cpid',
										'cp.name as cpname',
										'cc.id as ccid',
										'cc.name as ccname',
										'cc.commision as cccommision'
										)
									->orderBy('cr.name','asc')
									->orderBy('cp.name','asc')
									->orderBy('cc.name','asc')
									->where('cc.id', '=', $category_id)
									->first();
		}

		$data['category_parent'] = $category_parent->getAllSelectedParent($data['categories']->crid);
		$data['category_child'] = $category_child->getAllSelectedChild($data['categories']->cpid);
		$data['category_grand_child'] = $category_grand_child->getAllSelectedGrandChild($data['categories']->ccid);

		return View::make('admin/editSize',$data);
	}

	public function doEditConfigSize(){

		$id = Input::get('id');
		$category = Input::get('category_grand_child') != 0 ? Input::get('category_grand_child') : Input::get('category_child');
		$level = Input::get('category_grand_child') != 0 ? 4 : 3;
		$nama = Input::get('nama');
		$size = Input::get('size');

		$ed_size = new Size();
		$data['size'] = Size::where('nama', '=', $nama)
								->where('id','!=',$id)
								->first();
		if(count($data['size']) > 0){
			return Redirect::to('admin/configSize')->with('error_code', "Nama size sudah ada");
		}
		$col = $ed_size->editSize($id,$category,$nama,$size,$level);
		
		return Redirect::to('admin/configSize');
	}

	public function doDeleteConfigSize(){

		$id = Input::get('id');

		$col = Size::where('id', '=', $id);
		$col->delete();
		
		return Redirect::to('admin/configSize');
	}

	public function getIndexDescription(){

		$data['error_code'] = Session::get('error_code');

		$description = new Description();
		$data['descriptions'] = $description->getAll();

		$category_root = new CategoryRoot();

		$data['categories_root'] = $category_root->getAll();

		$category_grand_child = DB::table('category_grand_child as cgc')
								->leftJoin('category_child as cc', 'cgc.id_child', '=', 'cc.id')
								->leftJoin('category_parent as cp', 'cc.id_parent', '=', 'cp.id')
								->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
								->select(
									'cr.id as crid',
									'cr.name as crname',
									'cp.id as cpid',
									'cp.name as cpname',
									'cc.id as ccid',
									'cc.name as ccname',
									'cc.commision as cccommision',
									'cgc.id as cgcid',
									'cgc.name as cgcname',
									'cgc.commision as cgccommision'
									)
								->orderBy('cr.name','asc')
								->orderBy('cp.name','asc')
								->orderBy('cc.name','asc')
								->orderBy('cgc.name','asc')
								->get();
		$data['categories_grand_child'] = $category_grand_child;

		$category_child = DB::table('category_child as cc')
								->leftJoin('category_parent as cp', 'cc.id_parent', '=', 'cp.id')
								->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
								->select(
									'cr.id as crid',
									'cr.name as crname',
									'cp.id as cpid',
									'cp.name as cpname',
									'cc.id as ccid',
									'cc.name as ccname',
									'cc.commision as cccommision'
									)
								->orderBy('cr.name','asc')
								->orderBy('cp.name','asc')
								->orderBy('cc.name','asc')
								->get();
		$data['categories_child'] = $category_child;

		$category_parent = DB::table('category_parent as cp')
								->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
								->select(
									'cr.id as crid',
									'cr.name as crname',
									'cp.id as cpid',
									'cp.name as cpname'
									)
								->orderBy('cr.name','asc')
								->orderBy('cp.name','asc')
								->get();
		$data['categories_parent'] = $category_parent;
		return View::make('admin/configDescription',$data);
	}

	public function doInsertConfigDescription(){

		$category = Input::get('category_grand_child') != 0 ? Input::get('category_grand_child') : Input::get('category_child');
		$level = Input::get('category_grand_child') != 0 ? 4 : 3;
		$nama = Input::get('nama');
		$description = explode(",",Input::get('description'));
		$satuan = Input::get('satuan');
		
		$temp_description = "";
		foreach($description as $val){
			$temp_description .= "
			<label>$val</label>
			<div class='input-group'>
			<input type='text' class='form-control' name='description[]' placeholder='Masukkan $val' required/>
			<input type='hidden' class='form-control' name='jenis_description[]' value='$val'/>
			<input type='hidden' class='form-control' name='satuan[]' value='$satuan'/>
			<span class='input-group-addon'>$satuan</span>
			</div>
			<br/>
			";
		}

		$temp_description = urlencode($temp_description);

		$in_Description = new Description();
		$data['description'] = Description::where('nama', '=', $nama)->first();
		if(count($data['description']) > 0){
			return Redirect::to('admin/configDescription')->with('error_code', "Nama Description sudah ada");
		}
		$siz = $in_Description->insertDescription($category,$nama,Input::get('description'),$satuan,$temp_description,$level);
		
		return Redirect::to('admin/configDescription');
	}

	public function getIndexEditDescription($id){

		$description_id = $id;

		$description = new Description();
		$data['description'] = Description::where('id', '=', $description_id)->first();

		$category_id = $data['description']['category_id'];

		$category_root = new CategoryRoot();

		$category = new CategoryChild();
		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category'] = CategoryGrandChild::where('id', '=', $category_id)->first();
		if($data['description']['level'] == 4){
			$data['categories'] = DB::table('category_grand_child as cgc')
									->leftJoin('category_child as cc', 'cgc.id_child', '=', 'cc.id')
									->leftJoin('category_parent as cp', 'cc.id_parent', '=', 'cp.id')
									->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
									->select(
										'cr.id as crid',
										'cr.name as crname',
										'cp.id as cpid',
										'cp.name as cpname',
										'cc.id as ccid',
										'cc.name as ccname',
										'cc.commision as cccommision',
										'cgc.id as cgcid',
										'cgc.name as cgcname',
										'cgc.commision as cgccommision'
										)
									->orderBy('cr.name','asc')
									->orderBy('cp.name','asc')
									->orderBy('cc.name','asc')
									->orderBy('cgc.name','asc')
									->where('cgc.id', '=', $category_id)
									->first();
		}else{
			$data['categories'] = DB::table('category_child as cc')
									->leftJoin('category_parent as cp', 'cc.id_parent', '=', 'cp.id')
									->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
									->select(
										'cr.id as crid',
										'cr.name as crname',
										'cp.id as cpid',
										'cp.name as cpname',
										'cc.id as ccid',
										'cc.name as ccname',
										'cc.commision as cccommision'
										)
									->orderBy('cr.name','asc')
									->orderBy('cp.name','asc')
									->orderBy('cc.name','asc')
									->where('cc.id', '=', $category_id)
									->first();
		}

		$data['category_parent'] = $category_parent->getAllSelectedParent($data['categories']->crid);
		$data['category_child'] = $category_child->getAllSelectedChild($data['categories']->cpid);
		$data['category_grand_child'] = $category_grand_child->getAllSelectedGrandChild($data['categories']->ccid);
		return View::make('admin/editDescription',$data);
	}

	public function doEditConfigDescription(){

		$id = Input::get('id');
		$category = Input::get('category_grand_child') != 0 ? Input::get('category_grand_child') : Input::get('category_child');
		$level = Input::get('category_grand_child') != 0 ? 4 : 3;
		$nama = Input::get('nama');
		$description = explode(",",Input::get('description'));
		$satuan = Input::get('satuan');

		$temp_description = "";
		foreach($description as $val){
			$temp_description .= "
			<label>$val</label>
			<div class='input-group'>
			<input type='text' class='form-control' name='description[]' placeholder='Masukkan $val' required/>
			<input type='hidden' class='form-control' name='jenis_description[]' value='$val'/>
			<input type='hidden' class='form-control' name='satuan[]' value='$satuan'/>
			<span class='input-group-addon'>$satuan</span>
			</div>
			<br/>
			";
		}

		$temp_description = urlencode($temp_description);

		$ed_Description = new Description();
		$data['description'] = Description::where('nama', '=', $nama)
								->where('id','!=',$id)
								->first();
		if(count($data['description']) > 0){
			return Redirect::to('admin/configDescription')->with('error_code', "Nama Description sudah ada");
		}
		$col = $ed_Description->editDescription($id,$category,$nama,Input::get('description'),$satuan,$temp_description,$level);
		
		return Redirect::to('admin/configDescription');
	}

	public function doDeleteConfigDescription(){

		$id = Input::get('id');

		$col = Description::where('id', '=', $id);
		$col->delete();
		
		return Redirect::to('admin/configDescription');
	}

}
