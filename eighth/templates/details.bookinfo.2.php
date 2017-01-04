<div class="row dl"><!--【2.2】-->
    <div class="col-xs-12 col-md-12 col-lg-12" style="margin-bottom: 5px"><!--【2.3】-->
        <form id="bookID" class="float_right">
            <input hidden name="book" value="<{$bookInfo['id']}>" type="text" title="">
            <{$btnOfBooks}>
        </form>
    </div><!--【2.3】-->
    <div class="col-xs-12 col-md-12 col-lg-12"><!--【2.4】-->
        <table class="table table-responsive basicInfo">
            <thead>
            <tr>
                <td class="td_name">教材名称：</td><td width="20%"><{$bookInfo['book']}></td>
                <td class="td_name">使用状态：</td><td id="bookStatus"><{$bookInfo['status']}></td>
                <td class="td_name">考试类型：</td><td><{$bookInfo['exam_type']}></td>
                <td class="td_name">教材分类：</td><td><{$bookInfo['book_type']}></td>
            </tr>
            <tr>
                <td class="td_name">教材内容：</td><td colspan="7"><{$bookInfo['contents']}></td>
            </tr>
            <tr>
                <td class="td_name">使用说明：</td><td colspan="7"><{$bookInfo['using_instruction']}></td>
            </tr>
            </thead>
        </table>
    </div><!--【2.4】-->
</div><!--【2.2】-->
</div><!--【2.1】-->
<div class="row" id="versionInfo"><!--【2.2】-->