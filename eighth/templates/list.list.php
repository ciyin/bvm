                    <{foreach $list as $value}>
                    <tr>
                        <td width="5%"><input type="checkbox" title=""></td>
                        <td width='25%'><a href="index.php?controller=showpage&action=showDetails&book=<{$value['id']}>" target="_blank"><{$value['book']}></a></td>
                        <td width="15%"><{$value['exam_type']}></td>
                        <td width="10%"><{$value['book_type']}></td>
                        <td width="10%"><{$value['status']}></td>
                        <td width="15%"><{$value['version']}></td>
                        <td width="15%"><{$value['created_at']}></td>
                    </tr>
                    <{/foreach}>
                    <tr><td colspan="7">共<{$rows}>条记录</td></tr>
                </table>
            </div><!--table_body end-->
        </div><!--row of 列表区 end-->

