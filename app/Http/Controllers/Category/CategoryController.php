<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return $this->showAll($categories, 200); // using trait
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationRules = [
            'name' => 'required',
            'description' => 'required',
        ];

        // validate request with validationRules
        $this->validate($request, $validationRules);

        $data = $request->all();

        $data['name'] = $request->name;
        $data['description'] = $request->description;

        $category = Category::create($data);
        //return response()->json(['data' => $category], 201);
        return $this->showOne($category, 201); // using trait
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $this->showOne($category, 200); // using trait
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validationRules = [
            'name' => 'required',
            'description' => 'required',
        ];

        $this->validate($request, $validationRules);

        if ($request->has('name')) {
            $category->name = $request->name;
        }

        if ($request->has('description')) {
            $category->description = $request->description;
        }

        if ($category->isClean()) {
            //return response()->json(['error' => 'No changes passed for the user - specify values you would like to update', 'code' => 422], 422);
            return $this->errorResponse('No changes passed for the category - specify values you would like to update', 422);
        }

        // if is changed so you need to save changes
        $category->save();

        //return response()->json(['data' => $category], 200);
        return $this->showOne($category, 200); // using trait

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        $category->delete();

        //return response()->json(['data' => $user], 200);
        return $this->showOne($category, 200); // using trait
    }
}
