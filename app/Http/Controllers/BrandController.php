<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Brand;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = DB::table('brands')->orderBy('id')->get();
        return view('adminuser.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {


        /*[
                'name.required'=>'Insert name brand',
                'name.unique'=>'Same name into db',
                'name.max'=>'Max 200 character',
                'address.required' => 'Insert address brand',
                'image.mimes' => 'type of file accept: jpeg - png - jpg and max size 50mb',
            ]*/


            $brand = new Brand;
            $brand->name = $request->name;
            $brand->address = $request->address;
            $brand->description = $request->description;
            $brand->created_at = now();
            $brand->updated_at = now();

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time().'.'.$request->image->extension();
                $file->move(public_path('images_brand'), $imageName);
                $brand->image = $imageName;

            }
            else{
                $brand->image = NULL;
            }

            $brand->save();

            return redirect(route('brand.index'))->with('success',"Marchio ".$request->name." creato con successo");
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $brand = Brand::find($id);

        if ($brand) {
            $brandproduct = $brand->products()->orderBy('name', 'asc')->paginate(7);
            return view('adminuser.brand.show',compact('brand','brandproduct'));
        }
        else{
            return redirect(route('brand.index'))->with('error','Marchio inesistente.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        /*request()->validate(
            [
                'name' => 'required|max:200|unique:brands',
                'address' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg|max:5000000',
            ],
            [
                'name.required'=>'Insert name brand',
                'name.unique'=>'Same name into db',
                'name.max'=>'Max 200 character',
                'address.required' => 'Insert address brand',
                'image.mimes' => 'type of file accept: jpeg - png - jpg and max size 50mb',
            ]
        );*/
        $brand = Brand::find($brand->id);
        $brand->name = $request->name;
        $brand->address = $request->address;
        $brand->description = $request->description;
        $brand->updated_at = now();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time().'.'.$request->image->extension();
            $file->move(public_path('images_brand'), $imageName);
            $brand->image = $imageName;

        }

        $brand->save();
        return redirect(route('brand.show',$brand->id))->with('success',"Marchio aggiornato con successo.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            $productonbrand = $brand->products()->get();
            foreach ($productonbrand as $key => $value) {
                if ($value->id) {
                    return redirect(route('brand.index'))->with('error','Alcuni prodotti sono legati al marchio numero '.$id);
                }
            }
            $brand->delete();
            return redirect(route('brand.index'))->with('success','Marchio eliminato con successo.');
        }else{
            return redirect(route('brand.index'))->with('error','Marchio inesistente');
        }


    }
}
