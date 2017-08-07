<div class="mb-2 block-remove {{if $exp.never_work != 1}}hidden{{/if}}">
    <div class="checkbox">
        <label>
            <input type="checkbox" name="experience-never_work[]" class="never-work" value="1">
            еще ниг-де не работал
        </label>
    </div>
</div>
<div class="never-work-hide {{if $exp.never_work == 1}}hidden{{/if}}">
    <div class="mb-2">
        <label>Название компании</label>
        <input type="text" name="experience-name_company[]" class="form-control"
               value="{{if !empty($exp.name_company)}}{{$exp.name_company}}{{/if}}">
    </div>
    <div class="mb-2">
        <label>Должность</label>
        <input type="text" name="experience-position[]" class="form-control" value="{{if !empty($exp.position)}}{{$exp.position}}{{/if}}">
    </div>
    <div class="mb-2 hidden">
        <label>Период работы</label>
        <div class="form-inline">
            <span class="mr-2">c</span>
            <input type="text" name="experience-date_start[]" class="form-control mr-2">
            по
            <input type="text" name="experience-date_end" class="form-control hidden ml-2">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="experience-present_time[]" class="never-work" value="1">
                    настоящее время
                </label>
            </div>
        </div>
    </div>
</div>