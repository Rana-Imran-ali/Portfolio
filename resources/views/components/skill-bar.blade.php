@props(['name', 'proficiency'])

<div class="mb-5">
    <div class="flex justify-between mb-1.5">
        <span class="font-medium text-sm">{{ $name }}</span>
        <span class="text-gray-400 text-xs">{{ $proficiency }}%</span>
    </div>
    <div class="w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
        <div class="bg-black h-full transition-all duration-700" style="width: {{ $proficiency }}%"></div>
    </div>
</div>
