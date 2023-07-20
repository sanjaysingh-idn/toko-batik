<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\City;
use App\Models\Banner;
use App\Models\DetailPesanan;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Pesanan;
use App\Models\Province;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartList()
    {
        // dd(Cart::getContent());
        return view('home.cart', [
            'title'         => 'Halaman Keranjang',
            'kategori'      => Kategori::all(),
            'produk'        => Produk::all(),
            'banner'        => Banner::all(),
            'cartItems'     => Cart::getContent(),
        ]);
    }


    public function addToCart(Request $request)
    {
        // $userID = Auth::user()->id;
        $produk = Produk::find($request->id);
        $rowID = mt_rand(100, 999);
        Cart::add([
            'id' => $rowID,
            'name' => $produk->name,
            'price' => $produk->harga,
            'quantity' => $request->qty,
            'attributes' => [
                'image' => $produk->image,
                'ukuran' => $request->ukuran,
                'berat' => $produk->berat,
            ],
            'associatedModel' => $produk,
        ]);
        session()->flash('success', 'Product is Added to Cart Successfully !');

        return redirect()->route('keranjang');
    }

    public function updateCart(Request $request)
    {
        Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('keranjang');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('keranjang');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('keranjang');
    }

    public function decreaseQuantity($rowId)
    {
        Cart::update($rowId, ['quantity' => -1]);

        session()->flash('success', 'Cart Quantity is Updated Successfully !');
        return redirect()->back();
    }

    public function increaseQuantity($rowId)
    {
        Cart::update($rowId, ['quantity' => 1]);

        session()->flash('success', 'Cart Quantity is Updated Successfully !');
        return redirect()->back();
    }

    public function getProvince()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 7072d2cd2b5fa1db71857e7808b3a5ff"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //ini kita decode data nya terlebih dahulu
            $response = json_decode($response, true);
            //ini untuk mengambil data provinsi yang ada di dalam rajaongkir resul
            $data_pengirim = $response['rajaongkir']['results'];
            return $data_pengirim;
        }
    }

    public function getCity($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 7072d2cd2b5fa1db71857e7808b3a5ff"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            $data_kota = $response['rajaongkir']['results'];
            return json_encode($data_kota);
        }
    }

    public function getOngkir($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 7072d2cd2b5fa1db71857e7808b3a5ff"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            $data_ongkir = $response['rajaongkir']['results'];
            return json_encode($data_ongkir);
        }
    }

    public function checkout()
    {
        $cartItems = Cart::getContent();

        if ($cartItems->isEmpty()) {
            abort(404);
        }

        $city_origin = 445;

        $provinces = $this->getProvince();

        return view('home.checkout', [
            'title'         => 'Halaman Checkout',
            'kategori'      => Kategori::all(),
            'cartItems'     => $cartItems,
            'provinces'     => $provinces,
            'produk'        => Produk::all(),
            'banner'        => Banner::all(),
            'city_origin'   => $city_origin,
        ]);
    }

    public function order_store(Request $request)
    {
        // Generate order number
        $currentDate = now()->format('Ymd');
        $year = date('Y');
        $randomString = Str::upper(Str::random(4));


        $orderNumber = $currentDate . $year . $randomString;

        $attr = $request->validate([
            'name'      => 'required|max:255',
            'email'     => 'required|email:dns|max:255',
            'contact'   => 'required|numeric',
            'province_id'  => 'required|max:255',
            'city_id'      => 'required|max:255',
            'courier'   => 'required|max:255',
            'service'   => 'required|max:255',
            'address'   => 'required|max:255',
            'pos_code' => 'required|max:255',
            'catatan'   => 'max:255',
            'ongkir'    => 'required',
            'weight'    => 'required',
        ]);

        $attr = $request->all();
        $attr['order_number']   = $orderNumber;
        $attr['total_shopping'] = Cart::getTotal() + $attr['ongkir'];
        $attr['user_id']        = Auth()->user()->id;

        $pesanan = Pesanan::create($attr);
        $pesananId = $pesanan->id;

        $cartItems = Cart::getContent();

        foreach ($cartItems as $item) {
            $associatedModel = $item->associatedModel;
            $associatedModelId = $associatedModel->id;

            $attributes = $item->attributes;
            $ukuran = $attributes->get('ukuran');

            DetailPesanan::create([
                'pesanan_id'    => $pesananId,
                'produk_id'     => $associatedModelId,
                'product_name'  => $item->name,
                'quantity'      => $item->quantity,
                'size'          => $ukuran,
                'price'         => $item->price,
            ]);
        }

        Cart::clear();

        // redirect ke halaman daftar pesanan saya
        return redirect('/pesanan_saya')->with('success', 'Pesanan telah dibuat, segera selesaikan pembayaran anda');
    }

    public function pesanan_saya()
    {
        $userId = Auth::id();
        $pesanan = Pesanan::where('user_id', $userId)
            ->with('pesananDetails')
            ->get();
        $pesananUnpaid = Pesanan::where('user_id', $userId)
            ->where('status', 'unpaid')
            ->get();
        $pesananPaid = Pesanan::where('user_id', $userId)
            ->where('status', 'paid')
            ->get();
        $pesananDikirim = Pesanan::where('user_id', $userId)
            ->where('status', 'dikirim')
            ->get();
        $pesananSelesai = Pesanan::where('user_id', $userId)
            ->where('status', 'selesai')
            ->get();


        foreach ($pesananUnpaid as $pu) {
            $pesananOrderNumber = $pu->order_number;
            $pesananTotal = $pu->total_shopping;
            $pesananName = $pu->name;
            $pesananEmail = $pu->email;
            $pesananPhone = $pu->contact;
        }


        // dd($pesanan);

        // // Set your Merchant Server Key
        // \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        // \Midtrans\Config::$isProduction = false;
        // // Set sanitization on (default)
        // \Midtrans\Config::$isSanitized = true;
        // // Set 3DS transaction for credit card to true
        // \Midtrans\Config::$is3ds = true;

        // $params = array(
        //     'transaction_details' => array(
        //         'order_id' => $pesananOrderNumber,
        //         'gross_amount' => $pesananTotal,
        //     ),
        //     'customer_details' => array(
        //         'name' => $pesananName,
        //         'email' => $pesananEmail,
        //         'phone' => $pesananPhone,
        //     ),
        // );

        // $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('home.pesanan_saya', [
            'title'         => 'Halaman Pesanan Saya',
            'kategori'      => Kategori::all(),
            'produk'        => Produk::all(),
            'banner'        => Banner::all(),
            'pesanan'       => $pesanan,
            'pesananUnpaid' => $pesananUnpaid,
            'pesananPaid'   => $pesananPaid,
            'pesananDikirim' => $pesananDikirim,
            'pesananSelesai' => $pesananSelesai,
            // 'snapToken' => $snapToken,
            'cartItems'     => Cart::getContent(),
        ]);
    }

    public function invoice($id)
    {
        $pesanan = Pesanan::where('order_number', $id)->firstOrFail();
        if ($pesanan->status === 'unpaid') {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => $pesanan->order_number,
                    'gross_amount' => $pesanan->total_shopping,
                ),
                'customer_details' => array(
                    'name' => $pesanan->name,
                    'email' => $pesanan->email,
                    'phone' => $pesanan->contact,
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);
        } else {
            $snapToken = null;
        }
        return view('home.invoice', [
            'title'         => 'Halaman Invoice - ' . $pesanan->order_number,
            'kategori'      => Kategori::all(),
            'produk'        => Produk::all(),
            'banner'        => Banner::all(),
            'snapToken'     => $snapToken,
            'pesanan'       => $pesanan,
        ]);
    }

    public function bayar($id)
    {
        $pesanan = Pesanan::where('order_number', $id)->firstOrFail();
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $pesanan->order_number,
                'gross_amount' => $pesanan->total_shopping,
            ),
            'customer_details' => array(
                'name' => $pesanan->name,
                'email' => $pesanan->email,
                'phone' => $pesanan->contact,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return $snapToken;
    }

    public function destroy($id)
    {
        // Find the cart item by ID and delete it
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        // Redirect to a success page or back to the previous page
        return redirect('/pesanan_saya')->with('success', 'Pesanan Berhasil dihapus');
    }
}
