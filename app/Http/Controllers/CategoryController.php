<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate(['name' => 'required|unique:categories']);
        $category = Category::query()->create($request->only(['name']));
        return response()->json($category);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', Rule::unique('categories')->ignore($category->id)]
        ]);
        $category->update($request->only('name'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @throws \Throwable
     */
    public function destroy(Category $category)
    {
        $category->load('products');
        if ($category->products->count() > 0) {
            abort(
                Response::HTTP_UNPROCESSABLE_ENTITY,
                "Products {$category->products->pluck('id')} are attached to this category"
            );
        }
        $category->deleteOrFail();
    }
}
