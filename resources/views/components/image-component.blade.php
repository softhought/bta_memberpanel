<div class="{{ isset($column) ? $column : '' }}">
    <div class="picture-container mb-3">
        <label for="{{ isset($id) ? $id : '' }}" class="form-label">{{ isset($label) ? $label : '' }}</label>

        <div class="picture {{ isset($class) ? $class : '' }}">
            <img src="{{ isset($value) ? $value : '' }}" class="picture-src" id="{{ isset($imagePreview) ? $imagePreview : '' }}" title="">

            <input type="file"
                   id="{{ isset($id) ? $id : '' }}"
                   name="{{ isset($name) ? $name : '' }}"
                   class="readUrl"
                   data-showImage="{{ isset($imagePreview) ? $imagePreview : '' }}">

            @if (!isset($value) || $value == '')
                <div class="upload-text mt-2">
                    <i class="fa-solid fa-cloud-arrow-up fs-30"></i><br>
                    <span class="note needsclick fs-14">Upload Image</span>
                </div>
            @endif
        </div>

        <div id="{{ isset($id) ? $id : '' }}_error" class="invalid-feedback d-block error-text">
            {{ isset($errorMsg) ? $errorMsg : '' }}
        </div>
    </div>
</div>
