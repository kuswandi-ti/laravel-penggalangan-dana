@extends('frontend.layouts.app')

@section('content')
    @includeIf('frontend.layouts.partials.about_history')

    @includeIf('frontend.layouts.partials.features')

    @includeIf('frontend.layouts.partials.campaign')

    @includeIf('frontend.layouts.partials.services')

    @includeIf('frontend.layouts.partials.faith')

    @includeIf('frontend.layouts.partials.quotes')

    @includeIf('frontend.layouts.partials.upcoming_events')

    @includeIf('frontend.layouts.partials.footer')
@endsection
