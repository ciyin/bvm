<div class="form_head form_width float_left"><span>教材改版</span><div class="float_right close" onclick="hide()">x</div></div>
<div class="form_body form_width float_left">
    <form enctype="multipart/form-data" id="updateForm">
        <div class="edit_area float_left">
            <div id="book_name" class="div_space">
                <span class="float_left">教材名称：</span><input hidden name="book" value="<{$book_id}>" type="text" title=""><{$bookname}>
            </div>
            <div id="version" class="float_left div_space">
                <span class="float_left">教材版本：</span><input type="text" title="" class="input_width" name="version">
            </div>
            <div id="update_reason" class="float_left div_space">
                <span class="text_area_height float_left">改版说明：</span>
                <textarea cols="50" rows="5" title="" class="float_left" name="update_reason"></textarea>
            </div>
            <div id="upload_cover" class="float_left div_space">
                <span class="float_left">教材封面：</span>
                <input type="file" title="" class="float_left" name="cover">
                <div class="float_left" id="cover"></div>
            </div>
            <div id="upload_attachment" class="float_left div_space">
                <span class="float_left">教材附件：</span>
                <input type="file" title="" class="float_left" name="attachment[]" multiple="multiple" style="width: 200px">
                <button type="button" value="<{$book_id}>" class="float_left btn_u" onclick="showAttach(this.value)">从资料库选择</button>
            </div>
            <div id="select_attachments" class="float_left div_space"></div>
        </div>
        <div class="float_left">
            <div class="button_area">
                <div class="float_left" id="submit_div"><input type="button" value="确定"  onclick="submitUpdateForm()"</div>
                <div class="float_right" id="cancel_div"><input type="button" value="取消" onclick="hide()"></div>
            </div>
        </div>
    </form>
</div>
