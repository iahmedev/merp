<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Employment Types') }}
    </h2>
</x-slot>

<div class="py-4">
    <div class="flex justify-center">
        <div class="w-full md:w-1/2 p-8 m-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <section>
                {{ $this->table }}
            </section>
        </div>
    </div>
</div>
