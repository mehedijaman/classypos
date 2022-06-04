<?php
namespace ClassyPOS\Http\Controllers;

use ClassyPOS\Exceptions\Handler;
use ClassyPOS\product\Product;


/**
* Activity Related all operations controller
*/
class DeviceController extends Controller
{


	public function index()
	{
		return view('product.view_device');
	}

	public function List()
	{
		//$data=Product::paginate(10);
		$str = '';
		$data = Product::paginate(10);	
		if(!empty($data))
		{
			foreach ($data as  $device)
			{
				$childprint = '';
				$str.='<tr><td>'.$device->ProductID.'</td>';
				$str.='<td >'.$device->ProductName.'</td>';
				
			}
			//$json['success'] = $str;
			$pagi = ''.$data->links().'';	
		}
		else
		{
			$str='<tr><td colspan="100%">No Record Found!!</td></tr>';
			//$json['success'] = '<tr><td colspan="100%">No Record Found!!</td></tr>';
		}

		return $pagi;

		$Success=json_encode($str);
		$Page=json_encode($pagi);
		return response(['success'=>$Success,'pagi'=>$Page]);
		//return $data;
	}


	public function getdevicelist(Request $request)
	{
		$str = '';
		$data = Product::paginate(10);	
		if(!empty($data))
		{
			foreach ($data as  $device)
			{
				$childprint = '';
				$str.='<tr><td style="text-transform:capitalize;">'.$device->ProductID.'</td>';
				$str.='<td >'.$device->ProductName.'</td>';
				
			}
			$json['success'] = $str;
			$json['pagi'] = ''.$data->links().'';	
		}
		else
		{
			$json['success'] = '<tr><td colspan="100%">No Record Found!!</td></tr>';
		}
		echo json_encode($json);
	}	
	
}