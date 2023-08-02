@extends('frontend.layouts.app')

@section('title')
    {{ $news->title ?? '' }}
@endsection

@section('content')
    <section class="news-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="news-block">
                        <div class="news-block-top">
                            @if (!empty($news->path_image))
                                <img src="{{ url(env('PATH_IMAGE_STORAGE') . $news->path_image ?? '') }}"
                                    class="news-image img-fluid" style="width: 100%;">
                            @else
                                <img src="{{ url(env('NO_IMAGE_SQUARE')) }}" class="news-image img-fluid"
                                    style="width: 100%;">
                            @endif
                        </div>

                        <div class="news-block-info">
                            <div class="d-flex mt-2">
                                <div class="news-block-date">
                                    <p>
                                        <i class="bi-calendar4 custom-icon me-1"></i>
                                        {{ $news->created_at ?? '0' }}
                                    </p>
                                </div>

                                <div class="news-block-author mx-5">
                                    <p>
                                        <i class="bi-person custom-icon me-1"></i>
                                        By {{ $news->user->name ?? '' }}
                                    </p>
                                </div>

                                <div class="news-block-comment">
                                    <p>
                                        <i class="bi-chat-left custom-icon me-1"></i>
                                        {{ $news->comments->count() ?? '0' }} Comments
                                    </p>
                                </div>
                            </div>

                            <div class="text-justify news-block-title mb-2">
                                <h4>{{ $news->title ?? '' }}</h4>
                            </div>

                            <div class="text-justify news-block-body">
                                <p>
                                    {!! $news->body ?? '' !!}
                                </p>
                            </div>

                            <div class="social-share border-top mt-5 py-4 d-flex flex-wrap align-items-center">
                                <div class="d-flex">
                                    <a href="#" class="social-icon-link bi-facebook"></a>

                                    <a href="#" class="social-icon-link bi-twitter"></a>

                                    <a href="#" class="social-icon-link bi-printer"></a>

                                    <a href="#" class="social-icon-link bi-envelope"></a>
                                </div>
                            </div>

                            {{-- <div class="author-comment d-flex mt-3 mb-4">
                                <img src="images/avatar/studio-portrait-emotional-happy-funny.jpg"
                                    class="img-fluid avatar-image" alt="">

                                <div class="author-comment-info ms-3">
                                    <h6 class="mb-1">Jack</h6>

                                    <p class="mb-0">Kind Heart Charity is the most supportive organization. This is
                                        Bootstrap 5 HTML CSS template for everyone. Thank you.</p>

                                    <div class="d-flex mt-2">
                                        <a href="#" class="author-comment-link me-3">Like</a>

                                        <a href="#" class="author-comment-link">Reply</a>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="author-comment d-flex ms-5 ps-3">
                                <img src="images/avatar/pretty-blonde-woman-wearing-white-t-shirt.jpg"
                                    class="img-fluid avatar-image" alt="">

                                <div class="author-comment-info ms-3">
                                    <h6 class="mb-1">Daisy</h6>

                                    <p class="mb-0">Sed leo nisl, posuere at molestie ac, suscipit auctor mauris. Etiam
                                        quis metus elementum, tempor risus vel, condimentum orci</p>

                                    <div class="d-flex mt-2">
                                        <a href="#" class="author-comment-link me-3">Like</a>

                                        <a href="#" class="author-comment-link">Reply</a>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="author-comment d-flex mt-3 mb-4">
                                <img src="images/avatar/portrait-young-redhead-bearded-male.jpg"
                                    class="img-fluid avatar-image" alt="">

                                <div class="author-comment-info ms-3">
                                    <h6 class="mb-1">Wilson</h6>

                                    <p class="mb-0">Lorem Ipsum dolor sit amet, consectetur adipsicing kengan omeg kohm
                                        tokito Professional charity theme based on Bootstrap</p>

                                    <div class="d-flex mt-2">
                                        <a href="#" class="author-comment-link me-3">Like</a>

                                        <a href="#" class="author-comment-link">Reply</a>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <form class="custom-form comment-form mt-4" action="#" method="post" role="form">
                                <h6 class="mb-3">Write a comment</h6>

                                <textarea name="comment-message" rows="4" class="form-control" id="comment-message"
                                    placeholder="Your comment here"></textarea>

                                <div class="col-lg-3 col-md-4 col-6 ms-auto">
                                    <button type="submit" class="form-control">Comment</button>
                                </div>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
