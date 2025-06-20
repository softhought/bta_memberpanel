<div class="{{ $column }}">
    <div class="picture-container mb-3">
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
        <div class="picture {{ $class }}">
            <img src="{{ $value }}" class="picture-src" id="{{ $imagePreview }}" title="">
            <input type="file" id="{{ $id }}" name="{{ $name }}" class="readUrl"
                data-showImage="{{ $imagePreview }}">
            @if ($value == '')
                <div class="upload-text mt-2">
                    <i class="fa-solid fa-cloud-arrow-up fs-30"></i><br>
                    <span class="note needsclick fs-14">Upload Image </span>
                </div>
            @endif
        </div>
        {{-- <h6 class="">Choose Picture</h6> --}}
        <div id="{{ $id }}_error" class="invalid-feedback d-block error-text">{{ $errorMsg }}</div>
    </div>
</div>
