<div class="col-sm-12 col-md-12 col-lg-12 versionSummary"><!--【3.1】-->
    <span>版本信息：共<{$rows}>个版本，目前最新的版本号为：<{$maxVersion['version']}></span>
</div><!--【3.1】-->
<div class="col-sm-12 col-md-12 col-lg-12" style="padding: 0"><!--【3.2】-->
    <ul class="nav nav-pills">
        <{foreach $versionNum as $value}>
        <li class="version" onclick="clickVersion(<{$value['id']}>)"><{$value['version']}></li>
        <{/foreach}>
    </ul>
</div><!--【3.2】-->
<div class="col-sm-12 col-md-12 col-lg-12 versionDiv" id="specificInfo"><!--【3.3】-->