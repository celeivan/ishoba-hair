<?php

namespace App\Http\Controllers;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = [
            [
                'id' => "shea-butter",
                'name' => "shea butter",
                'description' => "iShoba Shea Butter is a high-quality hair food product that offers a range of delightful benefits. It is made from coconut oil, and by using it your hair will be strong, glowing, and soft. It protects hair and scalp against ultraviolet sun rays which have the potential to dehydrate and damage hair.",
                'price' => "120",
                "imageUrl" => "/images/sheabutterhairfood.png",
            ],
            [
                'id' => "hairline-care",
                'name' => "hairline care",
                'description' => "iShoba hairline care treatment is one of our popular products. It is made from argan oil and hemp seed oil to provide hair with the necessary minerals for hydration and elasticity. It is popular mostly for its apparent effect on the hairline, i.e. fast growth and glow of hairline. The contrast effect of iShoba hairline care (between the skin and hair) enhances the glow and outlook of a woman.",
                'price' => "130",
                "imageUrl" => "/images/hairlineoil.png",
            ],
            [
                'id' => "moisturising-hair-spray",
                'name' => "moisturising hair spray",
                'description' => "Our hair moisturiser performs well on natural hair; it contains the much-needed nutrients for hair care. iShoba hair moisturiser restores the softness and glow of hair. It works fast and efficiently. It is a perfect treatment for itchy scalp and braids. You will never go wrong with our iShoba hair moisturiser.",
                'price' => "110",
                "imageUrl" => "/images/moisturisinghairspray.png",
            ],
            [
                'id' => "scalp-and-hair-oil",
                'name' => "scalp and hair oil",
                'description' => "iShoba scalp and hair oil is a blend of natural ingredients that care for the scalp and various types, textures, and hairstyles. The almond used to make our oil is rich in vitamin B7 which helps keep the hair healthy and strong. Its SPF 5 natural components help protect hair against sun rays which can leave hair dry and damaged.",
                'price' => "120",
                "imageUrl" => "/images/scaloil.png",
            ],
        ];

        return $products;
    }

    public function index()
    {
        return view('pages.index', ['products' => $this->getProducts()]);
    }

    public function shop()
    {
        return view('pages.shop', ['products' => $this->getProducts()]);
    }

    // public function showProduct()
}
