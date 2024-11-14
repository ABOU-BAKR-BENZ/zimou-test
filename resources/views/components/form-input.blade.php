<div class="mb-4">
    <label for="{{ $name }}" class="block font-bold text-xl text-white">{{ $label }}</label>
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}"
        class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-900" placeholder="{{ $placeholder }}"
        required>
    @error($name)
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>
