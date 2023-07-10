<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="mb-4 col-lg-2 col-12">
                @if (!empty($setting))
                    <img src="{{ url('storage' . $setting->path_image_logo ?? '') }}" class="logo img-fluid"
                        alt="">
                @else
                    <img src="{{ url(env('NO_IMAGE_SQUARE')) }}" class="logo img-fluid">
                @endif
            </div>

            <div class="col-lg-2 col-md-6 col-12">
                <h5 class="mb-3 site-footer-title">Link</h5>
                <p class="mb-2 text-white d-flex">
                    <a href="{{ route('frontend.about') }}" class="site-footer-link">
                        Tentang Kami
                    </a>
                </p>
                <p class="mb-2 text-white d-flex">
                    <a href="{{ route('frontend.donation') }}" class="site-footer-link">
                        Donasi Program
                    </a>
                </p>
            </div>

            <div class="mb-4 col-lg-4 col-md-6 col-12">
                <h5 class="mb-3 site-footer-title">Berlangganan Berita</h5>
                <div class="alert alert-msg alert-dismissible fade show" role="alert" style="display:none">
                    <strong>Pesan : </strong><span class="msg"></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="custom-form" action="{{ route('frontend.subscribe') }}" id="newsletter-form">
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control" name="email_subscribe" id="email_subscribe"
                            placeholder="Masukkan Email">
                        <button class="btn btn-block custom-btn">Subscribe</button>
                    </div>
                </form>
            </div>

            <div class="mx-auto col-lg-3 col-md-6 col-12">
                <h5 class="mb-3 site-footer-title">Informasi Kontak</h5>
                <p class="mb-2 text-white d-flex">
                    <i class="bi-telephone me-2"></i>
                    <a href="https://wa.me/{{ $setting->phone ?? '' }}" target="_blank" class="site-footer-link">
                        {{ $setting->phone ?? '' }}
                    </a>
                </p>
                <p class="text-white d-flex">
                    <i class="bi-envelope me-2"></i>
                    <a href="mailto:{{ $setting->email ?? '' }}" target="_blank" class="site-footer-link">
                        {{ $setting->email ?? '' }}
                    </a>
                </p>
                <p class="mt-3 text-white d-flex">
                    <i class="bi-geo-alt me-2"></i>
                    {{ $setting->address ?? '' }}
                </p>
                {{-- <a href="#" class="mt-3 custom-btn btn">Get Direction</a> --}}
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1178.7024226534572!2d107.00685445229256!3d-6.436853308607611!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e699749293b165d%3A0x81c8ebb4b3dd5ff0!2sRumah%20Kuswandi%20-%20Deka!5e0!3m2!1sid!2sid!4v1686709861655!5m2!1sid!2sid"
                    width="400" height="225" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="mb-5"></iframe>
            </div>
        </div>
    </div>
</footer>

@push('scripts')
    <script>
        $('#newsletter-form').submit(function(e) {
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
                        $(".alert-msg").css('display', 'block')
                        $(".alert-msg").removeClass('alert-success')
                        $(".alert-msg").addClass('alert-danger')
                        $(".msg").html(response.message.email_subscribe[0])
                    } else {
                        $(".alert-msg").css('display', 'block')
                        $(".alert-msg").removeClass('alert-danger')
                        $(".alert-msg").addClass('alert-success')
                        $(".msg").html(response.message)
                    }
                },
                error: function(response) {
                    $(".alert-msg").css('display', 'block')
                    $(".alert-msg").addClass('alert-danger')
                    $(".msg").html(response.message)
                }
            });
        });
    </script>
@endpush
