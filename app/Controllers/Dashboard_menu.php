<?php

namespace App\Controllers;
use App\Models\Model_Menu;
use App\Models\Model_Users;

class Dashboard_menu extends BaseController
{
	public function __construct(){

		parent::__construct();
		$this->db = \Config\Database::connect();
		$this->input = \Config\Services::request();
		$this->validation =  \Config\Services::validation();
		//
		
	}
	public function index()
	{
		$sess_status = session()->get('status');
		if(isLoggedIn() && $sess_status == 'admin'){
			$model_menu = new Model_Menu();
			$data['main_menu'] = $model_menu->main_menu();
			return view('admin/dashboard_menu',$data);
		}else{
			return redirect()->to(base_url('login'));
		}
	}
	//
	public function show_main_menu(){
		$model_menu = new Model_Menu();
		$main_menu = $model_menu->main_menu();
		foreach($main_menu->get()->getResult() as $key => $value){
			?>
			<tr>
				<td><?= $key+1;?></td>
				<td><?= $value->menu;?></td>
				<td><?= $value->has_submenu;?></td>
				<td><i class="<?= $value->icon;?>"></i></td>
				<td><?= $value->order_menu;?></td>
				<td></td>
			</tr>
			<?php
		}
	}
	//
	public function show_sub_menu(){
		$model_menu = new Model_Menu();
		$sub_menu = $model_menu->submenu_menu();
		foreach($sub_menu->get()->getResult() as $key => $value){
			?>
			<tr>
				<td><?= $key+1;?></td>
				<td><?= $value->id;?></td>
				<td><?= $value->submenu;?></td>
				<td><?= $model_menu->main_menu($value->menu_id)->get()->getRow()->menu;?></td>
				<td><?= $value->route;?></td>
				<td><a href="javascript:void(0);" class="mr-3 text-primary updUserBtn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" data-id="<?php echo $value->id;?>"><i class="fa fa-edit"></i></a></td>
			</tr>
			<?php
		}
	}
	//
	public function add_main_menu(){
		$error = null;
		$menu = $this->input->getPost('menu');
		$has_submenu = $this->input->getPost('has_submenu');
		$icon = $this->input->getPost('icon');
		$order = $this->input->getPost('order');
		//
		$validate = $this->validate([
			'menu' => ['label' => 'Menu', 'rules' => 'required|trim'],
			'icon' => ['label' => 'Icon', 'rules' => 'required|trim'],
		]);
		
		if(!$validate){
			$error = $this->validation->listErrors();
		}
		//
		if(empty($error)){
			$this->db->transStart();
			//
			$data = array('menu' => $menu, 'has_submenu' => $has_submenu, 'icon' => $icon, 'order_menu' => $order);
			$this->db->table('menus')->insert($data);
			echo 'Success :  Menu Added Successfully';
			//
			$this->db->transComplete();
		}else{
			echo $error;
		}	
	}
	//
	public function add_sub_menu(){
		$error = null;
		$submenu = $this->input->getPost('submenu');
		$menu = $this->input->getPost('menu');
		$route = $this->input->getPost('route');
		//
		$validate = $this->validate([
			'submenu' => ['label' => 'Sub Menu', 'rules' => 'required|trim'],
			'menu' => ['label' => 'Menu', 'rules' => 'required|trim'],
			'route' => ['label' => 'Route', 'rules' => 'required|trim'],
		]);
		
		if(!$validate){
			$error = $this->validation->listErrors();
		}
		//
		if(empty($error)){
			$this->db->transStart();
			//
			$data = array('submenu' => $submenu, 'menu_id' => $menu, 'route' => $route);
			$this->db->table('sub_menus')->insert($data);
			$submenuID = $this->db->insertID();
			//
			if($submenuID > 0){
				$user = new Model_Users();
				$userlist = $user->get_users(null,null,null,['admin', 'user']);
				foreach($userlist->get()->getResult() as $value){
					$this->db->table('crud_access')->insert(['id' => $value->id, 'menu_id' => $menu, 'sub_menu_id' => $submenuID]);	
				}
			}
			//
			echo 'Success :  Sub Menu Added Successfully';
			//
			$this->db->transComplete();
		}else{
			echo $error;
		}
	}
	//
	public function update_menu_content(){
		$id = $this->input->getPost('id');
		$model_menu = new Model_Menu();
		$sub_menu = $model_menu->submenu_menu($id)->get()->getRow();
		$main_menu = $model_menu->main_menu();
		//
		?>
		<input type="hidden" name="id" value="<?= $sub_menu->id;?>">
		<div class="form-group">
			<label for="exampleFormControlInput1">Sub Menu</label>
			<input type="text" class="form-control" name="submenu" id="exampleFormControlInput1" required="" value="<?= $sub_menu->submenu;?>">
		</div>
		<div class="form-group">
			<label for="exampleFormControlInput1">Menu</label>
			<select class="form-control" name="menu" required>
				<option value="">Select Parent Menu</option>
				<?php foreach($main_menu->get()->getResult() as $value){?>
					<option value="<?= $value->id;?>" <?= ($value->id == $sub_menu->menu_id) ? 'selected' : '';?> ><?= $value->menu;?></option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleFormControlInput1">Route</label>
			<input type="text" class="form-control" name="route" id="exampleFormControlInput1" required="" value="<?= $sub_menu->route;?>">
		</div>
		<?php
	}
	//
	public function update_sub_menu(){
		$error = null;
		$id = $this->input->getPost('id');
		$submenu = $this->input->getPost('submenu');
		$menu = $this->input->getPost('menu');
		$route = $this->input->getPost('route');
		//
		$validate = $this->validate([
			'submenu' => ['label' => 'Sub Menu', 'rules' => 'required|trim'],
			'menu' => ['label' => 'Menu', 'rules' => 'required|trim'],
			'route' => ['label' => 'Route', 'rules' => 'required|trim'],
		]);
		
		if(!$validate){
			$error = $this->validation->listErrors();
		}
		//
		if(empty($error)){
			$this->db->transStart();
			//
			$data = array('submenu' => $submenu, 'menu_id' => $menu, 'route' => $route);
			$this->db->table('sub_menus')->where('id',$id)->update($data);
			//
			$this->db->table('crud_access')->where('sub_menu_id',$id)->update(['menu_id' => $menu]);
			//
			echo 'Success :  Sub Menu Updated Successfully';
			//
			$this->db->transComplete();
		}else{
			echo $error;
		}
	}
}
