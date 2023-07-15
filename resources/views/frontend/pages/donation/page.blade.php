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
                                <img src="{{ url(env('PATH_IMAGE_STORAGE') . $item->path_image ?? '') }}"
                                    class="custom-block-image img-fluid" alt=""
                                    style="width: 100%; max-height: 100%">
                            @else
                                <img src="{{ url(env('NO_IMAGE_SQUARE')) }}" class="custom-block-image img-fluid"
                                    alt="" style="width: 100%; max-height: 100%">
                            @endif
                        </div>
                        <div class="custom-block">
                            <div class="custom-block-body">
                                <h5 class="mb-3">
                                    <a href="{{ url('/donation/' . $item->id) }}">
                                        {{ Str::limit($item->title, 47, ' ...') }}
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
                            <a href="{{ route('frontend.donation.create', $item->id) }}" class="custom-btn btn">Donasi
                                Sekarang</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <x-pagination-table :model="$campaigns" />
    </div>
</section>
