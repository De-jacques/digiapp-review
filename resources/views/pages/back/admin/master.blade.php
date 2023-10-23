<style>
    .cke_editable {
        font-size: 13px;
        line-height: 0.2px !important;

        /* Fix for missing scrollbars with RTL texts. (#10488) */
        word-wrap: break-word;
    }
</style>
@include('layouts/back/admin/navbar')
@yield('style')
@include('layouts/back/admin/sidebar')
@include('layouts/back/admin/header')
{{-- <h2>IDIEIDIENKEJ/</h2> --}}
@yield('admin-content')
@include('layouts/back/admin/footer')
@yield('script')