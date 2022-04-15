<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class BootApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ishoba:boot-app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run this command to upload products info and create admin user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->createProducts();
        $this->createAdmin();
    }

    private function createProducts()
    {
        $products = [
            [
                'name' => "shea butter",
                'description' => "iShoba Shea Butter is a high-quality hair food product that offers a range of delightful benefits. It is made from coconut oil, and by using it your hair will be strong, glowing, and soft. It protects hair and scalp against ultraviolet sun rays which have the potential to dehydrate and damage hair.",
                'price' => "120",
                "imageUrl" => "/images/sheabutterhairfood.png",
            ],
            [
                'name' => "hairline care",
                'description' => "iShoba hairline care treatment is one of our popular products. It is made from argan oil and hemp seed oil to provide hair with the necessary minerals for hydration and elasticity. It is popular mostly for its apparent effect on the hairline, i.e. fast growth and glow of hairline. The contrast effect of iShoba hairline care (between the skin and hair) enhances the glow and outlook of a woman.",
                'price' => "130",
                "imageUrl" => "/images/hairlineoil.png",
            ],
            [
                'name' => "moisturising hair spray",
                'description' => "Our hair moisturiser performs well on natural hair; it contains the much-needed nutrients for hair care. iShoba hair moisturiser restores the softness and glow of hair. It works fast and efficiently. It is a perfect treatment for itchy scalp and braids. You will never go wrong with our iShoba hair moisturiser.",
                'price' => "110",
                "imageUrl" => "/images/moisturisinghairspray.png",
            ],
            [
                'name' => "scalp and hair oil",
                'description' => "iShoba scalp and hair oil is a blend of natural ingredients that care for the scalp and various types, textures, and hairstyles. The almond used to make our oil is rich in vitamin B7 which helps keep the hair healthy and strong. Its SPF 5 natural components help protect hair against sun rays which can leave hair dry and damaged.",
                'price' => "120",
                "imageUrl" => "/images/scaloil.png",
            ],
            [
                'name' => "combo",
                'description' => "Buy this combo at a discounted rate, 1x Shea Butter, 1x Hairline Care, 1x Moisturising Hair Spray, 1x Scalp And Hair Oil.",
                'price' => "450",
                "imageUrl" => "/images/combo.png",
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->info("Products successfully created");
    }

    private function createAdmin()
    {
        //check if user doesn't exist if they do quit
        $admin = User::where('role', 'admin')->first();
        if($admin){
            $this->info("Admin already created");
        }else{
            User::create([
                'name' => 'IShoba Hair Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('P@ssw0rd'),
                'role' => 'admin',
            ]);

            $this->info("Admin user created");
        }
    }
}
