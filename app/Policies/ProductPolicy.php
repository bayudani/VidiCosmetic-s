<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductPolicy
{
    /**
     * Siapa yang boleh LIHAT daftar produk?
     */
    public function viewAny(User $user): bool
    {
        // User boleh lihat JIKA dia punya izin 'product: view'
        return $user->can('product: view');
    }

    /**
     * Siapa yang boleh BUAT produk baru?
     */
    public function create(User $user): bool
    {
        // User boleh buat JIKA dia punya izin 'product: create'
        return $user->can('product: create');
    }

    /**
     * Siapa yang boleh EDIT produk?
     */
    public function update(User $user, Product $product): bool
    {
        // User boleh update JIKA dia punya izin 'product: update'
        return $user->can('product: update');
    }

    /**
     * Siapa yang boleh HAPUS produk?
     */
    public function delete(User $user, Product $product): bool
    {
        // User boleh hapus JIKA dia punya izin 'product: delete'
        return $user->can('product: delete');
    }
}