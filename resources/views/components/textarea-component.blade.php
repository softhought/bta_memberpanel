<div class="{{ isset($column) ? $column : '' }}">
    <div class="form-group mb-3">
        <label for="{{ isset($id) ? $id : '' }}" class="form-label">{{ isset($label) ? $label : '' }}</label>

        <textarea
            id="{{ isset($id) ? $id : '' }}"
            name="{{ isset($name) ? $name : '' }}"
            class="form-control {{ isset($class) ? $class : '' }}"
            cols="{{ isset($cols) ? $cols : '' }}"
            rows="{{ isset($rows) ? $rows : '' }}"
            placeholder="{{ isset($placeholder) ? $placeholder : '' }}">{{ isset($value) ? $value : '' }}</textarea>

        <div id="{{ isset($id) ? $id : '' }}_error" class="invalid-feedback d-block error-text"></div>
    </div>
</div>
