        <div class="row"><!--row of 操作区-->
            <div class="col-xs-12 col-md-4 col-lg-4 float_left select_area">
                <div class="float_left select_exam_type"><!--考试类型筛选-->
                    <form id="select_exam_type">
                        <span>考试类型：</span>
                        <select title="exam_type" name="select_exam_type" id="selectExamType" onchange="examTypeSelect()">
                            <option value=""></option>
                            <option value="全部">全部</option>
                            <option value="TOEFL">TOEFL</option>
                            <option value="新SAT">新SAT</option>
                            <option value="SSAT">SSAT</option>
                            <option value="ACT">ACT</option>
                            <option value="SAT Subject">SAT Subject</option>
                            <option value="TOEFL Junior">TOEFL Junior</option>
                            <option value="IELTS">IELTS</option>
                            <option value="AP">AP</option>
                        </select>
                    </form>
                </div><!--考试类型筛选 end-->
                <div class="float_left"><!--教材类型筛选-->
                    <form id="select_book_type">
                        <span>教材类型：</span>
                        <select title="book_type" name="select_book_type" id="selectBookType" onchange="bookTypeSelect()">
                            <option value=""></option>
                            <option value="全部">全部</option>
                            <option value="课本">课本</option>
                            <option value="词表">词表</option>
                            <option value="模考卷">模考卷</option>
                        </select>
                    </form>
                </div><!--教材类型筛选 end-->
            </div><!--筛选 end-->
            <div class="col-xs-12 col-md-1 col-lg-1 float_left new_button"><{$newBtn}></div><!--按钮 end-->
            <div class="col-xs-12 col-md-3 col-lg-3 float_right">
                <div class="float_right search_area">
                    <form id="keywords">
                        <input type="text" placeholder="请输入教材名称搜索" name="search_keywords">
                        <input type="button" value="搜索" id="searchKeywords" onclick="Keywords()">
                    </form>
                </div>
            </div><!--搜索 end-->
        </div><!--row of 操作区 end-->
        <div class="book_list"><!--row of 列表区-->
            <table class="table table-responsive">
                <thead>
                <tr class="head_row">
                    <td width="5%"></td>
                    <td width="25%">教材名称</td>
                    <td width="15%">考试类型</td>
                    <td width="10%">教材类型</td>
                    <td width="10%">使用状态</td>
                    <td width="15%">最新版本</td>
                    <td width="15%">更新于</td>
                </tr>
                </thead>
            </table>
            <div><!--待替换的列表-->
                <table class="table table-responsive" id="table_body">