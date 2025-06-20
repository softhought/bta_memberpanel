<style>
    .control-fileupload {
        display: flex;
        align-items: center;
        border: 1px solid #d6d7d6;
        background: #FFF;
        border-radius: 4px;
        width: 100%;
        height: 36px;
        padding: 0px 10px 2px 10px;
        position: relative;
    }

    .control-fileupload button {
        display: inline-block;
        font-size: 14px;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        border: #438601;
        border-radius: 4px;
        background-color: #438601;
        color: #fff;
        padding: 8px 15px 7px 20px;
        margin-left: -10px;
        margin-top: 2px;
        transition: background-color 0.3s ease;
    }

    .control-fileupload button:hover {
        background-color: #2e3094;
    }

    .control-fileupload label {
        line-height: 24px;
        font-size: 14px;
        font-weight: normal;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        margin-right: 10px;
        margin-bottom: 0px;
        margin-left: 10px;
        cursor: text;
    }

    .control-fileupload input[type="file"] {
        cursor: pointer !important;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        z-index: 2;
    }
</style>

<label>{{ $label }}</label>
<span class="control-fileupload">
    <button onclick="document.getElementById('{{ $id }}').click()">Browse...</button>
    <input type="hidden" id="{{ $id }}_validate" name="{{ $id }}_validate" value="{{ $value }}">
    <label for="{{ $id }}" id="{{ $id }}_label">{{ $value ? $value : 'Chose ' . $label }}</label>
    <input type="file" style="opacity: 0;" id="{{ $id }}" name="{{ $id }}" class="p-0"
        accept="{{ $accept }}">
</span>
<p class="invalid-feedback d-block error-text" id="{{ $id }}_validate_error"></p>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var fileInput = document.getElementById("{{ $id }}");
        fileInput.addEventListener("change", function() {
            var t = this.value;
            var labelText = t.split('\\').pop();
            document.getElementById("{{ $id }}_label").textContent = labelText;
            document.getElementById("{{ $id }}_validate").value = labelText;
        });
    });
</script>
