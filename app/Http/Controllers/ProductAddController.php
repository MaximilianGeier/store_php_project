<?php

namespace App\Http\Controllers;

use App\Images;
use App\Orders;
use App\Products;
use App\Products_categories;
use App\Products_images;
use App\Providers\RouteServiceProvider;
use App\Shopping_cart;
use App\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class ProductAddController extends Controller
{
    public function upload(Request $request)
    {
        $path = $request->file('image')->store('uploads', 'public');

        //save image
        $image = new Images();
        $image->name = $request->input('name');
        $image->path = $path;
        $image->user_id = Auth::id();
        $image->save();

        //save product
        $product = new Products();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->count = $request->input('count');
        $product->price = $request->input('price');
        $id = Auth::id();
        $store = Stores::firstWhere('seller_id', $id);
        $product->store_id = $store->id;
        $product->save();

        //link product and categoty
        $productsCategories = new Products_categories();
        $productsCategories->product_id = $product->id;
        $productsCategories->category_id = $request->category;
        $productsCategories->save();

        // link image and product
        $productsImages = new Products_images();
        $productsImages->image_id = $image->id;
        $productsImages->product_id = $product->id;
        $productsImages->save();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function getProduct($id)
    {
        $product = Products::join('Products_images', 'Products_images.product_id', '=', 'Products.id')
            ->join('Images', 'Images.id', '=', 'Products_images.image_id')->where('Products.id', '=', $id)
            ->get(['Products.*', 'Images.path'])->first();
        return view('product', ['product' => $product]);
    }

    public function addToCart(Request $request)
    {
        $shoppingCart = new Shopping_cart();
        $shoppingCart -> user_id = Auth::id();
        $shoppingCart -> product_id = $request->input('product_id');
        $shoppingCart -> ordered_count = $request->input('count');
        $shoppingCart -> save();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * @throws ValidationException
     */
    public function getOrder(Request $request)
    {
        $keys = $request->request->keys();
        if(count($keys) <= 1)
        {
            throw ValidationException::withMessages([
                'noGoods' => 'no goods selected'
            ]);
        }
        unset($keys[0]);

        $products = Shopping_cart::join('Products', 'Products.id', '=', 'Shopping_cart.product_id')
            ->join('Products_images', 'Products_images.product_id', '=', 'Products.id')
            ->join('Images', 'Images.id', '=', 'Products_images.image_id')
            ->where('Shopping_cart.user_id', '=', Auth::id())
            ->whereIn('Shopping_cart.id', $keys)
            ->get(['Shopping_cart.id', 'Shopping_cart.ordered_count', 'Products.name', 'Products.price', 'Images.path']);
        return view('ordering', ['products' => $products, 'allID' => json_encode($keys)]);
    }


    public function makeOrder(Request $request)
    {
        if(empty($request->input('address')))
        {
            $products = json_decode($request->input('products'),true);
            $allID = $request->input('allID');
            return view('ordering', ['products' => $products, 'allID' => $allID]);
        }

        $allID = json_decode($request->input('allID'));
        foreach ($allID as $shoppingCartID)
        {
            $product = Shopping_cart::where('id',$shoppingCartID)->get()[0];
            $order = new Orders();
            $order->ordered_count = $product->ordered_count;
            $order->product_id = $product->product_id;
            $order->user_id = $product->user_id;
            $order->address = $request->input('address');
            $order->save();
            Shopping_cart::where('id',$shoppingCartID)->delete();
        }
        $order = new Orders();
        $order->ordered_count;
        return redirect()->route('home');
    }

    public function setFilters(Request $request)
    {
        $categories = \App\Categories::get();
        $products = Products::join('Products_images', 'Products_images.product_id', '=', 'Products.id')
            ->join('Images', 'Images.id', '=', 'Products_images.image_id')
            ->join('Products_categories', 'Products_categories.product_id', '=', 'Products.id')
            ->join('Categories', 'Products_categories.category_id', '=', 'Categories.id')
            ->get(['Products.*', 'Images.path', 'Products_categories.category_id']);
        if($request->category)
        {
            $products = $products->where('category_id', '=', (int)$request->category)->all();
        }

        if($request->input('price_from'))
        {
            $products = collect($products)->where('price', '>', (int)$request->input('price_from'))->all();
        }
        if($request->input('price_to'))
        {
            $products = collect($products)->where('price', '>', (int)$request->input('price_to'))->all();
        }

        if($request->sortby)
        {
            if($request->sortby === 'min_price')
            {
                $products = collect($products)->sortBy('price')->all();
            }
        }

        return view('catalog', compact('products', 'categories'));
    }

    public function search(Request $request)
    {
        $categories = \App\Categories::get();
        if($request->input('search'))
        {
            $str = '%' . strval($request->input('search')) . '%';
            $products = Products::join('Products_images', 'Products_images.product_id', '=', 'Products.id')
                ->join('Images', 'Images.id', '=', 'Products_images.image_id')
                ->join('Products_categories', 'Products_categories.product_id', '=', 'Products.id')
                ->join('Categories', 'Products_categories.category_id', '=', 'Categories.id')
                ->where('Products.name', 'like', $str)
                ->get(['Products.*', 'Images.path', 'Products_categories.category_id']);
        }
        else
        {
            $products = array();
        }

        return view('catalog', compact('products', 'categories'));
    }

    public function cancelOrder(Request $request)
    {
        $order = Orders::where('id', '=', $request['order_id']);
        $order->delete();
        return redirect()->route('home');
    }
}
