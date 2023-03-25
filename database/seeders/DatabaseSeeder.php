<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // for ($i = 1; $i <= 20; $i++) {
        //     DB::table('banner')->insert([
        //         'name_banner' => 'Banner ' . $i,
        //         'banner_content' => 'Noi dung banner ' . $i,
        //         'number_sort'  => 1,
        //         'thumb' => '/storage/banner/2023/03/09/NhuMe.jpg',
        //         'is_active' => 1,
        //     ]);
        // }
        // for ($i = 1; $i <= 20; $i++) {
        //     DB::table('category')->insert([
        //         'name_category' => 'Tieu de moi ' . $i,
        //         'parent_id' => 0,
        //         'thumb' => Str::random(10),
        //         'is_active' => 1,
        //     ]);
        // };
        for ($i = 1; $i <= 20; $i++) {
            DB::table('product')->insert([
                'name_product' => Str::random(10) . $i,
                'description' => '<p><img src="https://cf.shopee.vn/file/sg-11134202-23020-0dw0u5cphdnv7a" /></p>

                <p>&Aacute;o thun Continuous - CTNS - TRAVIS SCOTT 100% cotton 2 chiều</p>

                <p>Local Brand Việt Nam - CONTINUOUS - CTNS</p>

                <p>▪ M&agrave;u sắc : Black</p>

                <p>▪ Size &aacute;o: S-M-L-XL</p>

                <p>▪ Vải thun cotton 2 chiều 100% d&agrave;y dặn, co gi&atilde;n tốt, độ bền m&agrave;u cao.</p>

                <p>▪ In mặt trước v&agrave; sau: Kỹ thuật in trame cao cấp, h&igrave;nh in tự nhi&ecirc;n v&agrave; th&ocirc;ng tho&aacute;ng bề mặt &aacute;o</p>

                <p>👉 C&aacute;ch chọn size: Continuous c&oacute; bảng size mẫu. Nếu chưa biết lựa size bạn c&oacute; thể inbox để được Continuous tư vấn</p>

                <p>&nbsp;</p>

                <p>Hướng dẫn sử dụng sản phẩm &Aacute;o</p>

                <p>▪ Giặt ở nhiệt độ b&igrave;nh thường, với đồ c&oacute; m&agrave;u tương tự.</p>

                <p>▪ Kh&ocirc;ng d&ugrave;ng h&oacute;a chất tẩy.</p>

                <p>▪ Kh&ocirc;ng sử dụng m&aacute;y sấy quần &aacute;o</p>

                <p>▪ Phơi mặt tr&aacute;i &aacute;o</p>

                <p>&nbsp;</p>

                <p>🟥 CH&Iacute;NH S&Aacute;CH - QUYỀN LỢI CỦA KH&Aacute;CH :</p>

                <p>&ndash; Miễn ph&iacute; đổi h&agrave;ng cho kh&aacute;ch trong trường hợp bị lỗi từ nh&agrave; sản xuất, giao nhầm h&agrave;ng, bị hư hỏng trong qu&aacute; tr&igrave;nh vận chuyển h&agrave;ng.</p>

                <p>&ndash; Sản phẩm đổi trong thời gian 3 ng&agrave;y kể từ ng&agrave;y nhận h&agrave;ng</p>

                <p>&ndash; Sản phẩm c&ograve;n mới nguy&ecirc;n tem, tags, sản phẩm chưa giặt v&agrave; kh&ocirc;ng dơ bẩn, hư hỏng bởi những t&aacute;c nh&acirc;n b&ecirc;n ngo&agrave;i cửa h&agrave;ng sau khi mua h&agrave;ng.</p>',
                'short_description' => 'Đây là sản phẩm độc quyền của Fashion Shop',
                'info' => '<ul>
                <li>
                <h5>PH&Iacute; VẬN CHUYỂN CHỈ 20.000 VND VỚI TP.HCM V&Agrave; 30.000 VND VỚI C&Aacute;C TỈNH TH&Agrave;NH KH&Aacute;C</h5>
                </li>
                <li>TỔNG Đ&Agrave;I CSKH&nbsp;0828.624.326
                <p>(Từ&nbsp;8h30 - 21:30 mỗi ng&agrave;y)</p>
                </li>
            </ul>',
                'old_price' => 500000,
                'new_price' => rand(1000, 500000),
                'size' => implode(", ", ['S', 'M', 'L', 'XL', 'XXL']),
                'thumb' => '/storage/product/Demo/2023/03/17/thumb1.jpg',
                'image1' => '/storage/product/Demo/image/2023/03/17/thumb2.jpg',
                'image2' => '/storage/product/Demo/image/2023/03/17/thumb3.jpg',
                'image3' => '/storage/product/Demo/image/2023/03/17/thumb4.jpg',
                'is_active' => 1,
                'category_id' => random_int(3, 6),
            ]);
        };
    }
}
