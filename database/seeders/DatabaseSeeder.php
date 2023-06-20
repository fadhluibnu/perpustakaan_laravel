<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Books;
use App\Models\Category;
use Illuminate\Database\Seeder;

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

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'admin',
            'image' => 'image_post/profdef1.jpg',
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Visitor 1',
        //     'username' => 'visitor',
        //     'email' => 'vis@gmail.com',
        //     'password' => bcrypt('123'),
        //     'role' => 'visitor',
        //     'image' => 'image_post/profdef2.jpg',
        // ]);
        Category::factory()->create([
            'name' => 'Biografi',
            'slug' => 'biografi',
            'image' => 'image_post/thub2.jpeg',
        ]);
        Category::factory()->create([
            'name' => 'Kartun',
            'slug' => 'kartun',
            'image' => 'image_post/thub1.jpg',
        ]);
        Books::factory()->create([
            'title' => 'Biografi Gus Dur',
            'slug' => 'biografi-gus-dur',
            'kode_buku' => "830304824",
            'category_id' => '1',
            'user_id' => '1',
            'penulis' => 'Greg Barton',
            'description' => 'Setelah buku biografinya dalam Bahasa Inggris yang diluncurkan pada Februari 2002, awal Juli 2003 yang lalu Gus Dur meluncurkan buku biografinya dalam edisi alih Bahasa Indonesia. Buku tersebut ditulis oleh Dr. Greg Barton seorang senior lecturer di Deakin University Australia yang sangat aktif melakukan studi tentang Islam di Indonesia sejak awal 90-an.

            Perkenalan Barton dengan Gus Dur terjadi kira-kira di akhir dekade 80-an, dan sejak tahun 1990 Barton paling tidak telah menghasilkan beberapa buku yang berbobot tentang dunia Islam di Indonesia, yakni Nahdlatul Ulama, Traditional Islam and Modernity tahun (bersama dengan Greg Fealy, 1996), Gagasan Islam Liberal: Telaah terhadap Tulisan-tulisan Nurcholish Madjid, Djohan Effendi, Ahmad Wahib dan Abdurrahman Wahid, 1968-1980, Difference and Tolerance: Human Rights Issues in Southeast Asia (1994), dan Abdurrahman Wahid: Muslim Democrat, Indonesian President (2002). Selain itu ia juga sangat produktif dalam menulisan makalah atau paper yang terkait dengan studi Islam di Indonesia yang telah ia publikasikan di forum-forum internasional.
            
            Dalam penyusunan Buku GUS DUR: The Authorized Biography of Abdurrahman Wahid, Barton sempat menjadi tamu dan menyertai acara-acara penting selama lebih kurang tujuh bulan dari dua puluh dua bulan pemerintahan Gus Dur. Selama melakukan riset panjangnya, acapkali Barton terlibat secara intensif dalam banyak kegiatan Gus Dur, yang terkadang melibatkan perasaan dan emosinya sebagai sahabat, namun justru ini yang menjadi daya pikat buku ini sekaligus membedakannya dengan penulis-penulis biografi manapun.
            
            Sebagai salah satu sahabat dari Gus Dur dan seorang ilmuwan, Barton berhasil memberikan pandangan ilmiahnya sehingga mampu memberikan cakrawala dan perskpektif yang mendalam secara lebih sederhana, layaknya seorang sahabat untuk memerikan sosok Gus Dur yang sangat multidimensional, baik dari sisi humanis, pluralis, demokrat tulen, budayawan, agamawan, dan sebagai seorang intelektual terkemuka.
            
            Dalam menyusun buku biografi ini Barton membaginya dalam beberapa yang bagian yang di susun secara kronologi historisi dari sebagian perjalanan hidup Gus Dur yang ia batasi hingga akhir tahun 2001, yakni saat masa lengser dari kursi kepresidenan RI.',
            'image' => 'image_post/gusdur.jpg',
            'penerbit' => 'Originally published',
            'stok' => '1',
            'thn_terbit' => '2002/02/01',
        ]);
        Books::factory()->create([
            'title' => 'Naruto Shippuden Vol. 58',
            'slug' => 'naruto-shippuden-vol-58',
            'kode_buku' => "08937224",
            'category_id' => '2',
            'user_id' => '1',
            'penulis' => 'Masashi Kishimoto',
            'description' => 'Kabuto’s hold over his army of undead minions tightens as he senses that he’s losing power over the stronger members of his Immortal Corps, including Nagato Pain. Sasuke’s brother, Itachi, may have the best chance of breaking Kabuto’s hold. But he’s still not completely in control of his actions, which means Naruto may have to take him down once and for all.',
            'image' => 'image_post/naruto-58.jpg',
            'penerbit' => 'Pierrot Studio',
            'stok' => '2',
            'thn_terbit' => '2012/11/09',
        ]);
    }
}
