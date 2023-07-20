<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Banner;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

// require_once __DIR__ . '/LocationsSeeder.php';

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LocationsSeeder::class);

        User::create([
            'name'      => 'admin',
            'email'     => 'admin@gmail.com',
            'role'      => 'admin',
            'contact'   => '08123456789',
            'password'  => bcrypt('password'),
        ]);
        Kategori::create([
            'name'      => 'Batik Lengan Panjang',
            'image'     => 'lorem',
            'slug'      => 'batik-lengan-panjang',
        ]);
        Kategori::create([
            'name'      => 'Batik Lengan Pendek',
            'image'     => 'lorem',
            'slug'      => 'batik-lengan-pendek',
        ]);

        Produk::create([
            'name'          => 'Kemeja Batik Pria Slimfit CACING PETENG Bahan Katu',
            'id_kategori'   => 1,
            'slug'          => 'kemeja-batik-pria-slimfit-cacing-peteng-bahan-katun-halus-lapis-furing',
            'image'      => 'tes',
            'ukuran'     => 'S,M,L,XL,XXL',
            'harga'      => 100000,
            'stok'       => 100,
            'berat'      => 250,
            'desc'      => '<p>lorem</p>',
        ]);
        Produk::create([
            'name'          => 'Kemeja Batik Pria Slimfit MAWAR SATU Bahan Katun Halus Lapis Furing',
            'id_kategori'   => 1,
            'slug'          => 'kemeja-batik-pria-slimfit-mawar-satu-bahan-katun-halus-lapis-furing',
            'image'      => 'tes',
            'ukuran'     => 'S,M,L,XL,XXL',
            'harga'      => 150000,
            'stok'       => 100,
            'berat'      => 250,
            'desc'      => '<p>lorem</p>',
        ]);
        Produk::create([
            'name'          => 'Kemeja batik premium dewandara Bahan Katun Halus Lapis Furing',
            'id_kategori'   => 1,
            'slug'          => 'kemeja-batik-premium-dewandara-bahan-katun-halus-lapis-furing',
            'image'      => 'tes',
            'ukuran'     => 'S,M,L,XL',
            'harga'      => 110000,
            'stok'       => 30,
            'berat'      => 250,
            'desc'      => '<p>lorem</p>',
        ]);
        Produk::create([
            'name'          => 'Kopi Hitam Kemeja Batik Lengan Pendek Full Furing',
            'id_kategori'   => 2,
            'slug'          => 'kopi-hitam-kemeja-batik-lengan-pendek-full-furing',
            'image'      => 'tes',
            'ukuran'     => 'S,M,L,XL',
            'harga'      => 80000,
            'stok'       => 20,
            'berat'      => 250,
            'desc'      => '<p>lorem</p>',
        ]);
        Produk::create([
            'name'          => 'PERWIRA Kemeja Batik Pria Lengan Panjang',
            'id_kategori'   => 2,
            'slug'          => 'perwira-kemeja-batik-pria-lengan-panjang',
            'image'      => 'tes',
            'ukuran'     => 'S,M,L,XL',
            'harga'      => 80000,
            'stok'       => 15,
            'berat'      => 250,
            'desc'      => '<p>lorem</p>',
        ]);

        // Banner::create([
        //     'keterangan'    => 'tes',
        //     'image'         => 'image'
        // ]);
    }
}
