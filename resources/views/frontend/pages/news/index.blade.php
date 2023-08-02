@extends('frontend.layouts.app')

@section('title', 'Berita')

@section('content')
    <section class="section-padding section-bg">
        <div class="container">
            <div class="row">
                @foreach ($news as $item)
                    <div class="col-lg-6 col-12">
                        <div class="news-block">
                            <div class="news-block-top">
                                <a href="{{ route('frontend.news.show', $item->id) }}">
                                    @if ($news->count() == 0)
                                        <img src="{{ url(env('NO_IMAGE_SQUARE')) }}" class="news-image img-fluid">
                                    @else
                                        @if (!empty($item->path_image))
                                            <img src="{{ url(env('PATH_IMAGE_STORAGE') . $item->path_image ?? '') }}"
                                                class="news-image img-fluid">
                                        @else
                                            <img src="{{ url(env('NO_IMAGE_SQUARE')) }}" class="news-image img-fluid">
                                        @endif
                                    @endif
                                </a>
                            </div>

                            <div class="news-block-info">
                                <div class="mt-2 d-flex">
                                    <div class="news-block-date">
                                        <p>
                                            <i class="bi-calendar4 custom-icon me-1"></i>
                                            {{ $item->created_at }}
                                        </p>
                                    </div>

                                    <div class="mx-5 news-block-author">
                                        <p>
                                            <i class="bi-person custom-icon me-1"></i>
                                            By {{ $item->user->name ?? '' }}
                                        </p>
                                    </div>

                                    <div class="news-block-comment">
                                        <p>
                                            <i class="bi-chat-left custom-icon me-1"></i>
                                            {{ $item->comments->count() ?? '0' }} Comments
                                        </p>
                                    </div>
                                </div>

                                <div class="mb-2 news-block-title">
                                    <h4>
                                        <a href="{{ route('frontend.news.show', $item->id) }}"
                                            class="news-block-title-link">
                                            {{ Str::limit($item->title ?? '', 35, ' ...') }}
                                        </a>
                                    </h4>
                                </div>

                                <div class="news-block-body">
                                    <p>
                                        {!! Str::limit($item->body ?? '', 150, ' ...') !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
