<?php

class AdminCategoryController extends BaseController {

	public function getIndex(){

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

		return View::make('admin/category', $data);
	}

	public function getParent(){

		$id = Input::get('id');

		$category_parent = new CategoryParent();

		$data['categories_parent'] = $category_parent->getParent($id);

		return $data;
	}

	public function getChild(){

		$id = Input::get('id');

		$category_child = new CategoryChild();

		$data['categories_child'] = $category_child->getChild($id);

		return $data;
	}

	public function getChildAll(){

		$id = Input::get('id');

		$category_child = new CategoryChild();

		$data['categories_child'] = $category_child->getChildAll($id);

		return $data;
	}

	public function getGrandChild(){

		$id = Input::get('id');

		$category_grand_child = new CategoryGrandChild();

		$data['categories_grand_child'] = $category_grand_child->getGrandChild($id);

		return $data;
	}

	public function getIndexEditCategory(){

		$data['error_code'] = Session::get('error_code');

		$category_id = Input::get('id');

		$category = new Category();
		$data['categories'] = $category->getAllWithRoot();
		$data['category'] = Category::where('id', '=', $category_id)->first();

		return View::make('admin/editCategory', $data);
	}

	public function doEditCategory(){

		$category_id = Input::get('category_id');
		$category_parent = Input::get('category_parent');
		$category = Input::get('category');
		$category_commision = Input::get('category_commision');
		
		$cat = Category::find($category_id);
		$cat->parent = $category_parent;
		$cat->commision = $category_commision;
		$cat->name = $category;
		$cat->save();

		return Redirect::to('admin/category');
	}

	public function getIndexEditCategoryRoot($id){

		$data['error_code'] = Session::get('error_code');

		$category_id = $id;

		$category = new CategoryRoot();
		$data['category'] = CategoryRoot::where('id', '=', $category_id)->first();

		return View::make('admin/editCategoryRoot', $data);
	}

	public function getIndexEditCategoryParent($id){

		$data['error_code'] = Session::get('error_code');

		$category_id = $id;

		$category = new CategoryParent();
		$category_root = new CategoryRoot();
		$data['category_root'] = $category_root->getAll();
		$data['category'] = CategoryParent::where('id', '=', $category_id)->first();

		return View::make('admin/editCategoryParent', $data);
	}

	public function getIndexEditCategoryChild($id){

		$data['error_code'] = Session::get('error_code');

		$category_id = $id;

		$category = new CategoryChild();
		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$data['category_root'] = $category_root->getAll();
		$data['category'] = CategoryChild::where('id', '=', $category_id)->first();
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

		$data['category_parent'] = $category_parent->getAllSelectedParent($data['categories']->crid);

		return View::make('admin/editCategoryChild', $data);
	}

	public function getIndexEditCategoryGrandChild($id){

		$data['error_code'] = Session::get('error_code');

		$category_id = $id;

		$category = new CategoryChild();
		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$data['category_root'] = $category_root->getAll();
		$data['category'] = CategoryGrandChild::where('id', '=', $category_id)->first();
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

		$data['category_parent'] = $category_parent->getAllSelectedParent($data['categories']->crid);
		$data['category_child'] = $category_child->getAllSelectedChild($data['categories']->cpid);

		return View::make('admin/editCategoryGrandChild', $data);
	}

	public function doEditCategoryRoot(){

		$category_id = Input::get('category_id');
		$category = Input::get('category');
		
		$cat = CategoryRoot::find($category_id);
		$cat->name = $category;
		$cat->save();

		return Redirect::to('admin/category');
	}

	public function doEditCategoryParent(){

		$category_id = Input::get('category_id');
		$category_root = Input::get('category_root');
		if($category_root == "0"){
			return Redirect::to('admin/category')->withErrors(array('parent_msg'=>'Category root tidak terpilih'));
		}
		$category = Input::get('category');
		
		$cat = CategoryParent::find($category_id);
		$cat->id_root = $category_root;
		$cat->name = $category;
		$cat->save();

		return Redirect::to('admin/category');
	}

	public function doEditCategoryChild(){

		$category_id = Input::get('category_id');
		$category_root = Input::get('category_root');
		if($category_root == "0"){
			return Redirect::to('admin/category')->withErrors(array('child_msg'=>'Category root tidak terpilih'));
		}
		$category_parent = Input::get('category_parent');
		if($category_parent == "0"){
			return Redirect::to('admin/category')->withErrors(array('child_msg'=>'Category parent tidak terpilih'));
		}
		$category = Input::get('category');
		$commision = Input::get('commision');
		$hasgrandchild = Input::get('hasgrandchild') ? Input::get('hasgrandchild') : 'no';
		
		$cat = CategoryChild::find($category_id);
		$cat->id_parent = $category_parent;
		$cat->name = $category;
		$cat->commision = $commision;
		$cat->has_grand_child = $hasgrandchild;
		$cat->save();

		return Redirect::to('admin/category');
	}

	public function doEditCategoryGrandChild(){
		
		$category_id = Input::get('category_id');
		$category_root = Input::get('category_root');
		if($category_root == "0"){
			return Redirect::to('admin/category')->withErrors(array('grand_child_msg'=>'Category root tidak terpilih'));
		}
		$category_parent = Input::get('category_parent');
		if($category_parent == "0"){
			return Redirect::to('admin/category')->withErrors(array('grand_child_msg'=>'Category parent tidak terpilih'));
		}
		$category_child = Input::get('category_child');
		if($category_child == "0"){
			return Redirect::to('admin/category')->withErrors(array('grand_child_msg'=>'Category child tidak terpilih'));
		}
		$category = Input::get('category');
		$commision = Input::get('commision');
		
		$cat = CategoryGrandChild::find($category_id);
		$cat->id_child = $category_child;
		$cat->name = $category;
		$cat->commision = $commision;
		$cat->save();

		return Redirect::to('admin/category');
	}

	public function doInsertCategory(){

		$category_parent = Input::get('category_parent');
		$category = Input::get('category');

		$cat = new Category();
		$data['cat'] = Category::where('parent', '=', $category_parent)
								->where('name', '=', $category)
								->first();
		if(count($data['cat']) > 0){
			return Redirect::to('admin/category')->with('error_code', "Category sudah ada");
		}
		$cat->parent = $category_parent;
		$cat->name = $category;
		$cat->save();

		return Redirect::to('admin/category');
	}

	public function doInsertCategoryRoot(){

		$category = Input::get('category');

		$cat = new CategoryRoot();
		$data['cat'] = CategoryRoot::where('name', '=', $category)
									->first();
		if(count($data['cat']) > 0){
			return Redirect::to('admin/category')->withErrors(array('root_msg'=>'Category sudah ada'));
		}
		$cat->name = $category;
		$cat->save();

		return Redirect::to('admin/category');
	}

	public function doInsertCategoryParent(){

		$category_root = Input::get('category_root');
		if($category_root == "0"){
			return Redirect::to('admin/category')->withErrors(array('parent_msg'=>'Category root tidak terpilih'));
		}
		$category = Input::get('category');

		$cat = new CategoryParent();
		$data['cat'] = CategoryParent::where('name', '=', $category)
									->where('id_root','=', $category_root)
									->first();
		if(count($data['cat']) > 0){
			return Redirect::to('admin/category')->withErrors(array('parent_msg'=>'Category sudah ada'));
		}
		$cat->id_root = $category_root;
		$cat->name = $category;
		$cat->save();

		return Redirect::to('admin/category');
	}

	public function doInsertCategoryChild(){

		$category_root = Input::get('category_root');
		if($category_root == "0"){
			return Redirect::to('admin/category')->withErrors(array('child_msg'=>'Category root tidak terpilih'));
		}
		$category_parent = Input::get('category_parent');
		if($category_parent == "0"){
			return Redirect::to('admin/category')->withErrors(array('child_msg'=>'Category parent tidak terpilih'));
		}
		$category = Input::get('category');
		$commision = Input::get('commision');
		$hasgrandchild = Input::get('hasgrandchild') ? Input::get('hasgrandchild') : 'no';

		$cat = new CategoryChild();
		$data['cat'] = CategoryChild::where('name', '=', $category)
									->where('id_parent','=', $category_parent)
									->first();
		if(count($data['cat']) > 0){
			return Redirect::to('admin/category')->withErrors(array('child_msg'=>'Category sudah ada'));
		}
		$cat->id_parent = $category_parent;
		$cat->name = $category;
		$cat->commision = $commision;
		$cat->has_grand_child = $hasgrandchild;
		$cat->save();

		return Redirect::to('admin/category');
	}

	public function doInsertCategoryGrandChild(){

		$category_root = Input::get('category_root');
		if($category_root == "0"){
			return Redirect::to('admin/category')->withErrors(array('grand_child_msg'=>'Category root tidak terpilih'));
		}
		$category_parent = Input::get('category_parent');
		if($category_parent == "0"){
			return Redirect::to('admin/category')->withErrors(array('grand_child_msg'=>'Category parent tidak terpilih'));
		}
		$category_child = Input::get('category_child');
		if($category_child == "0"){
			return Redirect::to('admin/category')->withErrors(array('grand_child_msg'=>'Category child tidak terpilih'));
		}
		$category = Input::get('category');
		$commision = Input::get('commision');

		$cat = new CategoryGrandChild();
		$data['cat'] = CategoryGrandChild::where('name', '=', $category)
									->where('id_child','=', $category_child)
									->first();
		if(count($data['cat']) > 0){
			return Redirect::to('admin/category')->withErrors(array('grand_child_msg'=>'Category sudah ada'));
		}
		$cat->id_child = $category_child;
		$cat->name = $category;
		$cat->commision = $commision;
		$cat->save();

		return Redirect::to('admin/category');
	}

	public function doDeleteCategory(){

		$category_id = Input::get('id');

		$data_category = Category::find($category_id);
		$data_category->delete();

		return Redirect::to('admin/category');
	}

	public function doDeleteCategoryRoot($id){

		$category_id = $id;

		$data_category = CategoryRoot::find($category_id);

		$data_category_parent = CategoryParent::where('id_root','=',$category_id)->get();
		if(count($data_category_parent) > 0){
			foreach ($data_category_parent as $key) {
				$id_parent = $key['id']; 
				$data_category_parent_delete = CategoryParent::where('id','=',$id_parent)->first();

				$data_category_child = CategoryChild::where('id_parent','=',$id_parent)->get();
				if(count($data_category_child) > 0){
					foreach ($data_category_child as $key) {
						$id_child = $key['id']; 
						$data_category_child_delete = CategoryChild::where('id','=',$id_child)->first();

						$data_category_grand_child = CategoryGrandChild::where('id_child','=',$id_child)->get();
						if(count($data_category_grand_child) > 0){
							foreach ($data_category_grand_child as $key) {
								$id_grand_child = $key['id'];
								$data_category_grand_child_delete = CategoryGrandChild::where('id','=',$id_grand_child)->first();
								$data_category_grand_child_delete->delete();
							}
						}
						$data_category_child_delete->delete();
					}
				}
				$data_category_parent_delete->delete();
			}
		}

		$data_category->delete();

		return Redirect::to('admin/category');
	}

	public function doDeleteCategoryParent($id){

		$category_id = $id;

		$data_category = CategoryParent::find($category_id);
		
		$data_category_child = CategoryChild::where('id_parent','=',$category_id)->get();
		if(count($data_category_child) > 0){
			foreach ($data_category_child as $key) {
				$id_child = $key['id'];
				$data_category_child_delete = CategoryChild::where('id','=',$id_child)->first();

				$data_category_grand_child = CategoryGrandChild::where('id_child','=',$id_child)->get();
				if(count($data_category_grand_child) > 0){
					foreach ($data_category_grand_child as $key) {
						$id_grand_child = $key['id'];
						$data_category_grand_child_delete = CategoryGrandChild::where('id','=',$id_grand_child)->first();
						$data_category_grand_child_delete->delete();
					}
				}
				$data_category_child_delete->delete();
			}
		}

		$data_category->delete();

		return Redirect::to('admin/category');
	}

	public function doDeleteCategoryChild($id){

		$category_id = $id;

		$data_category = CategoryChild::find($category_id);

		$data_category_grand_child = CategoryGrandChild::where('id_child','=',$category_id)->get();
		if(count($data_category_grand_child) > 0){
			foreach ($data_category_grand_child as $key) {
				$id_grand_child = $key['id'];
				$data_category_grand_child_delete = CategoryGrandChild::where('id','=',$id_grand_child)->first();
				$data_category_grand_child_delete->delete();
			}	
		}

		$data_category->delete();

		return Redirect::to('admin/category');
	}

	public function doDeleteCategoryGrandChild($id){

		$category_id = $id;

		$data_category = CategoryGrandChild::find($category_id);
		$data_category->delete();

		return Redirect::to('admin/category');
	}
}


