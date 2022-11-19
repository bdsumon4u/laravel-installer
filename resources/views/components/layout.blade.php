<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon-16x16.png') }}" sizes="16x16"/>
        <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon-32x32.png') }}" sizes="32x32"/>
        <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon-96x96.png') }}" sizes="96x96"/>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="hidden min-h-screen p-16 md:grid place-content-center">
            <div class="w-[30rem]">
            
                <div class="relative flex justify-center overflow-hidden rounded-lg">
                    <div class="w-full p-4 text-sm font-semibold text-center text-gray-200 uppercase bg-indigo-700">
                      {{ $title }}
                    </div>
                  </div>
          
                <!--Code Block for progress bar Starts-->
                <div class="h-16 my-5">
                    <div class="flex items-center justify-between h-1 bg-gray-200">
                        @php($routes = config('installer.routes', []))
                        @php($i = array_search(request()->segment(2), array_keys($routes)))
                        @foreach ($routes as $name)
                            @if ($loop->index < $i)
                                <div class="flex items-center w-1/3 h-1 bg-indigo-700">
                                    <div class="flex items-center justify-center w-6 h-6 bg-indigo-700 rounded-full shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <path d="M5 12l5 5l10 -10" />
                                        </svg>
                                    </div>
                                </div>
                            @elseif ($loop->index == $i)
                                <div class="relative flex items-center justify-center w-6 h-6 -mr-3 bg-white rounded-full shadow">
                                    <div class="w-3 h-3 bg-indigo-700 rounded-full"></div>
                                </div>
                            @else
                                <div class="flex justify-end w-1/3">
                                    <div class="w-6 h-6 bg-white rounded-full shadow"></div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!--Code Block for progress bar Starts-->
        
                <div class="relative w-full mx-auto">
                    <div class="p-4 bg-white rounded-lg shadow">
                        @unless ($installable ?? true)
                            <div class="px-2 py-2 mb-2 text-center bg-red-800 rounded-sm text-gray-50">{{ __('Please fix the error(s) below and refresh the page.') }}</div>
                        @endif
                        {{ $slot }}
                
                        @if(($installable ?? true) && (isset($actions) || isset($next)))
                        <div class="flex justify-center mt-8">
                            @isset($actions)
                                {{ $actions }}
                            @endisset
                            @isset($next)
                            <a href="{{ $next }}" class="w-full px-8 py-3 font-medium tracking-widest text-center text-gray-200 uppercase bg-black rounded-md shadow-lg hover:text-white hover:bg-gray-800 focus:outline-none hover:shadow-none">
                                {{ __('Next') }}
                            </a>
                          @endisset
                          </div>
                        @endif
                      </div>
                </div>
            </div>
        </div>
    </body>
</html>
