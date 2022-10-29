<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\brand;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    function index()
    {
        return view('welcome');
    }
    function table()
    {
        $brands = DB::table('brand')->orderBy('brand_name', 'asc')->get();

        return view('table', ['brand' => $brands]);
        return view('table');
    }
    public function getModel(Request $request)
    {
        $bid = $request->post('bid');
        $Model = DB::table('model')->where(
            'brand_id',
            $bid
        )->get();
        $html = '<option value="" selected disabled>Select
       model</option>';
        foreach ($Model as $list) {

            $html .= '<option value="' . $list->id . '">' . $list->model . '</option>';
        }
        echo $html;
    }
    
    public function getModel2(Request $request)
    {
        $bid = $request->post('bid');
        $Model = DB::table('model')->where(
            'brand_id',
            $bid
        )->get();
        $html = '<option value="">Select
       model</option>';
        foreach ($Model as $list) {

            $html .= '<option value="' . $list->id . '">' . $list->model . '</option>';
        }
        echo $html;
    }
    

    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'brand' => 'required|string|max:100',
            'model' => 'required',
            'amount' => 'required|string',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->messages(),
            ]);
        } else {
            Products::create([
                'name' => $request->name,
                'brand' => $request->brand,
                'model' => $request->model,
                'amount' => $request->amount,
                'date' => $request->date,

            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Add successfully',

            ]);
        }
    }



   








    public function fetchAll()
    {


        $emps = Products::all();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>brand</th>
            <th>model</th>
            <th>date</th>
            <th>amount</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
            <td>' . $emp->id . '</td>
            <td>' . $emp->name . '</td>
            <td>' . $emp->brand . '</td>
            <td>' . $emp->model . '</td>
            <td>' . $emp->date . '</td>
            <td>' . $emp->amount . '</td>
            <td>
              <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editproductModal"><i class="bi-pencil-square h4"></i></a>

              <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon" ><i class="bi-trash h4"></i></a>
            </td>
          </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the <b>database!</b></h1>';
        }
    }

   


    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = Products::find($id);

        Products::destroy($id);
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Products::find($id);
        return response()->json($emp);
    }

    public function update(Request $request) {
		
		$emp = Products::find($request->id);
		

		$empData = ['name' => $request->name, 'brand' => $request->brand, 'model' => $request->model, 'date' => $request->date, 'amount' => $request->amount];

		$emp->update($empData);
		return response()->json([
			'status' => 200,
		]);
	}




}
