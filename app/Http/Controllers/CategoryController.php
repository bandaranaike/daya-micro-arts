<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = new Category();

        $category->name = $request->get("name");
        $category->slug = $this->getUniqueKey(Str::slug($request->get("key", $request->get("name"))), 'categories');

        $category->save();

        return new JsonResponse($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $category->name = $request->get("name");
        $category->slug = $this->getUniqueKey($request->get("slug", $request->get("name")), 'categories', id: $category->id);
        $category->save();

        return new JsonResponse($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $deleted = $category->delete();
        return new JsonResponse($deleted);
    }

    /**
     * @param string $requestingKey
     * @param string $table
     * @param string $column
     * @param null $checkingKey
     * @param null $id
     * @return mixed
     */
    public function getUniqueKey(string $requestingKey, string $table, string $column = "slug", $checkingKey = null, $id = null): string
    {
        $checkingKey = $checkingKey ?? $requestingKey;
        $count = 0;
        $isExists = DB::table($table)->when($id, function (Builder $builder, $id) {
            $builder->where('id', '!=', $id);
        })->where($column, $checkingKey)->exists();
        if ($isExists) {
            $count += 1;
            $checkingKey = $requestingKey . '-' . $count;
            return $this->getUniqueKey($requestingKey, $table, $column, $checkingKey);
        } else return $checkingKey;
    }
}
