<div class="form_head form_width float_left"><span>新增教材</span><div class="float_right close" onclick="hide()">x</div></div>
<div class="form_body form_width float_left">
    <form enctype="multipart/form-data" id="newForm">
        <div class="edit_area float_left">
            <div id="book_name" class="div_space">
                <span class="float_left">教材名称：</span><input type="text" title="" class="input_width float_left" name="book">
            </div>
            <div id="warning" class="div_space float_left"></div>
            <div id="exam_type" class="float_left div_space">
                <span class="float_left exam_height">考试类型：</span>
                <div class="float_left input_width">
                    <div class="box_width_1 float_left"><input type="checkbox" value="TOEFL" title="" name="exam_type[]">TOEFL</div>
                    <div class="box_width_1 float_left"><input type="checkbox" value="新SAT" title="" name="exam_type[]">新SAT</div>
                    <div class="box_width_1 float_left"><input type="checkbox" value="ACT" title="" name="exam_type[]">ACT</div>
                    <div class="box_width_1 float_left"><input type="checkbox" value="SSAT" title="" name="exam_type[]">SSAT</div>
                    <div class="box_width_1 float_left"><input type="checkbox" value="IELTS" title="" name="exam_type[]">IELTS</div>
                    <div class="box_width_2 float_left"><input type="checkbox" value="TOEFL Junior" title="" name="exam_type[]">TOEFL Junior</div>
                    <div class="box_width_2 float_left"><input type="checkbox" value="SAT Subject" title="" name="exam_type[]">SAT Subject</div>
                    <div class="box_width_1 float_left"><input type="checkbox" value="AP" title="" name="exam_type[]">AP</div>
                </div>
            </div>
            <div id="book_type" class="float_left div_space">
                <span class="float_left">教材类型：</span>
                <div class="float_left">
                    <div class="box_width_1 float_left"><input type="radio" value="课本" title="" name="book_type">课本</div>
                    <div class="box_width_1 float_left"><input type="radio" value="词表" title="" name="book_type">词表</div>
                    <div class="box_width_1 float_left"><input type="radio" value="模考卷" title="" name="book_type">模考卷</div>
                </div>
            </div>
            <div id="version" class="float_left div_space">
                <span>教材版本：</span><input type="text" title="" class="input_width" name="version">
            </div>
            <div id="contents" class="float_left div_space">
                <span class="text_area_height float_left">教材内容：</span>
                <textarea cols="50" rows="5" title="" class="float_left" name="contents"></textarea>
            </div>
            <div id="using_instruction" class="float_left div_space">
                <span class="text_area_height float_left">使用说明：</span>
                <textarea cols="50" rows="5" title="" class="float_left" name="using_instruction"></textarea>
            </div>
            <div id="upload_cover" class="float_left div_space">
                <span class="float_left">教材封面：</span>
                <input type="file" title="" class="float_left" name="cover">
            </div>
            <div id="upload_attachment" class="float_left div_space">
                <span class="float_left">教材附件：</span>
                <input type="file" title="" class="float_left" name="attachment[]" multiple="multiple">
            </div>
        </div>
        <div class="float_left">
            <div class="button_area">
                <div class="float_left" id="submit_div"><input type="button" value="确定"  onclick="submitNewForm()"</div>
                <div class="float_right" id="cancel_div"><input type="button" value="取消" onclick="hide()"></div>
            </div>
        </div>
    </form>
</div>