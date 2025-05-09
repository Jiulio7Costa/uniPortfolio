<?php
namespace App\Helper;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;

class Cart{
    public static function getCount() {
        if($user = auth()->user()){
            return CartItem::whereUserId($user->id)->count();
        }
        else{
            return array_reduce(self::getCookieCartItems(), fn ($carry, $item) => $carry + $item['quantity'], 0);
        }
  
    }

    public static function getCartItems(){
        if($user = auth()->user()){
            return CartItem::whereUserId($user->id)->get()->map(fn (CartItem $item)=> ['product_id' => $item->product_id, 'quantity' => $item->quantity]);
        } else {
            return self::getCookieCartItems();
        }
    }

    public static function getCookieCartItems() {
        return json_decode(request()->cookie('cart_items','[]'), true);
    }

    public static function setCookieCartItems(array $cartItems) {
       
        // Store the total quantity in the cookie
        Cookie::queue('cart_items', json_encode($cartItems), 60*24*30); 
    }


    public static function saveCookieCartItems() {
        $user = auth()->user();
        $userCartItems = CartItem::where(['user_id' => $user->id])->get()->keyBy('product_id');
        $saveCartItems = [];
        foreach(self::getCookieCartItems() as $cartItem)
        {
            if(isset($userCartItems[$cartItem['product_id']])){
                $userCartItems[$cartItem['product_id']]->update(['quantity' => $cartItem['quantity']]);
                continue;
            }
            $savedCartItems[] = [
                'user_id' => $user->id,
                'product_id' => $cartItems['product_id'],
                'quantity' => $cartItems['quantity'],
            ];
        }
        if (!empty($savedCartItems)){
            CartItem::insert($savedCartItems);
        }
    }

    public static function moveCartItemsIntoDb(){
        $request = request();
        $newCartItems = self::getCookieCartItems();
        $newCartItems = [];
        foreach ($cartItems as $cartItem) {
            //check if the record already exists in the database
            $existingCartItem = CartItem::where([
                'user_id' => $request->user()->id,
                'product_id' => $cartItem['product_id'],
            
            ])->first();

            if (!$existingCartItems) {
                //Only insert if it doesn't already exist
                $newCartItems[] = [
                    'user_id' => $eequest->user()->id,
                    'product_id' => $cartItem['product_id'],
                    'quantity' => $cartItem['quanity'],
                ];
            }
        }

        if (!empty($newCartItems)) {
            //Insert the new cart items into the db
            CartItem::insert($newCartItems);
        }
    }

    public static function getProductsAndCartItems() {
        $cartItems = self::getCartItems();
        $ids = Arr::pluck($cartItems, 'product_id');
        $products = Product::whereIn('id', $ids)->with('product_images')->get();
        $cartItems = Arr::keyBy($cartItems, 'product_id');
        return [$products, $cartItems];
        
    }


}