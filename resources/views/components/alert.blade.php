@props([
    'label',
    'flag' => 'info',
    'icons' => ['success' => 'check-circle', 'info' => 'information-circle', 'error' => 'x-circle'],
    'titles' => ['success' => 'Sucesso', 'info' => 'Informação', 'error' => 'Erro'],
])

<div class="alert {{ $flag }}">
    <div class="alert-icon">
        <x-icon name="{{ $icons[$flag] }}" solid class="w-5 h-5" />
    </div>
    <div class="alert-content">
        <div class="mx-3">
            <span>{{ $titles[$flag] }}</span>
            <p>{{ $label }}</p>
        </div>
    </div>
</div>
