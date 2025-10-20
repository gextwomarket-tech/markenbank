<x-filament-panels::page
    @class([
        'fi-resource-create-record-page',
        'fi-resource-' . str_replace('/', '-', $this->getResource()::getSlug()),
    ])
>
    <div class="d-flex flex-column align-items-center justify-content-center gap-4" style="min-height:70vh;">
        <div class="glass-card w-100 mb-4" style="max-width:600px;background:var(--bg-dark-2);border-radius:1.5rem;">
            <div class="p-4 mb-2" style="background:var(--gradient-primary);color:white;border-top-left-radius:1.5rem;border-top-right-radius:1.5rem;">
                <h2 class="mb-0"><i class="fas fa-plus me-2 opacity-75"></i>Créer @yield('title', $this->getResource()::getLabel())</h2>
            </div>
            <div class="p-4">
                <x-filament-panels::form
                    id="form"
                    :wire:key="$this->getId() . '.forms.' . $this->getFormStatePath()"
                    wire:submit="create"
                >
                    {{ $this->form }}
                    <x-filament-panels::form.actions
                        :actions="$this->getCachedFormActions()"
                        :full-width="$this->hasFullWidthFormActions()"
                    />
                </x-filament-panels::form>
            </div>
        </div>
        <x-filament-panels::page.unsaved-data-changes-alert />
    </div>
</x-filament-panels::page>
