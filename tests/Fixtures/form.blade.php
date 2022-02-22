<div>
    <x-slot name="header">
        {{ __(sprintf('%s Post', ucfirst($target))) }}
    </x-slot>

    <div class="mt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow p-6 rounded-lg">
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form class="space-y-4" wire:submit.prevent="{{ $target }}">
                <div>
                    <x-jet-label for="title" value="{{ __('Title') }}" />
                    <x-jet-input id="title" class="block mt-1 w-full" type="text" wire:model.defer="state.title" />
                    <x-jet-input-error for="title" class="mt-2" />
                </div>

                <div class="flex items-center justify-between">
                    <x-jet-button>
                        {{ __($target) }}
                    </x-jet-button>

                    @if ($this->isTarget('update'))
                        <x-jet-danger-button wire:click="delete">
                            {{ __('Delete') }}
                        </x-jet-danger-button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
