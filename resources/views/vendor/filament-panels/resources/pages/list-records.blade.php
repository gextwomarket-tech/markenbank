<x-filament-panels::page
    @class([
        'fi-resource-list-records-page',
        'fi-resource-' . str_replace('/', '-', $this->getResource()::getSlug()),
    ])
>
    <div class="d-flex flex-column gap-4">
        <div class="glass-card p-4 mb-3 d-flex align-items-center justify-content-between" style="background: var(--gradient-primary); color: white; border-radius: 1.5rem;">
            <div class="d-flex align-items-center">
                <i class="fas fa-database fa-2x me-3 opacity-75"></i>
                <h2 class="m-0" style="font-weight: 700;">@yield('title', ucfirst($this->getResource()::getLabel()))</h2>
            </div>
            <div>
                <x-filament-panels::resources.tabs />
            </div>
        </div>
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_BEFORE, scopes: $this->getRenderHookScopes()) }}
        <div class="glass-card p-0" style="border-radius:1.25rem;overflow:hidden;">
            {{ $this->table }}
        </div>
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_AFTER, scopes: $this->getRenderHookScopes()) }}
    </div>
</x-filament-panels::page>
