<span class="float_left">选择附件：</span>
<div class="float_left input_width">
    <{foreach $attach as $a}>
    <div class="input_width float_left"><input type="checkbox" value="<{$a['id']}>" title="" name="attach[]"><{$a['attachment']}></div>
    <{/foreach}>
</div>