<!DOCTYPE html>
@if (!is_null(request()->lang))
    <html lang="{{ request()->lang }}">
@else
    <html lang="{{ config('constants.native_languge') }}">
@endif

<head>
    {{-- HEAD --}}
    @include('layout.frontend.head')
    {{-- HEAD END --}}
    @if (auth()->check())
        <style>
            .admin-navbar {
                overflow: hidden;
                background-color: #333;
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 999999;
            }

            .admin-navbar a {
                float: left;
                display: block;
                color: #f2f2f2;
                text-align: center;
                padding: 5px 10px;
                text-decoration: none;
            }
        </style>
    @endif
    @if (config('constants.nofollow_noindex') == 'yes')
        <style>
            .noindex-warning {
                background-color: #d12a2acf;
                font-size: 1rem;
                text-align: center;
                color: white
            }
        </style>
    @endif
</head>

<body>
    @if (Auth::check() && in_array(Auth::user()->admin_level, [1, 2]))
        @if (isset($tool) || isset($blog))
            <div class="admin-navbar">
                @if (isset($tool))
                    <a href="{{ route('tool.edit', ['tool' => $tool]) }}" target="_blank">Edit Tool</a>
                @endif
                @if (isset($blog))
                    <a href="{{ URL('admin/blog/' . $blog['id'] . '/edit') }}" target="_blank">Edit Blog</a>
                @endif
            </div>
        @endif
    @endif
    @if (config('constants.nofollow_noindex') == 'yes')
        <div class="noindex-warning">Website is no-follow no-index</div>
    @endif
    {{-- HEADER --}}
    @include('layout.frontend.header')
    {{-- HEADER END --}}
    {{-- CONTENT --}}
    @yield('content')
    {{-- CONTENT END --}}
    {{-- FOOTER --}}
    @include('layout.frontend.footer')
    {{-- FOOTER END --}}
</body>

</html>
