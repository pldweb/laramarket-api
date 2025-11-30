<?php

namespace App\Repositories;

use App\Interfaces\BuyerRepositoryInterface;
use App\Interfaces\ProductImageRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Buyer;
use App\Models\Product;
use App\Models\ProductImage;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function PHPUnit\Framework\throwException;

class ProductImageRepository implements ProductImageRepositoryInterface
{
    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $productImage = new ProductImage;
            $productImage->product_id = $data['product_id'];
            $productImage->image = $data['image']->store('assets/products', 'public');
            $productImage->is_thumbnail = $data['is_thumbnail'];
            $productImage->save();

            DB::commit();
            return $productImage;
        }catch (Exception $exception){
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }

    }

    public function delete(string $id)
    {
        DB::beginTransaction();
        try {
            $productImage = ProductImage::find($id);
            Storage::disk('public')->delete($productImage->image);
            $productImage->delete();
            DB::commit();
            return $productImage;
        }catch (Exception $exception){
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }
}
