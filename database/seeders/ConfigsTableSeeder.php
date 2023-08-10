<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Config;
class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Config::insert([
            ['key'=>'phan_trang_khoa_hoc','value'=>'6'],
            ['key'=>'phan_trang_bai_viet','value'=>'6'],
            ['key'=>'phan_trang_danh_gia','value'=>'6'],
            ['key'=>'phan_trang_chuyen_gia','value'=>'6'],
            ['key'=>'phan_trang_tin_thuc_tap','value'=>'6'],
            ['key'=>'link_nghe_le_tan','value'=>'https://daotaonghedulich.com/nganh-nghe/le-tan-khach-san'],
            ['key'=>'link_nghe_nha_hang','value'=>'https://daotaonghedulich.com/nganh-nghe/nha-hang'],
            ['key'=>'link_nghe_buong','value'=>'https://daotaonghedulich.com/nganh-nghe/buong-phong-khach-san'],
            ['key'=>'link_mien_phi','value'=>'https://daotaonghedulich.com/khoa-hoc'],
        ]);
    }
}
