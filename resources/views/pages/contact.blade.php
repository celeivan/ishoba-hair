@extends('layouts.public')

@section('content')
<div class="contact">
    <h1>Contact Us</h1>

    <hr/>
    <div class="w-100 d-flex justify-content-between contactCards">
        <div class="call">
            <h6><i class="fas fa-phone"></i> Call</h6>
            <a
                href="tel:&#48;&#55;&#57;&#32;&#53;&#53;&#51;&#32;&#48;&#48;&#56;&#48;">&#48;&#55;&#57;&#32;&#53;&#53;&#51;&#32;&#48;&#48;&#56;&#48;</a>
        </div>
        <div class="whatsapp">
            <h6><i class="fab fa-whatsapp"></i> WhatsApp </h6>
            <a
                href="tel:&#48;&#55;&#57;&#32;&#53;&#53;&#51;&#32;&#48;&#48;&#56;&#48;">&#48;&#55;&#57;&#32;&#53;&#53;&#51;&#32;&#48;&#48;&#56;&#48;</a>
        </div>
        <div class="email">
            <h6><i class="fas fa-at"></i> Email </h6>
            <a
                href="mailto:&#105;&#110;&#102;&#111;&#64;&#115;&#116;&#114;&#101;&#115;&#115;&#108;&#101;&#115;&#115;&#103;&#114;&#111;&#117;&#112;&#46;&#99;&#111;&#46;&#122;&#97;">&#105;&#110;&#102;&#111;&#64;&#115;&#116;&#114;&#101;&#115;&#115;&#108;&#101;&#115;&#115;&#103;&#114;&#111;&#117;&#112;&#46;&#99;&#111;&#46;&#122;&#97;</a>
        </div>
        <div class="facebook">
            <h6><i class="fab fa-facebook"></i> Facebook</h6>
            <a href="https://www.facebook.com/ishobahair" target="_blank">IShoba Hair</a>
        </div>
        <div class="instagram">
            <h6><i class="fab fa-instagram"></i> Instagram </h6>
            <a href="https://www.instagram.com/ishobahair" target="_blank">IShoba Hair</a>
        </div>
    </div>
    {{-- Add Distributors details (would also highly assist) --}}

    <hr/>
    <p class="text-center mb-4"><i class="fas fa-map-marker-alt fa-lg"></i> We are located at <strong>Shop 2 Sangro House, 417 Anton Lembede Street (Smith Street), Durban 4000</strong></p>

    <div class="row">
        <div class="col-md-6">
            <form action="" class="contact-form row g-3">
                <div class="col-md-6 form-floating">
                    <input name="firstName" required type="text" class="form-control" placeholder="">
                    <label for="firstName" class="form-label">First Name/s</label>
                </div>
                <div class="col-md-6 form-floating">
                    <input name="lastName" required type="text" class="form-control" placeholder="">
                    <label for="lastName" class="form-label">Last Name</label>
                </div>
                <div class="col-md-6 form-floating">
                    <input name="email" required type="email" class="form-control" placeholder="">
                    <label for="email" class="form-label">Email Address</label>
                </div>
                <div class="col-md-6 form-floating">
                    <input name="contactNo" required type="text" class="form-control" placeholder="">
                    <label for="contactNo" class="form-label">Contact No</label>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Message</label>
                </div>
                <div class="col-12 actions">
                    <button type="submit" class="btn btn-warning submit">Send</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            {{-- Embed Map --}}
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3460.137044161461!2d31.017473215660704!3d-29.860321329698547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1ef7a9c77be0dc31%3A0x5f9a48484113f6e7!2sSangro%20House%2C%20417%20Smith%20St%2C%20Durban%20Central%2C%20Durban%2C%204001!5e0!3m2!1sen!2sza!4v1644957994683!5m2!1sen!2sza"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>
@endsection