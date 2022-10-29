<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\brand;
class BrandController extends Controller
{
    function brand(){
        return view('brand');
      }
      function storebrand(Request $request)
      {
          $validator = Validator::make($request->all(), [
            
              'brand' => 'required|string|max:100',
           
          ]);
    
          if ($validator->fails()) {
              return response()->json([
                  'status' => 400,
                  'error' => $validator->messages(),
              ]);
          } else {
              brand::create([
                  
                  'brand' => $request->brand,
                  
    
              ]);
              return response()->json([
                  'status' => 200,
                  'message' => 'Add successfully',
    
              ]);
          }
      }
    
}
