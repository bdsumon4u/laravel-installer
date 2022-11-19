<x-installer::layout :title="__('Check Requirements')" :installable="$installable" :next="route('installer.permissions')">
    <ul>
        @foreach($requirements as $extention => $enabled)
            <li @class(['flex justify-between my-1 px-2 py-2 rounded-sm', $enabled ? 'bg-green-200' : 'bg-red-200'])>
                <span class="text-gray-900">{{ $extention }}</span>
                <span @class(['bg-gray-50', $enabled ? 'text-green-800' : 'text-red-800'])>
                    @if($enabled)
                    <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"/></svg>
                    @else
                    <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/></svg>
                    @endif
                </span>
            </li>
        @endforeach
    </ul>
</x-installer::layout>