    <ul>
        <{foreach $attachments as $val}>
        <li>
            <a href="<{$val['saved_at']}>"><{$val['attachment']}></a><span>(<{$val['status']}>)</span>
            <!--如果附件为使用中的状态，且该角色有操作权限，则显示停用按钮-->
            <{if $val['status']=='使用中' && $role}>
            <span><button class="btn_u" onclick="discardAttachment(<{$val['id']}>)">停用</button></span>
            <{/if}>
        </li>
        <{/foreach}>
    </ul>
</div><!--【3.3.1.2】-->
