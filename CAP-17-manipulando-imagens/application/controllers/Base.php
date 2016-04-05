<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {

	public function index()
	{
		$this->load->view('home');
	}

	public function Upload()
	{
		if (!$this->upload->do_upload('image'))
		{
			$data['info'] = $this->upload->display_errors();
		}
		else
		{
			$data['info'] = "Imagem processada com sucesso!";
			$data['info_upload'] = $this->upload->data();

			if($this->input->post('thumbnail'))
			{
				$configThumbnail['source_image']   = $data['info_upload']['full_path'];
				$configThumbnail['maintain_ratio'] = TRUE;
				$configThumbnail['width']          = 75;
				$configThumbnail['height']         = 50;

				$thumbnail = $this->GenThumbnail($configThumbnail);

				if(!$thumbnail['status'])
				{
					$data['info'] .= "<br/>Não foi possível gerar o thumbnail devido ao(s) erro(s) abaixo:<br />";
					$data['info'] .= $thumbnail['message'];
				}
				else
				{
					$data['info_upload']['thumb_path'] = $data['info_upload']['file_path']."/thumbs/".$data['info_upload']['raw_name']."_thumb".$data['info_upload']['file_ext'];
				}
			}

			if($this->input->post('width') || $this->input->post('height'))
			{
				$configResize['source_image']   = $data['info_upload']['full_path'];
				$configResize['maintain_ratio'] = ($this->input->post('ratio')) ? TRUE : FALSE;
				$configResize['width']          = ($this->input->post('width')) ? $this->input->post('width') : null;
				$configResize['height']         = ($this->input->post('height')) ? $this->input->post('height') : null;

				$resize = $this->ResizeImage($configResize);

				if(!$resize['status'])
				{
					$data['info'] .= "<br/>Não foi possível redimensionar a imagem devido ao(s) erro(s) abaixo:<br />";
					$data['info'] .= $resize['message'];
				}
				else
				{
					$data['info_upload']['resize_path'] = $data['info_upload']['file_path']."/resized/".$data['info_upload']['raw_name'].$data['info_upload']['file_ext'];
				}
			}

			if($this->input->post('rotation'))
			{
				$configRotate['source_image']   = $data['info_upload']['full_path'];
				$configRotate['rotation_angle'] = $this->input->post('rotation');

				$rotate = $this->RotateImage($configRotate);

				if(!$rotate['status'])
				{
					$data['info'] .= "<br/>Não foi possível redimensionar a imagem devido ao(s) erro(s) abaixo:<br />";
					$data['info'] .= $rotate['message'];
				}
				else
				{
					$data['info_upload']['rotate_path'] = $data['info_upload']['file_path']."/rotated/".$data['info_upload']['raw_name'].$data['info_upload']['file_ext'];
				}
			}
			if($this->input->post('crop'))
			{
				$configCrop['source_image']   = $data['info_upload']['full_path'];

				$crop = $this->CropImage($configCrop);

				if(!$crop['status'])
				{
					$data['info'] .= "<br/>Não foi possível recortar a imagem devido ao(s) erro(s) abaixo:<br />";
					$data['info'] .= $crop['message'];
				}
				else
				{
					$data['info_upload']['crop_path'] = $data['info_upload']['file_path']."/cropped/".$data['info_upload']['raw_name'].$data['info_upload']['file_ext'];
				}
			}
			if($this->input->post('watermark'))
			{
				$configWM['source_image'] = $data['info_upload']['full_path'];

				$wm = $this->ApplyWatermark($configWM);

				if(!$wm['status'])
				{
					$data['info'] .= "<br/>Não foi possível aplicar a marca d'água na imagem devido ao(s) erro(s) abaixo:<br />";
					$data['info'] .= $wm['message'];
				}
				else
				{
					$data['info_upload']['wm_path'] = $data['info_upload']['file_path']."/watermark/".$data['info_upload']['raw_name'].$data['info_upload']['file_ext'];
				}
			}
		}
		$this->load->view('home', $data);
	}

	private function GenThumbnail($config)
	{
		$config['image_library'] = 'gd2';
		$config['create_thumb'] = TRUE;
		$config['new_image'] = "./uploads/thumbs/";

		$this->image_lib->initialize($config);

		if (!$this->image_lib->resize())
		{
			$data['message'] = $this->image_lib->display_errors();
			$data['status'] = false;
		}
		else
		{
			$data['message'] = null;
			$data['status'] = true;
		}
		$this->image_lib->clear();
		return $data;
	}

	private function ResizeImage($config)
	{
		$config['image_library'] = 'gd2';
		$config['create_thumb'] = FALSE;
		$config['new_image'] = "./uploads/resized/";

		$this->image_lib->initialize($config);

		if (!$this->image_lib->resize())
		{
			$data['message'] = $this->image_lib->display_errors();
			$data['status'] = false;
		}
		else
		{
			$data['message'] = null;
			$data['status'] = true;
		}
		$this->image_lib->clear();
		return $data;
	}

	private function RotateImage($config)
	{
		$config['image_library'] = 'gd2';
		$config['new_image'] = "./uploads/rotated/";

		$this->image_lib->initialize($config);

		if (!$this->image_lib->rotate())
		{
			$data['message'] = $this->image_lib->display_errors();
			$data['status'] = false;
		}
		else
		{
			$data['message'] = null;
			$data['status'] = true;
		}
		$this->image_lib->clear();
		return $data;
	}

	private function CropImage($config)
	{
		$config['image_library'] = 'gd2';
		$config['new_image'] = "./uploads/cropped/";
		$config['width'] = 300;
		$config['height'] = 300;
		$config['x_axis'] = 50;
		$config['y_axis'] = 50;

		$this->image_lib->initialize($config);

		if (!$this->image_lib->crop())
		{
			$data['message'] = $this->image_lib->display_errors();
			$data['status'] = false;
		}
		else
		{
			$data['message'] = null;
			$data['status'] = true;
		}
		$this->image_lib->clear();
		return $data;
	}

	private function ApplyWatermark($config){
		$config['new_image'] = "./uploads/watermark/";
		$config['wm_type'] = 'overlay';
		$config['wm_overlay_path'] = './assets/images/watermark.png';
		$config['wm_opacity'] = '50';

		$this->image_lib->initialize($config);

		if (!$this->image_lib->watermark())
		{
			$data['message'] = $this->image_lib->display_errors();
			$data['status'] = false;
		}
		else
		{
			$data['message'] = null;
			$data['status'] = true;
		}
		$this->image_lib->clear();
		return $data;
	}
}
