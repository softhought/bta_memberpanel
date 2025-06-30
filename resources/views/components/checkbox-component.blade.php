<div class="{{ isset($column) ? $column : '' }}">
    <label for="{{ $id }}">&nbsp;</label>
    <div class="form-check mt-3">
        <input
            class="form-check-input"
            type="checkbox"
            value="{{ isset($value) ? $value : '' }}"
            name="{{ isset($name) ? $name : '' }}"
            id="{{ isset($id) ? $id : '' }}"
            {{ isset($isChecked) ? $isChecked : '' }}
        />
        <label class="form-check-label" for="{{ isset($id) ? $id : '' }}">
            {{ isset($label) ? $label : '' }}
        </label>
    </div>
</div>
