<div>
    <div class="p-10">
        <h1 class="px-2 mb-5 text-2xl font-medium text-slate-700 text-center">Registration Form</h1>
        <div class="px-8 mx-auto flex items-center justify-center max-w-xl min-h-screen bg-white border border-gray-200">
            <form wire:submit="create" class="flex-1">
                {{ $this->form }}

                <button type="submit"
                    class="px-4 py-2 block text-md font-semibold uppercase bg-amber-600 text-white hover:bg-amber-700 w-full rounded-lg mt-5 transition-all">
                    Submit
                </button>
            </form>
        </div>
    </div>

    <x-filament-actions::modals />
</div>
