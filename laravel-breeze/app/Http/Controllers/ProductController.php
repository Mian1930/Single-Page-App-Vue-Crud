<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::all()->toArray(); // all() method gets all the products from the db and toArray() is a method that converts the result to an array.
        $user_id = Auth::id();
            $products = Product::where('user_id', $user_id)->get();
            if ($products) {
                return response()->json(['products' => $products]);
            }
        // return array_reverse($products);    
        // $product = Product::where('visibility', 'logged_in')->get();
        
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'detail' => 'required|max:50|min:2',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
            
        }
        $user = \Auth::user();
        \Log::info('delete', [$user->id]);
        $product = new Product([
            
            'name' => $request->input('name'),
            'detail' => $request->input('detail'),
            'user_id'=>$user->id

        ]);
        $product->save();
        return response()->json('Product created!');
    }
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }
    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);
        \Log::info($product);
        if ($product) {
            \Log::info($id);
            $product->name = $request->name;
            \Log::info($request);
            $product->detail = $request->detail;
        }
       \Log::info($request);
        $product->save();
        \Log::info($request);
        return $product;
        
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json();
       
    }
}




