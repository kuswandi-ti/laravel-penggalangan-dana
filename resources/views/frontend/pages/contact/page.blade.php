<section class="section-padding section-bg">
    <div class="container">
        <div class="row">
            <div class="mb-5 col-lg-6 col-12">
                <div class="contact-info-wrap">
                    <h2>Informasi Kontak</h2>
                    <div class="contact-info">
                        <p class="mb-2 d-flex">
                            <i class="bi-geo-alt me-2"></i>
                            {{ $setting->address ?? '' }}
                        </p>
                        <p class="mb-2 d-flex">
                            <i class="bi-telephone me-2"></i>

                            <a href="https://wa.me/{{ $setting->phone ?? '' }}">
                                {{ $setting->phone ?? '' }}
                            </a>
                        </p>
                        <p class="d-flex">
                            <i class="bi-envelope me-2"></i>
                            <a href="mailto:{{ $setting->email ?? '' }}">
                                {{ $setting->email ?? '' }}
                            </a>
                        </p>
                        <a href="https://www.google.com/maps/place/Rumah+Kuswandi+-+Deka/@-6.436,107.0044753,17z/data=!3m1!4b1!4m6!3m5!1s0x2e699749293b165d:0x81c8ebb4b3dd5ff0!8m2!3d-6.436!4d107.0070502!16s%2Fg%2F11sgwp3lcb?entry=ttu"
                            class="custom-btn btn mt-3" target="_blank">Peta Lokasi</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <form class="custom-form contact-form" action="{{ route('frontend.contact.store') }}" id="contact-form">
                    <h2>Form Kontak</h2>
                    <div class="alert alert-msg-contact alert-dismissible fade show" role="alert"
                        style="display:none">
                        <strong>Pesan : </strong>
                        <ul class="msg-contact"></ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <p class="mb-4">Atau bisa langsung kirim email ke :
                        <a href="mailto:{{ $setting->email ?? '' }}">{{ $setting->email ?? '' }}</a>
                    </p>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*"
                                class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <input type="text" name="phone" id="phone" class="form-control"
                                placeholder="No. HP">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <input type="text" name="subject" id="subject" class="form-control"
                                placeholder="Subject Pesan">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <textarea name="message" id="message" rows="5" class="form-control" placeholder="Isi Pesan"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-block custom-btn">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        $('#contact-form').submit(function(e) {
            e.preventDefault();

            var url = $(this).attr("action");
            let formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response.error == true) {
                        $('#contact-form').find(".alert-msg-contact").find("ul").html('');
                        $(".alert-msg-contact").css('display', 'block')
                        $(".alert-msg-contact").removeClass('alert-success')
                        $(".alert-msg-contact").addClass('alert-danger')
                        $.each(response.message, function(key, value) {
                            $('#contact-form').find(".alert-msg-contact").find("ul").append(
                                '<li>' +
                                value + '</li>');
                        });
                    } else {
                        $('#contact-form').find(".alert-msg-contact").find("ul").html('');
                        $(".alert-msg-contact").css('display', 'block')
                        $(".alert-msg-contact").removeClass('alert-danger')
                        $(".alert-msg-contact").addClass('alert-success')
                        $('#contact-form').find(".alert-msg-contact").find("ul").append(
                            '<li>' +
                            response.message + '</li>');
                    }
                },
                error: function(response) {
                    $('#contact-form').find(".alert-msg-contact").find("ul").html('');
                    $(".alert-msg-contact").css('display', 'block')
                    $(".alert-msg-contact").removeClass('alert-success')
                    $(".alert-msg-contact").addClass('alert-danger')
                    $.each(response.message, function(key, value) {
                        $('#contact-form').find(".alert-msg-contact").find("ul").append(
                            '<li>' +
                            value + '</li>');
                    });
                }
            });
        });
    </script>
@endpush
