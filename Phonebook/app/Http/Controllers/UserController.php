<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Contact;
use Image;

class UserController extends Controller
{

    public function contacts()
    {
        // dd(auth()->user()->id);
        $contacts = Contact::where('id', '=', auth()->user()->id);
        return view('contacts')->with(compact('contacts'));
    }

    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email,'.$request->id,
            ];
            $customMessages = [
                'name.required' => 'Name is required!',
                'email.required' => 'Email is required!',
                'email.email' => 'Valid Email is required!',
                'email.unique' => 'Email already exists! Use different email'
            ];
            $this->validate($request, $rules, $customMessages);
            
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            $msg = "Profile Updated Successfully";
            return redirect()->route('profile', compact('msg'));
        }
        return view('editProfile');
    }

    public function changePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate(
                $request,
                [
                    'currentpass' => ['required'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ],
                []
            );
            if (Hash::check($request->currentpass, auth()->user()->password)) {
                $user = User::where('email', $request->email)->first();
                $user->password = Hash::make($request->password);
                $user->save();
                $msg = "Password Changed Successfully";
            return redirect()->route('profile', ['msg'=> $msg]);
            }
            $currentpass = 'Current Password Is Incorrect!';
            return view('change_password', compact('currentpass'));
        }
        return view('change_password');
    }

    // public function carDetails($id)
    // {
    //     $car = Car::find($id);
    //     return view('car.car_details', compact('car'));
    // }

    // public function dashboard()
    // {
    //     $cars = Car::all();
    //     return view('admin.dashboard', compact('cars'));
    // }

    // public function addEditCar(Request $request, $id=null)
    // {
    //     // dd($id);
    //     if ($id == null) {
    //         $title = "Add Car";
    //         $car = new Car;
    //         $message = "Car added Successfully!";
    //     } else {
    //         $title = "Edit Car";
    //         $car = Car::find($id);
    //         // dd($car);
    //         $message = "Car updated Successfully!";
    //     }
    //     if ($request->isMethod('post')) {
    //         $rules = [
    //             'make' => 'required',
    //             'model' => 'required',
    //             'price' => 'required|numeric',
    //             'vin' => 'required',
    //             'car_image' => 'mimes:jpg,jpeg,png,gif,heif|max:50000',
    //         ];
    //         $customMessages = [
    //             'make.required' => 'Car make is required!',
    //             'model.required' => 'Car model is required!',
    //             'price.required' => 'Price is required!',
    //             'price.numeric' => 'Price should be numeric!',
    //             'vin.required' => 'Car VIN is required!',
    //             'car_image.mimes' => 'The file must be a file of type: jpg,jpeg,png,gif or heif',
    //             'car_image.max' => 'The image size should not be more than 5 MB',
    //         ];
    //         $this->validate($request, $rules, $customMessages);
    //         // $car = Car::find($id);
    //         // dd($request);
    //         $car->make = $request->make;
    //         $car->model = $request->model;
    //         $car->price = $request->price;
    //         $car->vin = $request->vin;

    //         if ($request->hasFile('car_image')) {
    //             $image_tmp = $request->file('car_image');
    //             if ($image_tmp->isValid()) {
    //                 $extension = $image_tmp->getClientOriginalExtension();
    //                 $imgName = rand(111, 99999) . '.' . $extension;
    //                 $imagePath = 'Images/' . $imgName;
    //                 Image::make($image_tmp)->resize(358, 146)->save($imagePath);
    //                 $car->car_image = $imagePath;
    //             }
    //         }
    //         $car->save();

    //         return redirect()->route('admin_dashboard')->with('msg', $message);
    //     }

    //     return view('car.add_edit_car')->with(compact('title', 'car'));
    // }

    // public function deleteCar($id)
    // {
    //     $car = Car::find($id);
    //     $car->delete();
    //     return redirect()->route('admin_dashboard');
    // }
}
