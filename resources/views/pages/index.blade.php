@extends('layouts.public')

@section('content')
<div class="index">
    <div class="block bg-white about mt-4">
        <h4>About iShoba Hair</h4>
        <div class="d-flex align-items-center">

            <div class="flex-grow-1 text-center">
                <p>iShoba Hair is a range of locally (South African) made natural hair care products. The brand came
                    into existence in 2021 as an extension of Stressless Health and Beauty products.
                </p>
                <p>
                    Its organic ingredients make
                    it a safe and trusted brand by many South African women who are already raving about the brand and
                    its products, as Cece Madwe would say <span class="text-italic">Ever since I started using iShoba my
                        hairline is growing back. and I am blown away with the results of the products</span>.
                </p>
                <p>
                    Currently iShoba Hair offers four products: <a href="#">Shea Butter hair food</a>, <a
                        href="#">Hairline Care Treatment</a>, <a href="#">Scalp
                        and Hair Oil</a>, and <a href="#">Moisturising Hair Spray</a>, with more developments underway.
                </p>
            </div>
            <div class="flex-shrink-0">
                <img src="/images/homepageimage.png" class="img-fluid" alt="about image" />
            </div>
        </div>
    </div>

    <div class="block my-4 bg-white images">
        <h4>Our Products</h4>

        <div class="d-flex">
            @for($i=0; $i<4; $i++) <div class="border-0 col-md-3">
                <div class="imageText">
                    <img src=""/>
                    <a href="#" class="text-center">Read more</a>
                </div>
            </div>@endfor
        </div>
    </div>

    <div class="block my-4 bg-white images">
        <h4>Text Section</h4>

        <div class="d-flex">
            @for($i=0; $i<4; $i++) <div class="card border-0 col-md-3">
                <div class="card-body">
                    {{-- <h5 class="card-title">Card title</h5> --}}
                    <p class="card-text text-center">Some quick example text to build on the card title and make up the bulk of
                        the card's content.</p>
                </div>
                <div class="card-footer d-flex justify-content-center rounded-0">
                    <div class="btn-group">
                        <button class="rounded-0 btn btn-primary">Read More</button>
                        <button class="rounded-0 btn btn-success">Add to Cart</button>
                    </div>
                </div>
            </div>@endfor
        </div>
    </div>

   <div class="block my-4 bg-white faq">
        <h4 class="text-uppercase">Frequently Asked Questions</h4>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        Where can I get the iShoba Hair Products
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        iShoba Hair Products can be purchased here on our website and delivered to your door anywhere in South Africa. Or you can find our products at Stressless Health and Beauty Shop which is located at Sangro House (Shop 2) on 417 Anton Lembede Street, Durban (CBD)
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Are iShoba Hair products safe to use?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        The safety of our customers always comes first in all that we do. All our iShoba Hair products are made from natural ingredients that have been tried and tested, and this guarantees the safety of our products.
                        {{-- //REVIEW: no quality control board or number? --}}
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        How can I be a distributor of iShoba products
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        You can become our partner as a distributor of our iShoba products and start making your own money, at your own pace and time. If you are interested, you can send an e-mail to info@stresslessgroup.co.za or call 079 553 0080.
                        {{-- //REVIEW: encrypt email and phone --}}
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        When can I expect to get my delivery after confirmation of my order
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        You can track your order here. But depending on your location, you should receive your order within 5 to 14 business days after confirmation of the order. Should you not receive your order within 14 days, please contact us and we will help you.
                        {{-- //REVIEW:Tracking here? --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection