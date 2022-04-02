<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductFilterRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Неудаленные
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Product::query()->orderByDesc('id')->get());
    }

    public function filter(ProductFilterRequest $request, ProductService $service): JsonResponse
    {
        return response()->json($service->filter($request->validated()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductCreateRequest $request
     * @return JsonResponse
     */
    public function store(ProductCreateRequest $request)
    {
        /** @var Product $product */
        $data = $request->validated();
        $product = Product::query()->create($data);
        $product->categories()->attach($data['categories']);
        return response()->json($product->load('categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductUpdateRequest $request
     * @param Product $product
     * @return Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        $product->update($data);
        $product->categories()->sync($data['categories']);
    }

    public function destroy(Product $product)
    {
        if ($product->trashed()) {
            abort(Response::HTTP_NOT_FOUND);
        }
        $product->deleteOrFail();
    }
}
