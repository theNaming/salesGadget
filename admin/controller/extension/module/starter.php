<?php

class ControllerExtensionModuleStarter extends Controller {
	
	private $error = array(); 
	
	public function index() {   

		//Load language file
		$this->load->language('extension/module/starter');

		//Set title from language file
		$this->document->setTitle($this->language->get('heading_title'));
		
		//Load settings model
		$this->load->model('extension/module');
		
		//Save settings
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('starter', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$text_strings = array(
			'heading_title',
			'button_save',
			'button_cancel',
			'button_add_module',
			'button_remove',
			'placeholder',
			'text_enabled',
			'text_disabled',
			'error_name',
			'entry_name',
			'entry_status',
			'custom_field',
			);
		
		foreach ($text_strings as $text) {
			$data[$text] = $this->language->get($text);
		}
		

		//error handling
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		if (isset($this->error['field'])) {
			$data['error_field'] = $this->error['field'];
		} else {
			$data['error_field'] = '';
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
			);

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
			);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL')
			);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/starter', 'token=' . $this->session->data['token'], 'SSL')
				);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/starter', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
				);
		}
		
		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/starter', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('extension/module/starter', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}

		//Must Have Module fields

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}

		// Custom module fields

		if (isset($this->request->post['field'])) {
			$data['field'] = $this->request->post['field'];
		} elseif (!empty($module_info)) {
			$data['field'] = $module_info['field'];
		} else {
			$data['field'] = '';
		}

		//Prepare for display
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		//Send the output
		$this->response->setOutput($this->load->view('extension/module/starter.tpl', $data));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/starter')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if ((utf8_strlen($this->request->post['field']) < 3) || (utf8_strlen($this->request->post['field']) > 64)) {
			$this->error['field'] = $this->language->get('error_field');
		}

		return !$this->error;

	}

}
