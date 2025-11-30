<?php

namespace App\Repositories;

use App\Interfaces\ProductCategoryRepositoryInterface;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCategoryRepository implements ProductCategoryRepositoryInterface
{
    public function getAll(?string $search, ?bool $isParent, ?int $limit, bool $execute)
    {
        $query = ProductCategory::where(function ($query) use ($search, $isParent) {
            if ($search) {
                $query->search($search);
            }

            if ($isParent === true) {
                $query->whereNull('parent_id');
            }

        });

        if ($limit) {
            $query->take($limit);
        }

        if ($execute) {
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginated(?string $search, ?bool $isParent, ?int $rowPerPage)
    {
        $query = $this->getAll($search, $isParent, null, false);

        return $query->paginate($rowPerPage);
    }

    public function getById(string $id)
    {
        $query = ProductCategory::where('id', $id)->with('childerns');

        return $query->first();
    }

    public function getBySlug(string $slug)
    {
        $query = ProductCategory::where('slug', $slug)->with('childerns');

        return $query->first();
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $productCategory = new ProductCategory;
            if (isset($data['parent_id'])) {
                $productCategory->parent_id = $data['parent_id'];
            }

            if (isset($data['image'])) {
                $productCategory->image = $data['image']->store('assets/product-category', 'public');
            }

            if (isset($data['tagline'])) {
                $productCategory->tagline = $data['tagline'];
            }

            $productCategory->name = $data['name'];
            $productCategory->slug = Str::slug($data['name']);
            $productCategory->description = $data['description'];
            $productCategory->save();

            DB::commit();

            return $productCategory;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    public function update(string $id, array $data)
    {
        DB::beginTransaction();
        try {
            $productCategory = ProductCategory::find($id);

            if (isset($data['parent_id'])) {
                $productCategory->parent_id = $data['parent_id'];
            }

            if (isset($data['image'])) {
                $productCategory->image = $data['image']->store('assets/product-category', 'public');
            }

            if (isset($data['tagline'])) {
                $productCategory->tagline = $data['tagline'];
            }

            $productCategory->name = $data['name'];

            if (isset($data['slug'])) {
                $productCategory->slug = Str::slug($data['name']);
            }
            $productCategory->description = $data['description'];
            $productCategory->save();

            DB::commit();

            return $productCategory;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    public function delete(string $id)
    {
        DB::beginTransaction();
        try {
            $productCategory = ProductCategory::find($id);
            if (! $productCategory) {
                throw new Exception('Kategori produk not found');
            }
            $productCategory->delete();
            DB::commit();

            return $productCategory;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }
}
