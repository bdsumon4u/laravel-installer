<x-installer::layout :title="__('Environment Settings')">
    <form method="POST" id="env-form">
        @csrf

        @if ($errors->count())
            <ul class="bg-gray-200 mb-4 p-4 font-semibold text-red-500">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="grid grid-cols-2 gap-3">
            <div class="col-span-1">
                <label for="DB_HOST" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">{{ __('DB_HOST') }}</label>
                <input id="DB_HOST" type="text" name="DB_HOST" value="127.0.0.1" class="block w-full px-3 py-2 mt-1 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner rounded-md" required="">
            </div>
            <div class="col-span-1">
                <label for="DB_PORT" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">{{ __('DB_PORT') }}</label>
                <input id="DB_PORT" type="text" name="DB_PORT" value="3306" class="block w-full px-3 py-2 mt-1 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner rounded-md" required="">
            </div>
            <div class="col-span-2">
                <label for="DB_DATABASE" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">{{ __('DB_DATABASE') }}</label>
                <input id="DB_DATABASE" type="text" name="DB_DATABASE" class="block w-full px-3 py-2 mt-1 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner rounded-md" required="">
            </div>
            <div class="col-span-1">
                <label for="DB_USERNAME" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">{{ __('DB_USERNAME') }}</label>
                <input id="DB_USERNAME" type="text" name="DB_USERNAME" class="block w-full px-3 py-2 mt-1 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner rounded-md" required="">
            </div>
            <div class="col-span-1">
                <label for="DB_PASSWORD" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">{{ __('DB_PASSWORD') }}</label>
                <input id="DB_PASSWORD" type="text" name="DB_PASSWORD" class="block w-full px-3 py-2 mt-1 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner rounded-md" required="">
            </div>
        </div>


        <div class="flex justify-center mt-8">
            <button type="submit" class="w-full text-center py-3 px-8 rounded-md font-medium tracking-widest text-gray-200 hover:text-white uppercase bg-black hover:bg-gray-800 shadow-lg focus:outline-none hover:shadow-none">
              {{ __('Next') }}
              </button>
          </div>
    </form>
</x-installer::layout>