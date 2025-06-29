<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Food;

use App\Models\Order;

use App\Models\Book;

use App\Models\Table;

use App\Models\Employee;

use App\Models\Invoice;

class AdminController extends Controller
{
    public function add_food()
    {
        return view('admin.add_food');
    }

    public function upload_food(Request $request)
    {
        $data = new Food;
        $data->title = $request->input('title');
        $data->detail = $request->input('details');
        $data->price = $request->input('price');

        $image = $request->file('img');
        $filename = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('food_img'), $filename);

        $data->image = $filename;
        $data->save();

        return redirect()->back();
    }

    public function view_food()
    {
        $data = Food::all();
        return view('admin.show_food', compact('data'));
    }

    public function delete_food($id)
    {
        $data = Food::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function update_food($id)
    {
        $food = Food::find($id);
        return view('admin.update_food', compact('food'));
    }

    public function edit_food(Request $request, $id)
    {
        $data = Food::find($id);
        $data->title = $request->title;
        $data->detail = $request->details;
        $data->price = $request->price;
        $image = $request->image;
        if($image)
        {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('food_img', $imagename);
            $data->image = $imagename;
        }
        $data->save();
        return redirect('view_food');
    }

public function orders()
{
    $data = Order::with(['user', 'food'])->get(); // Optional: eager load relations
    return view('admin.order', compact('data'));
}

public function on_the_way($id)
{
    $data = Order::find($id);
    $data->status = "On The Way";
    $data->save();
    return redirect()->back();
}

public function delivered($id)
{
    $data = Order::find($id);
    $data->status = "Delivered";
    $data->save();
    return redirect()->back();
}

public function cancel($id)
{
    $data = Order::find($id);
    $data->status = "Cancelled";
    $data->save();
    return redirect()->back();
}

    public function reservations()
    {
        $book = Book::all();
        return view('admin.reservation', compact('book'));
    }

    public function add_table()
    {
        return view('admin.add_table');
    }

    public function upload_table(Request $request)
    {
        $data = new Table;
        $data->capacity = $request->capacity;
        $data->details = $request->details;
        $data->status = $request->status;

        $data->save();

        return redirect()->back();
    }

    public function view_table()
    {
        $data = Table::all();
        return view('admin.view_table', compact('data'));
    }

    public function delete_table($id)
    {
        $data = Table::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function update_table($id)
    {
        $table = Table::find($id);
        return view('admin.update_table', compact('table'));
    }

    public function edit_table(Request $request, $id)
    {
        $data = Table::find($id);
        $data->id = $request->id;
        $data->capacity = $request->capacity;
        $data->details = $request->details;
        $data->status = $request->status;
        $data->save();
        return redirect('view_table');
    }

    public function add_employee()
    {
        return view('admin.add_employee');
    }

    public function upload_employee(Request $request)
    {
        $data_employee = new Employee;
        $data_employee->name = $request->name;
        $data_employee->role = $request->role;
        $data_employee->phone = $request->phone;
        $data_employee->salary = $request->salary;
        $data_employee->shift_timing = $request->shift_timing;
        $data_employee->date_of_joining = $request->date_of_joining;

        $data_employee->save();

        return redirect()->back();
    }

        public function view_employee()
    {
        $data = Employee::all();
        return view('admin.view_Employee', compact('data'));
    }

    public function delete_employee($id)
    {
        $data_employee = Employee::find($id);
        $data_employee->delete();
        return redirect()->back();
    }

public function invoices()
{
    $invoices = Invoice::with(['order', 'user'])->get(); // eager load related order and user
    return view('admin.invoices', compact('invoices'));
}

}



