<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(Request $request)
    {
        try {
            $product = $this->productRepository->getAll(
                $request->search,
                $request->is_parent,
                $request->limit,
                true,
                $request->boolean('random')
            );

            return ResponseHelper::jsonResponse(true, 'Data produk berhasil ditemukan', ProductResource::collection($product), 200);
        } catch (\Exception $exception) {
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }

    public function getAllPaginated(Request $request)
    {
        $request = $request->validate([
            'search' => 'string|nullable',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'row_per_page' => 'integer|nullable',
        ]);

        try {
            $product = $this->productRepository->getAllPaginated($request['search'] ?? null, $request['parent_id'] ?? null, $request['row_per_page']);

            return ResponseHelper::jsonResponse(true, 'Data produk berhasil ditemukan', PaginateResource::make($product, ProductResource::class), 200);
        } catch (\Exception $exception) {
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }

    public function store(ProductStoreRequest $request)
    {
        $request = $request->validated();

        try {
            $product = $this->productRepository->create($request);

            return ResponseHelper::jsonResponse(true, 'Data produk berhasil ditambahkan', new ProductResource($product), 201);

        } catch (\Exception $exception) {
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }

    public function show(string $id)
    {
        try {
            $product = $this->productRepository->getById($id);

            if (! $product) {
                return ResponseHelper::jsonResponse(false, 'Data produk gagal ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Data produk berhasil ditemukan', new ProductResource($product), 200);

        } catch (\Exception $exception) {
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }

    public function showBySlug(string $slug)
    {
        try {
            $product = $this->productRepository->getBySlug($slug);

            if (! $product) {
                return ResponseHelper::jsonResponse(false, 'Data produk gagal ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Data produk berhasil ditemukan', new ProductResource($product), 200);

        } catch (\Exception $exception) {
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }

    public function update(ProductUpdateRequest $request, string $id)
    {
        $data = $request->validated();
        try {
            $product = $this->productRepository->getById($id);

            if (! $product) {
                return ResponseHelper::jsonResponse(false, 'Data produk gagal ditemukan', null, 404);
            }

            $product = $this->productRepository->update($id, $data);

            return ResponseHelper::jsonResponse(true, 'Data produk berhasil diupdate', new ProductResource($product), 200);

        } catch (\Exception $exception) {
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = $this->productRepository->getById($id);
            if (! $product) {
                return ResponseHelper::jsonResponse(false, 'Data produk gagal ditemukan', null, 404);
            }

            $product = $this->productRepository->delete($id);

            return ResponseHelper::jsonResponse(true, 'Data produk berhasil dihapus', new ProductResource($product), 201);

        } catch (\Exception $exception) {
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }
}
