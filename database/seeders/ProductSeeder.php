<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Lấy các category đã tạo
        $category1 = Category::where('slug', 'ao')->first();
        $category2 = Category::where('slug', 'quan')->first();
        $category3 = Category::where('slug', 'ao-khoac')->first();
        $category4 = Category::where('slug', 'giay')->first();

        // Tạo 10 sản phẩm với 2 biến thể mỗi sản phẩm

        // Sản phẩm 1: Áo sơ mi nam
        $product1 = Product::create([
            'category_id' => $category1->id,
            'name' => 'Áo sơ mi nam',
            'description' => 'Áo sơ mi nam chất liệu cotton cao cấp, thoáng mát và dễ chịu.',
            'base_price' => 200000,
            'image' => 'products/1_ao_so_mi_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product1->id,
            'name' => 'M size',
            'color' => 'Trắng',
            'size' => 'M',
            'price' => 200000,
            'stock' => 100,
        ]);
        ProductVariant::create([
            'product_id' => $product1->id,
            'name' => 'L size',
            'color' => 'Xanh dương',
            'size' => 'L',
            'price' => 220000,
            'stock' => 50,
        ]);

        // Sản phẩm 2: Quần Jeans nam
        $product2 = Product::create([
            'category_id' => $category2->id,
            'name' => 'Quần jeans nam',
            'description' => 'Quần jeans nam thời trang, phù hợp với mọi dịp.',
            'base_price' => 350000,
            'image' => 'products/2_quan_jeans_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product2->id,
            'name' => 'S size',
            'color' => 'Đen',
            'size' => 'S',
            'price' => 350000,
            'stock' => 60,
        ]);
        ProductVariant::create([
            'product_id' => $product2->id,
            'name' => 'M size',
            'color' => 'Xanh đen',
            'size' => 'M',
            'price' => 380000,
            'stock' => 40,
        ]);

        // Sản phẩm 3: Áo khoác nam
        $product3 = Product::create([
            'category_id' => $category3->id,
            'name' => 'Áo khoác nam',
            'description' => 'Áo khoác nam chống gió, giữ ấm vào mùa đông.',
            'base_price' => 500000,
            'image' => 'products/3_ao_khoac_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product3->id,
            'name' => 'M size',
            'color' => 'Đen',
            'size' => 'M',
            'price' => 500000,
            'stock' => 30,
        ]);
        ProductVariant::create([
            'product_id' => $product3->id,
            'name' => 'L size',
            'color' => 'Nâu',
            'size' => 'L',
            'price' => 530000,
            'stock' => 20,
        ]);

        // Sản phẩm 4: Giày thể thao nam
        $product4 = Product::create([
            'category_id' => $category4->id,
            'name' => 'Giày thể thao nam',
            'description' => 'Giày thể thao với thiết kế trẻ trung, phù hợp cho mọi hoạt động.',
            'base_price' => 600000,
            'image' => 'products/4_giay_the_thao_nam.webp',
        ]);
        ProductVariant::create([
            'product_id' => $product4->id,
            'name' => '43 size',
            'color' => 'Trắng',
            'size' => '43',
            'price' => 600000,
            'stock' => 25,
        ]);
        ProductVariant::create([
            'product_id' => $product4->id,
            'name' => '44 size',
            'color' => 'Đen',
            'size' => '44',
            'price' => 630000,
            'stock' => 15,
        ]);
        // Sản phẩm 5: Áo thun nam
        $product5 = Product::create([
            'category_id' => $category1->id,
            'name' => 'Áo thun nam',
            'description' => 'Áo thun nam chất liệu cotton, mềm mại và thoải mái.',
            'base_price' => 150000,
            'image' => 'products/5_ao_thun_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product5->id,
            'name' => 'M size',
            'color' => 'Trắng',
            'size' => 'M',
            'price' => 150000,
            'stock' => 80,
        ]);
        ProductVariant::create([
            'product_id' => $product5->id,
            'name' => 'L size',
            'color' => 'Xám',
            'size' => 'L',
            'price' => 160000,
            'stock' => 60,
        ]);

        // Sản phẩm 6: Quần short nam
        $product6 = Product::create([
            'category_id' => $category2->id,
            'name' => 'Quần short nam',
            'description' => 'Quần short nam phong cách trẻ trung, thoáng mát.',
            'base_price' => 180000,
            'image' => 'products/6_quan_short_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product6->id,
            'name' => 'M size',
            'color' => 'Đen',
            'size' => 'M',
            'price' => 180000,
            'stock' => 90,
        ]);
        ProductVariant::create([
            'product_id' => $product6->id,
            'name' => 'L size',
            'color' => 'Nâu',
            'size' => 'L',
            'price' => 190000,
            'stock' => 70,
        ]);

        // Sản phẩm 7: Áo hoodie nam
        $product7 = Product::create([
            'category_id' => $category3->id,
            'name' => 'Áo hoodie nam',
            'description' => 'Áo hoodie nam giữ ấm, phù hợp cho mùa đông.',
            'base_price' => 400000,
            'image' => 'products/7_ao_hoodie_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product7->id,
            'name' => 'M size',
            'color' => 'Đen',
            'size' => 'M',
            'price' => 400000,
            'stock' => 50,
        ]);
        ProductVariant::create([
            'product_id' => $product7->id,
            'name' => 'L size',
            'color' => 'Xám',
            'size' => 'L',
            'price' => 420000,
            'stock' => 40,
        ]);

        // Sản phẩm 8: Giày thể thao nữ
        $product8 = Product::create([
            'category_id' => $category4->id,
            'name' => 'Giày thể thao nữ',
            'description' => 'Giày thể thao nữ thiết kế trẻ trung, thời trang và thoải mái.',
            'base_price' => 700000,
            'image' => 'products/8_giay_the_thao_nu.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product8->id,
            'name' => '38 size',
            'color' => 'Hồng',
            'size' => '38',
            'price' => 700000,
            'stock' => 30,
        ]);
        ProductVariant::create([
            'product_id' => $product8->id,
            'name' => '39 size',
            'color' => 'Trắng',
            'size' => '39',
            'price' => 720000,
            'stock' => 25,
        ]);

        // Sản phẩm 9: Áo vest nam
        $product9 = Product::create([
            'category_id' => $category1->id,
            'name' => 'Áo vest nam',
            'description' => 'Áo vest nam lịch lãm, phù hợp với các dịp quan trọng.',
            'base_price' => 800000,
            'image' => 'products/9_ao_vest_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product9->id,
            'name' => 'M size',
            'color' => 'Đen',
            'size' => 'M',
            'price' => 800000,
            'stock' => 20,
        ]);
        ProductVariant::create([
            'product_id' => $product9->id,
            'name' => 'L size',
            'color' => 'Xám',
            'size' => 'L',
            'price' => 850000,
            'stock' => 15,
        ]);

        // Sản phẩm 10: Quần tây nam
        $product10 = Product::create([
            'category_id' => $category2->id,
            'name' => 'Quần tây nam',
            'description' => 'Quần tây nam lịch sự, phù hợp với công sở.',
            'base_price' => 400000,
            'image' => 'products/10_quan_tay_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product10->id,
            'name' => 'S size',
            'color' => 'Đen',
            'size' => 'S',
            'price' => 400000,
            'stock' => 50,
        ]);
        ProductVariant::create([
            'product_id' => $product10->id,
            'name' => 'M size',
            'color' => 'Nâu',
            'size' => 'M',
            'price' => 420000,
            'stock' => 40,
        ]);
        // Sản phẩm 11: Áo sơ mi nữ
        $product11 = Product::create([
            'category_id' => $category1->id,
            'name' => 'Áo sơ mi nữ',
            'description' => 'Áo sơ mi nữ, thiết kế tinh tế, phù hợp cho công sở.',
            'base_price' => 250000,
            'image' => 'products/11_ao_so_mi_nu.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product11->id,
            'name' => 'S size',
            'color' => 'Trắng',
            'size' => 'S',
            'price' => 250000,
            'stock' => 100,
        ]);
        ProductVariant::create([
            'product_id' => $product11->id,
            'name' => 'M size',
            'color' => 'Xanh',
            'size' => 'M',
            'price' => 270000,
            'stock' => 80,
        ]);

        // Sản phẩm 12: Quần kaki nam
        $product12 = Product::create([
            'category_id' => $category2->id,
            'name' => 'Quần kaki nam',
            'description' => 'Quần kaki nam, phù hợp cho cả ngày đi làm và đi chơi.',
            'base_price' => 300000,
            'image' => 'products/12_quan_kaki_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product12->id,
            'name' => 'M size',
            'color' => 'Be',
            'size' => 'M',
            'price' => 300000,
            'stock' => 120,
        ]);
        ProductVariant::create([
            'product_id' => $product12->id,
            'name' => 'L size',
            'color' => 'Nâu',
            'size' => 'L',
            'price' => 320000,
            'stock' => 110,
        ]);

        // Sản phẩm 13: Áo len nữ
        $product13 = Product::create([
            'category_id' => $category3->id,
            'name' => 'Áo len nữ',
            'description' => 'Áo len nữ mềm mại, phù hợp cho mùa đông.',
            'base_price' => 350000,
            'image' => 'products/13_ao_len_nu.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product13->id,
            'name' => 'M size',
            'color' => 'Đỏ',
            'size' => 'M',
            'price' => 350000,
            'stock' => 70,
        ]);
        ProductVariant::create([
            'product_id' => $product13->id,
            'name' => 'L size',
            'color' => 'Đen',
            'size' => 'L',
            'price' => 370000,
            'stock' => 50,
        ]);

        // Sản phẩm 14: Giày cao gót nữ
        $product14 = Product::create([
            'category_id' => $category4->id,
            'name' => 'Giày cao gót nữ',
            'description' => 'Giày cao gót nữ, thiết kế sang trọng, thời trang.',
            'base_price' => 600000,
            'image' => 'products/14_giay_cao_got_nu.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product14->id,
            'name' => '37 size',
            'color' => 'Đen',
            'size' => '37',
            'price' => 600000,
            'stock' => 40,
        ]);
        ProductVariant::create([
            'product_id' => $product14->id,
            'name' => '38 size',
            'color' => 'Đỏ',
            'size' => '38',
            'price' => 620000,
            'stock' => 35,
        ]);

        // Sản phẩm 15: Áo khoác nữ
        $product15 = Product::create([
            'category_id' => $category3->id,
            'name' => 'Áo khoác nữ',
            'description' => 'Áo khoác nữ phong cách, ấm áp cho mùa đông.',
            'base_price' => 500000,
            'image' => 'products/15_ao_khoac_nu.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product15->id,
            'name' => 'M size',
            'color' => 'Đen',
            'size' => 'M',
            'price' => 500000,
            'stock' => 60,
        ]);
        ProductVariant::create([
            'product_id' => $product15->id,
            'name' => 'L size',
            'color' => 'Xám',
            'size' => 'L',
            'price' => 520000,
            'stock' => 50,
        ]);
        // Sản phẩm 16: Áo thun nam
        $product16 = Product::create([
            'category_id' => $category1->id,
            'name' => 'Áo thun nam',
            'description' => 'Áo thun nam thoải mái, phù hợp cho các buổi dã ngoại và đi chơi.',
            'base_price' => 180000,
            'image' => 'products/16_ao_thun_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product16->id,
            'name' => 'M size',
            'color' => 'Trắng',
            'size' => 'M',
            'price' => 180000,
            'stock' => 150,
        ]);
        ProductVariant::create([
            'product_id' => $product16->id,
            'name' => 'L size',
            'color' => 'Đen',
            'size' => 'L',
            'price' => 190000,
            'stock' => 140,
        ]);

        // Sản phẩm 17: Quần short nam
        $product17 = Product::create([
            'category_id' => $category2->id,
            'name' => 'Quần short nam',
            'description' => 'Quần short nam thoải mái cho mùa hè.',
            'base_price' => 220000,
            'image' => 'products/17_quan_short_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product17->id,
            'name' => 'L size',
            'color' => 'Xám',
            'size' => 'L',
            'price' => 220000,
            'stock' => 130,
        ]);
        ProductVariant::create([
            'product_id' => $product17->id,
            'name' => 'XL size',
            'color' => 'Xanh',
            'size' => 'XL',
            'price' => 230000,
            'stock' => 120,
        ]);

        // Sản phẩm 18: Áo len nam
        $product18 = Product::create([
            'category_id' => $category3->id,
            'name' => 'Áo len nam',
            'description' => 'Áo len nam ấm áp, phù hợp với mùa đông.',
            'base_price' => 400000,
            'image' => 'products/18_ao_len_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product18->id,
            'name' => 'L size',
            'color' => 'Đen',
            'size' => 'L',
            'price' => 400000,
            'stock' => 90,
        ]);
        ProductVariant::create([
            'product_id' => $product18->id,
            'name' => 'XL size',
            'color' => 'Xám',
            'size' => 'XL',
            'price' => 420000,
            'stock' => 85,
        ]);

        // Sản phẩm 19: Giày thể thao nam
        $product19 = Product::create([
            'category_id' => $category4->id,
            'name' => 'Giày thể thao nam',
            'description' => 'Giày thể thao nam thời trang, phù hợp cho các hoạt động thể thao.',
            'base_price' => 750000,
            'image' => 'products/19_giay_the_thao_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product19->id,
            'name' => '42 size',
            'color' => 'Trắng',
            'size' => '42',
            'price' => 750000,
            'stock' => 50,
        ]);
        ProductVariant::create([
            'product_id' => $product19->id,
            'name' => '43 size',
            'color' => 'Đen',
            'size' => '43',
            'price' => 770000,
            'stock' => 40,
        ]);

        // Sản phẩm 20: Áo khoác nam
        $product20 = Product::create([
            'category_id' => $category3->id,
            'name' => 'Áo khoác nam',
            'description' => 'Áo khoác nam, thiết kế mạnh mẽ và ấm áp.',
            'base_price' => 600000,
            'image' => 'products/20_ao_khoac_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product20->id,
            'name' => 'L size',
            'color' => 'Đen',
            'size' => 'L',
            'price' => 600000,
            'stock' => 60,
        ]);
        ProductVariant::create([
            'product_id' => $product20->id,
            'name' => 'XL size',
            'color' => 'Xám',
            'size' => 'XL',
            'price' => 620000,
            'stock' => 50,
        ]);
        // Sản phẩm 21: Áo sơ mi nam
        $product21 = Product::create([
            'category_id' => $category1->id,
            'name' => 'Áo sơ mi nam',
            'description' => 'Áo sơ mi nam lịch lãm, phù hợp cho các buổi họp hoặc tiệc.',
            'base_price' => 350000,
            'image' => 'products/21_ao_so_mi_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product21->id,
            'name' => 'M size',
            'color' => 'Trắng',
            'size' => 'M',
            'price' => 350000,
            'stock' => 100,
        ]);
        ProductVariant::create([
            'product_id' => $product21->id,
            'name' => 'L size',
            'color' => 'Xanh',
            'size' => 'L',
            'price' => 360000,
            'stock' => 95,
        ]);

        // Sản phẩm 22: Quần jeans nam
        $product22 = Product::create([
            'category_id' => $category2->id,
            'name' => 'Quần jeans nam',
            'description' => 'Quần jeans nam phong cách, thoải mái cho mọi hoạt động.',
            'base_price' => 450000,
            'image' => 'products/22_quan_jeans_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product22->id,
            'name' => 'L size',
            'color' => 'Xanh dương',
            'size' => 'L',
            'price' => 450000,
            'stock' => 80,
        ]);
        ProductVariant::create([
            'product_id' => $product22->id,
            'name' => 'XL size',
            'color' => 'Đen',
            'size' => 'XL',
            'price' => 460000,
            'stock' => 75,
        ]);

        // Sản phẩm 23: Áo vest nam
        $product23 = Product::create([
            'category_id' => $category1->id,
            'name' => 'Áo vest nam',
            'description' => 'Áo vest nam phù hợp với các buổi tiệc tùng, sự kiện.',
            'base_price' => 700000,
            'image' => 'products/23_ao_vest_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product23->id,
            'name' => 'L size',
            'color' => 'Đen',
            'size' => 'L',
            'price' => 700000,
            'stock' => 60,
        ]);
        ProductVariant::create([
            'product_id' => $product23->id,
            'name' => 'XL size',
            'color' => 'Xám',
            'size' => 'XL',
            'price' => 720000,
            'stock' => 55,
        ]);

        // Sản phẩm 24: Giày boot nam
        $product24 = Product::create([
            'category_id' => $category4->id,
            'name' => 'Giày boot nam',
            'description' => 'Giày boot nam mạnh mẽ, phù hợp với những chuyến đi dài.',
            'base_price' => 850000,
            'image' => 'products/24_giay_boot_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product24->id,
            'name' => '42 size',
            'color' => 'Nâu',
            'size' => '42',
            'price' => 850000,
            'stock' => 30,
        ]);
        ProductVariant::create([
            'product_id' => $product24->id,
            'name' => '43 size',
            'color' => 'Đen',
            'size' => '43',
            'price' => 870000,
            'stock' => 28,
        ]);

        // Sản phẩm 25: Áo khoác dạ nam
        $product25 = Product::create([
            'category_id' => $category3->id,
            'name' => 'Áo khoác dạ nam',
            'description' => 'Áo khoác dạ nam, giữ ấm hiệu quả trong mùa đông lạnh giá.',
            'base_price' => 950000,
            'image' => 'products/25_ao_khoac_da_nam.jpg',
        ]);
        ProductVariant::create([
            'product_id' => $product25->id,
            'name' => 'L size',
            'color' => 'Nâu',
            'size' => 'L',
            'price' => 950000,
            'stock' => 40,
        ]);
        ProductVariant::create([
            'product_id' => $product25->id,
            'name' => 'XL size',
            'color' => 'Đen',
            'size' => 'XL',
            'price' => 980000,
            'stock' => 35,
        ]);


        // Tạo các sản phẩm khác tiếp theo (tạo thêm sản phẩm và biến thể tương tự)
        // Lặp lại quy trình trên cho các sản phẩm còn lại...
    }
}
