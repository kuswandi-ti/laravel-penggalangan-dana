<table {{ $attributes->merge(['class' => 'table table-striped table-hover text-nowrap']) }}>
    @isset($thead)
        <thead {{ $attributes->merge(['class' => 'bg-dark']) }}>
            {{ $thead }}
        </thead>
    @endisset

    <tbody>
        {{ $slot }}
    </tbody>

    @isset($tfoot)
        <tfoot>
            {{ $tfoot }}
        </tfoot>
    @endisset
</table>
