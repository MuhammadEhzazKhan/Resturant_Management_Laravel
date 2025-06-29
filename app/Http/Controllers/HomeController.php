<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Food;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Employee;
use App\Models\Book;
use App\Models\Review;
use App\Models\Table;
use App\Models\Invoice;
use Exception;

class HomeController extends Controller
{

    public function my_home()
    {
        try {
            $data = Food::all();
            $reviews = Review::with(['food', 'user'])->orderBy('date', 'desc')->take(3)->get();
            $tables = Table::all();
            
            return view('home.index', compact('data', 'reviews', 'tables'));
        } catch (Exception $e) {
            \Log::error('Error in my_home method: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Error loading home page: ' . $e->getMessage(),
                'timestamp' => now()
            ], 500);
        }
    }

    // Home page logic for each user type
    public function index()
    {
        if (Auth::check()) {
            $usertype = Auth()->user()->usertype;

            if ($usertype === 'user') {
                $data = Food::all();
                $reviews = Review::with(['food', 'user'])->orderBy('date', 'desc')->take(3)->get();
                $tables = Table::all();

                return view('home.index', compact('data', 'reviews', 'tables'));
            }

            if ($usertype === 'admin') {
                $total_user = User::where('usertype', 'user')->count();
                $total_food = Food::count();
                $total_order = Order::count();
                $total_delivered = Order::where('status', 'Delivered')->count();

                return view('admin.index', compact('total_user', 'total_food', 'total_order', 'total_delivered'));
            }

            if ($usertype === 'employee') {
                $orders = Order::where('status', '!=', 'Delivered')->get();
                return view('employee.index', compact('orders'));
            }

            return redirect('/')->with('error', 'Invalid user type.');
        }

        return redirect('login');
    }

    // Add item to cart
    public function add_cart(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1'
        ]);

        if (Auth::check()) {
            $food = Food::findOrFail($id);

            $cart = new Cart();
            $cart->user_id = Auth::id();
            $cart->food_id = $food->id;
            $cart->quantity = $request->qty;
            $cart->price = Str::remove('$', $food->price) * $request->qty;
            $cart->save();

            return redirect()->back()->with('success', 'Item added to cart');
        }

        return redirect('login');
    }

    // View user's cart
    public function my_cart()
    {
        $user_id = Auth::id();
        $data = Cart::with('food')->where('user_id', $user_id)->get();
        return view('home.my_cart', compact('data'));
    }

    // Remove item from cart
    public function remove_cart($id)
    {
        $item = Cart::find($id);
        $item?->delete();
        return redirect()->back()->with('success', 'Item removed from cart');
    }

    // Table booking
    public function book_table(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'n_guest' => 'required|integer|min:1',
            'time' => 'required',
            'date' => 'required|date',
            'table_id' => 'required|integer',
        ]);

        $data = new Book();
        $data->phone = $request->phone;
        $data->guests = $request->n_guest;
        $data->time = $request->time;
        $data->date = $request->date;
        $data->table_id = $request->table_id;
        $data->save();

        return redirect()->back()->with('success', 'Table booked successfully!');
    }

    public function show_book_table_form()
    {
        $tables = Table::all();
        return view('home.book_table', compact('tables'));
    }

    // Confirm order (used if you keep it)
    public function confirm_order(Request $request)
    {
        $user = Auth()->user();
        $cart_items = Cart::where('user_id', $user->id)->get();
        $employee = Employee::first();

        foreach ($cart_items as $cart) {
            $order = Order::create([
                'user_id' => $user->id,
                'food_id' => $cart->food_id,
                'amount' => $cart->price,
                'status' => 'Pending',
                'employee_id' => $employee?->id,
            ]);

            $cart->delete();
        }

        return redirect()->back()->with('success', 'Order confirmed successfully!');
    }

    // Generate invoice from cart
    public function generate_invoice()
{
    $user = Auth()->user();
    $cart_items = Cart::where('user_id', $user->id)->get();
    $employee = Employee::first();

    $invoiceItems = [];

    foreach ($cart_items as $cart) {
        $order = new Order();
        $order->user_id = $user->id;
        $order->food_id = $cart->food_id;
        $order->amount = $cart->price;
        $order->status = 'Pending';
        $order->employee_id = $employee?->id;
        $order->save();

        $invoice = Invoice::create([
            'order_id' => $order->id,
            'user_id' => $user->id,
            'amount' => $order->amount,
            'status' => 'Cash on Delivery',
            'date' => now(),
        ]);

        $invoiceItems[] = $invoice;

        $cart->delete();
    }

    return view('home.invoice', ['invoices' => $invoiceItems]);
}

    // Show all invoices for the logged-in user
    public function show_invoice()
    {
        $user_id = Auth::id();
        $invoices = Invoice::where('user_id', $user_id)->get();
        return view('home.invoice', compact('invoices'));
    }
}
