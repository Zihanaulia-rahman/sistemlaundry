<?php

namespace App\Http\Controllers;

use App\Models\LaundryItem;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $laundry_items = LaundryItem::all();
        return view('customer.index', compact('laundry_items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone'         => 'nullable|string|max:20',
            'status_bayar'  => 'nullable|string|in:Belum Lunas,Lunas',
            'items'         => 'required|array',
            'items.*'       => 'nullable|numeric|min:0',
        ]);

        $orderedItems = array_filter($request->items, fn ($qty) => $qty > 0);

        if (empty($orderedItems)) {
            return back()->with('error', 'Pilih minimal satu layanan!');
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'phone'         => $request->phone,
                'status_bayar'  => $request->input('status_bayar', 'Belum Lunas'),
                'total_price'   => 0,
                'status'        => 'pending',
            ]);

            $totalPrice = 0;

            foreach ($orderedItems as $laundryItemId => $quantity) {
                $laundryItem = LaundryItem::findOrFail($laundryItemId);
                $subtotal = $laundryItem->price * $quantity;
                $totalPrice += $subtotal;

                OrderDetail::create([
                    'order_id'        => $order->id,
                    'laundry_item_id' => $laundryItem->id,
                    'quantity'        => $quantity,
                    'price'           => $subtotal,
                ]);
            }

            $order->update(['total_price' => $totalPrice]);
            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Pesanan laundry #' . $order->id . ' untuk ' . $order->customer_name . ' berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }

    public function adminDashboard()
    {
        $orders = Order::with('orderDetails.laundryItem')->latest()->get();
        $totalLayananAktif = LaundryItem::count();

        return view('dashboard', compact('orders', 'totalLayananAktif'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Pastikan hanya admin yang dapat memperbarui status pengerjaan / menyelesaikan orderan
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return back()->with('error', 'Akses ditolak: Hanya Administrator yang berhak menyelesaikan atau memperbarui status pengerjaan orderan.');
        }

        $request->validate(['status' => 'required|string']);
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pengerjaan pesanan #' . $order->id . ' berhasil diperbarui!');
    }

    public function updateStatusBayar(Request $request, $id)
    {
        $request->validate(['status_bayar' => 'required|string|in:Belum Lunas,Lunas']);
        $order = Order::findOrFail($id);
        $order->update(['status_bayar' => $request->status_bayar]);

        return back()->with('success', 'Status pembayaran pesanan #' . $order->id . ' diperbarui menjadi: ' . $request->status_bayar);
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak: Hanya Admin yang dapat menghapus data transaksi.');
        }

        $order = Order::findOrFail($id);
        $order->orderDetails()->delete();
        $order->delete();

        return redirect()->route('dashboard')->with('success', 'Transaksi #' . $id . ' berhasil dihapus.');
    }
}
