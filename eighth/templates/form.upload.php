<div class="form_head form_width float_left"><span>上传附件</span><div class="float_right close" onclick="hide()">x</div></div>
<div class="form_body form_width float_left">
    <form enctype="multipart/form-data" id="uploadForm">
        <div class="edit_area float_left">
            <div id="version" class="float_left div_space">
                <span class="float_left">教材版本：</span><input hidden name="version" value="<{$v_id}>" type="text" title=""><{$version}>
            </div>
            <div id="upload_attachment" class="float_left div_space">
                <span class="float_left">上传附件：</span>
                <input type="file" title="" class="float_left" name="attachment[]" multiple="multiple">
            </div>
        </div>
        <div class="float_left">
            <div class="button_area">
                <div class="float_left" id="submit_div"><input type="button" value="确定"  onclick="submitUploadForm()"</div>
                <div class="float_right" id="cancel_div"><input type="button" value="取消" onclick="hide()"></div>
            </div>
        </div>
    </form>
</div>
