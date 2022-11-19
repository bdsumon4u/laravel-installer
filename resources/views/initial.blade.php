<x-installer::layout :title="__('Let\'s Install :app', ['app' => config('app.name')])" :next="route('installer.requirements')">
    <div class="italic font-semibold leading">
        <p>Welcome Dear.</p>
        <p>Thanks for using {{ config('app.name') }}.</p>
        <p>Have a nice experience.</p>
    </div>
</x-installer::layout>