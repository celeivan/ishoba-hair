@extends('layouts.public')

@section('content')
<div class="index">
    <div class="block bg-white about mt-4">        
        <div class="row">
            <div class="col-md-8 info text-center">
                <h4 class="fw-bold">About iShoba Hair</h4>
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
            <div class="col">
                <img src="/images/homepageimage.png" class="img-fluid" alt="about image" />
            </div>
        </div>
    </div>

<div class="block my-4 bg-white images">
    <h4 class="fw-bold">Our Products</h4>

    @include('pages._products')
</div>

<div class="block my-4 bg-white faq">
    <h4 class="fw-bold">Frequently Asked Questions</h4>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <span>Q: </span> <span>Where can I get the iShoba Hair Products</span>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <span>A: </span>
                    <span>iShoba Hair Products can be purchased here on our website and delivered to your door anywhere
                        in South Africa. Or you can find our products at Stressless Health and Beauty Shop which is
                        located at Sangro House (Shop 2) on 417 Anton Lembede Street, Durban (CBD)</span>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <span>Q: </span> <span>Are iShoba Hair products safe to use?</span>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <span>A: </span>
                    <span>The safety of our customers always comes first in all that we do. All our iShoba Hair products
                        are made from natural ingredients that have been tried and tested, and this guarantees the
                        safety of our products.</span>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <span>Q: </span> <span>How can I be a distributor of iShoba products</span>
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <span>A: </span>
                    <span>You can become our partner as a distributor of our iShoba products and start making your own
                        money, at your own pace and time. If you are interested, please <a href="{{ route('public.contact')}}">contact us</a>. </span>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <span>Q: </span> <span>When can I expect to get my delivery after confirmation of my order</span>
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <span>A: </span>
                    <span> You can track your order here. But depending on your location, you should receive your order
                        within 5 to 14 business days after confirmation of the order. Should you not receive your order
                        within 14 days, please contact us and we will help you.</span>
                    {{-- //REVIEW:Tracking here? --}}
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection