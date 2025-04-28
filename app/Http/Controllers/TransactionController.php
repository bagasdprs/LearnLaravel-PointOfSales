<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Orders;
use App\Models\orderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Orders";
        $datas = Orders::orderby('id', 'desc')->get();
        return view('kasir.index', compact('title', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::orderby('id', 'desc')->get();
        return view('pos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // code unique : ORD-1004025001
        // 
        // return $request->all();
        $validation  = Validator::make($request->all(), [
            'cart' => 'required',
            'cash' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'change' => 'required|numeric|min:0'
        ]);

        if ($validation->fails()) {
            return redirect()->back()
                ->withErrors($validation)
                ->withInput();
        }

        $cart = json_decode($request->cart, true);

        $latestIdOrder = Orders::max('id') + 1;

        $order = Orders::create([
            'order_code' => $this->generateOrderCode($latestIdOrder),
            'order_date' => now(),
            'order_amount' => $request->total,
            'order_change' =>  $request->change,
            'order_status' =>  1,
        ]);

        foreach ($cart as $item) {
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $item['productId'],
                'qty' => $item['qty'],
                'order_price' => $item['price'],
                'order_subtotal' => $item['qty'] * $item['price'],
            ]);
        }

        Alert::success('Success', 'Transaction successful');
        return redirect()->route('kasir');
    }

    private function generateOrderCode($orderId)
    {
        $prefix = 'POS';
        $date = now()->format('Ymd');

        return "{$prefix}-{$date}-" . str_pad($orderId, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Order
        $order = Orders::findOrFail($id);
        $orderDetails = orderDetails::with('product')->where('order_id', $id)->get();
        $title = "Order Details of " . $order->order_code;
        return view('pos.show', compact('order', 'orderDetails', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Products::find($id);
        $categories = Categories::orderby('id', 'desc')->get();
        // $categories = Categories::all();
        return view('products.edit', compact('edit', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = [
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
            'is_active' => $request->is_active,
        ];

        $product = Products::find($id);
        if ($request->hasFile('product_photo')) {
            // JIka gambar sudah ada dan mau diubah, maka gambar lama dihapus
            if ($product->product_photo) {
                File::delete(public_path('storage/' . $product->product_photo));
            }

            $photo = $request->file('product_photo')->store('products', 'public');
            $data['product_photo'] = $photo;
        }

        $product->update($data);
        Alert::success('Success', 'Success Edited');
        // Alert::toast('Success', 'Data Successfully Edited');
        return redirect()->to('products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::find($id);
        // delete photo from storage
        File::delete(public_path('storage/' . $product->product_photo));
        $product->delete();
        // $category = Categories::find($id);
        // $category->delete();

        Alert::success('Deleted', 'Deleted successfully');
        return redirect()->to('products');
    }

    // public function getProduct($category_id)
    // {
    //     $products = Products::where('category_id', $category_id)->get();
    //     $response = ['status' => 'success', 'message' => 'Fetch product successfully', 'data' => $products];
    //     return response()->json($response, 200);
    // }

    // public function printStruk($id)
    // {
    //     $order = Orders::findOrFail($id);
    //     $orderDetails = orderDetails::with('product')->where('order_id', $id)->get();
    //     $title = "Order Details of " . $order->order_code;
    //     return view('pos.print-struk', compact('order', 'orderDetails', 'title'));
    // }

    // public function report()
    // {
    //     $datas = Orders::with('orderDetails')->get();
    //     return view('pimpinan.report', compact('datas'));
    // }

    public function report(Request $request)
    {
        $query = Orders::with('orderDetails');

        if ($request->filter) {
            $today = now();

            if ($request->filter == 'daily') {
                $query->whereDate('order_date', $today);
            } elseif ($request->filter == 'daily') {
                $query->whereBetween('order_date', [$today->startOfWeek(), $today->endOfWeek()]);
            } elseif ($request->filter == 'weekly') {
                $startDate = now()->subDays(14);
                $query->whereBetween('order_date', [$startDate, now()]);
            } elseif ($request->filter == 'monthly') {
                $query->whereMonth('order_date', $today->month)->whereYear('order_date', $today->year);
            } elseif ($request->filter == 'yearly') {
                $query->whereYear('order_date', $today->year);
            }
        }

        $datas = $query->orderBy('order_date', 'desc')->get();
        return view('pimpinan.index', compact('datas'));
    }


    public function stock()
    {
        $datas = Products::all(); // Ambil semua produk
        return view('pimpinan.stock', compact('datas'));
    }
}
