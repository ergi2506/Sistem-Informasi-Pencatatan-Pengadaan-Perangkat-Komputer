<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
    <header class="px-4 py-2 shadow">
        <div class="flex justify-between">
            <div class="flex items-center">
                <a class="navbar-brand" href="{{ route('home') }}"><img
                        src="{{ asset('storage/products/Perumda Paljaya Logo.png') }}" width="290px"></a>
            </div>

            <div class="flex items-center">


                <button data-dropdown
                    class="flex items-center px-3 py-2 focus:outline-none hover:bg-gray-200 hover:rounded-md"
                    type="button" x-data="{ open: false }" @click="open = true"
                    :class="{ 'bg-gray-200 rounded-md': open }">

                    <span class="ml-4 text-sm hidden md:inline-block" style="font-size: larger">{{ Auth::user()->name }}</span>
                    <svg class="fill-current w-3 ml-4" viewBox="0 0 407.437 407.437">
                        <path
                            d="M386.258 91.567l-182.54 181.945L21.179 91.567 0 112.815 203.718 315.87l203.719-203.055z" />
                    </svg>

                    <div data-dropdown-items
                        class="text-sm text-left absolute top-0 right-0 mt-16 mr-4 bg-white rounded border border-gray-400 shadow"
                        x-show="open" @click.away="open = false">
                        <ul>
                            <li class="px-4 py-3 border-b hover:bg-gray-200"><a href="{{ route('profile') }}">My Profile</a></li>
                            <li class="px-4 py-3 hover:bg-gray-200"><a href="{{ route('logout') }}">Log out</a></li>
                        </ul>
                    </div>
                </button>

            </div>
        </div>
    </header>
    <div class="flex flex-row">
        <div
            class="flex flex-col w-64 h-screen overflow-y-auto bg-gray-900 border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700" style="height: 920px">
            <div class="sidebar text-center bg-gray-900">
                <div class="text-gray-100 text-xl">
                    <div class="p-2.5 mt-1 flex items-center">
                        <i class="bi bi-app-indicator px-2 py-1 rounded-md bg-blue-600"></i>
                        <h1 class="font-bold text-gray-200 text-[15px] ml-3">{{ Auth::user()->type }}</h1>
                    </div>
                    <div class="my-2 bg-gray-600 h-[1px]"></div>
                </div>
                <a href="{{ route('home') }}">
                    <div
                        class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-house-door-fill"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Home</span>
                    </div>
                </a>
                <a href="{{ route('product') }}">
                    <div
                        class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-basket-fill"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Product</span>
                    </div>
                </a>
                @if (auth()->user()->type == 'admin')

                <a href="{{ route('admin/users/index') }}">
                    <div
                        class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                          </svg>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Manage User</span>
                    </div>
                </a>
                @endif
                <a href="{{ route('profile') }}">
                    <div
                        class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-person-fill"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Profile</span>
                    </div>
                </a>
                
                <a href="{{ route('logout') }}">
                    <div class="my-4 bg-gray-600 h-[1px]"></div>
                    <div
                        class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Logout</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="flex flex-col w-full h-screen px-4 py-8 mt-10">
            <div>@yield('contents')</div>
        </div>
    </div>


</body>

</html>
