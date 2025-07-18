<div class="{{ isset($column) ? $column : '' }}">
    <div class="form-group mb-3 validate-input">
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
        <input
            type="{{ $type }}"
            class="form-control {{ $class }}"
            id="{{ $id }}"
            name="{{ isset($name) ? $name : '' }}"
            placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
            value="{{ $value }}"
            autocomplete="off"
            maxlength="{{ isset($maxlength) ? $maxlength : '' }}"
            {!! isset($readonly) ? $readonly : '' !!}
        />
        <div id="{{ $id }}_error" class="invalid-feedback d-block error-text"></div>
    </div>
</div>
