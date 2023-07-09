<section class="section-padding section-bg">
    <div class="container">
        <div class="row">
            <div class="mb-4 text-center col-lg-12 col-12">
                <h2>Program-Program Kami</h2>
            </div>
            @foreach ($campaigns as $item)
                <div class="mb-4 col-lg-4 col-md-6 col-12 mb-lg-0">
                    <div class="custom-block-wrap">
                        <div style="height: 250px;">
                            @if (!empty($item->path_image))
                                <img src="{{ url('storage' . $item->path_image ?? '') }}"
                                    class="custom-block-image img-fluid" alt="">
                            @else
                                <img src="{{ url(env('NO_IMAGE_SQUARE')) }}" class="custom-block-image img-fluid"
                                    alt="">
                            @endif
                        </div>
                        <div class="custom-block">
                            <div class="custom-block-body">
                                <h5 class="mb-3">
                                    <a href="{{ url('/donation/' . $item->id) }}">
                                        {{ $item->title }}
                                    </a>
                                </h5>
                                <p class="text-justify">{{ Str::limit($item->short_description, 100, ' ...') }}</p>
                                <div class="mt-4 progress">
                                    <div class="progress-bar w-75" role="progressbar" aria-valuenow="75"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="my-2 d-flex align-items-center">
                                    <p class="mb-0">
                                        Terkumpul :
                                        <strong>Rp. {{ amount_format_id($item->amount) }}</strong>
                                    </p>
                                    <p class="mb-0 ms-auto">
                                        Goal :
                                        <strong>Rp. {{ amount_format_id($item->goal) }}</strong>
                                    </p>
                                </div>
                            </div>
                            <a href="donate.html" class="custom-btn btn">Donate now</a>
                        </div>
                    </div>
                </div>
                {{-- <div class="mb-4 col-lg-6 col-md-6 col-12 mb-lg-0">
                    <div class="custom-block-wrap">
                        @if (!empty($item->path_image))
                            <img src="{{ url('storage' . $item->path_image ?? '') }}" class="custom-block-image img-fluid"
                                alt="">
                        @else
                            <img src="{{ url(env('NO_IMAGE_SQUARE')) }}" class="custom-block-image img-fluid"
                                alt="">
                        @endif
                        <div class="custom-block">
                            <div class="custom-block-body">
                                <h5 class="mb-3">
                                    <a href="{{ route('frontend.donation.detail') }}">
                                        {{ $item->title }}
                                    </a>
                                </h5>
                                <p>{{ $item->short_description }}</p>
                                <div class="mt-4 progress">
                                    <div class="progress-bar w-75" role="progressbar" aria-valuenow="75"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="my-2 d-flex align-items-center">
                                    <p class="mb-0">
                                        <strong>Raised:</strong>
                                        $18,500
                                    </p>
                                    <p class="mb-0 ms-auto">
                                        <strong>Goal:</strong>
                                        $32,000
                                    </p>
                                </div>
                            </div>
                            <button type="button" class="btn btn-block custom-btn">Donasi Sekarang</button>
                        </div>
                    </div>
                </div> --}}
            @endforeach

            {{-- <div class="mb-4 col-lg-4 col-md-6 col-12 mb-lg-0">
                <div class="custom-block-wrap">
                    <img src="{{ asset('template/frontend/images/causes/poor-child-landfill-looks-forward-with-hope.jpg') }}"
                        class="custom-block-image img-fluid" alt="">
                    <div class="custom-block">
                        <div class="custom-block-body">
                            <h5 class="mb-3">Poverty Development</h5>
                            <p>Sed leo nisl, posuere at molestie ac, suscipit auctor mauris. Etiam quis metus
                                tempor</p>
                            <div class="mt-4 progress">
                                <div class="progress-bar w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                            <div class="my-2 d-flex align-items-center">
                                <p class="mb-0">
                                    <strong>Raised:</strong>
                                    $27,600
                                </p>
                                <p class="mb-0 ms-auto">
                                    <strong>Goal:</strong>
                                    $60,000
                                </p>
                            </div>
                        </div>
                        <button type="button" class="btn btn-block custom-btn">Donasi Sekarang</button>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="col-lg-4 col-md-6 col-12">
                <div class="custom-block-wrap">
                    <img src="{{ asset('template/frontend/images/causes/african-woman-pouring-water-recipient-outdoors.jpg') }}"
                        class="custom-block-image img-fluid" alt="">
                    <div class="custom-block">
                        <div class="custom-block-body">
                            <h5 class="mb-3">Supply drinking water</h5>
                            <p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus
                            </p>
                            <div class="mt-4 progress">
                                <div class="progress-bar w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                            <div class="my-2 d-flex align-items-center">
                                <p class="mb-0">
                                    <strong>Raised:</strong>
                                    $84,600
                                </p>
                                <p class="mb-0 ms-auto">
                                    <strong>Goal:</strong>
                                    $100,000
                                </p>
                            </div>
                        </div>
                        <button type="button" class="btn btn-block custom-btn">Donasi Sekarang</button>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>
