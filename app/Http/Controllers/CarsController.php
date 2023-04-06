<?php

namespace App\Http\Controllers;

use App\Models\Car;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests\CreateValidationRequest;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //we want to do something like SELECT * FROM cars
        $cars = Car::all();
        //dd($cars);

        //incase you want to get specific value
        //$cars = Car::where('name','=', 'Audi')->get();

        //print_r((Car::sum('founded')));

        return view('cars.index',[
            'cars'=>$cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */


   // public function store(Request $request)
    public function store(CreateValidationRequest $request)
    {
        
        //dd('ok');

        // creating an instance of a class
        // $car = new Car;
        // $car->name= $request->input('name');
        // $car->founded = $request->input('founded');
        // $car->description = $request->input('description');
        // $car->save();

        //passing an array to a model

        // $car = Car::make([
        //     'name'=>$request->input('name'),
        //     'founded'=>$request->input('founded'),
        //     'description'=>$request->input('description')
        // ]);
        // $car->save();
        


         //validating incoming data
        //  $request->validate([
        //     'name' => 'required|unique:cars',
        //     'founded' => 'required|integer|min:0|max:2021',
        //     'description' => 'required'
        //        'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        // ]);


        //Methods we can use on $request
        // guessExtension()
        // getMimeType()
        // store()
        // asStore()
        // storePublicly()
        // move()
        // getClientOriginalName()
        // getClientMimeType()
        // guessClientExtension()
        // getSize()

        // $test = $request->file('image')->getSize();
        // dd($test);
        
        //tore an image now in public,....can also be storedd in store folder
        $newImageName = time(). '-' .$request->name . '.' 
        .$request->image->extension();
        //dd($newImageName);
        $test = $request->image->move(public_path('images'), $newImageName);
        //dd( $test);


        $request->validated([]);

        //dd($request->all());

        //when valid, it proceeds
        $car = Car::create([
            'name'=>$request->input('name'),
            'founded'=>$request->input('founded'),
            'description'=>$request->input('description'),
            'image_path' =>  $newImageName 
        ]);

       


        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        
         $cars = Car::find($id);
         //dd($cars);
         //dd($cars->engines);
         //var_dump($cars->productionDate);

         //var_dump($cars->products); returns a collection

         //$products = Product::find($id);
         //print_r($products);

        return view('cars.view')->with('cars', $cars);
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $car = Car::find($id)->first();
        //dd($car);
        return view('cars.edit')->with('car', $car);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validation
        $request->validated();


        //
        $car = Car::where('id', $id)->update([
            'name'=>$request->input('name'),
            'founded'=>$request->input('founded'),
            'description'=>$request->input('description')
        ]);


        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        //dd($id);

        $car = Car::find($id);
        $car->delete();

        return redirect('/cars');
    }
    
}
