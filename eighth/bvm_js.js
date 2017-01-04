   //show():显示遮罩和表单
   function show() {
       document.getElementById('shade').style.display='block';
       document.getElementById('form_div').style.display='block';
   }
   //hide():隐藏遮罩和表单
   function hide() {
       document.getElementById('shade').style.display='none';
       document.getElementById('form_div').style.display='none';
   }
   //sendData():用来传递表单值的函数
   //1、先选择要传值的表单；2、将值传到哪个页面；3、选择用哪个类的哪个方法接收和执行；4、选择要替换的页面；5、传值方式。
   function sendData(formId,url,controller,action,replaceId,method){
       var form=new FormData(formId);
       form.append('controller',controller);
       form.append('action',action);
       var xhr=new XMLHttpRequest();
       xhr.onreadystatechange=function () {
           if (xhr.readyState==4&&xhr.status==200){
               document.getElementById(replaceId).innerHTML=xhr.responseText;
           }
       };
       xhr.open(method,url,true);
       xhr.send(form);
   }
   //examTypeSelect():按考试类型筛选，筛选后在教材列表处显示筛选结果
   function examTypeSelect() {
       var formId=document.getElementById('select_exam_type');
       var url="index.php";
       var replaceId='table_body';
       var method='post';
       var controller='search';
       var action='examType';
       sendData(formId,url,controller,action,replaceId,method);
   }
   //bookTypeSelect():按教材类型筛选，筛选后在教材列表处显示筛选结果
   function bookTypeSelect() {
       var formId=document.getElementById('select_book_type');
       var url="index.php";
       var replaceId='table_body';
       var method='post';
       var controller='search';
       var action='bookType';
       sendData(formId,url,controller,action,replaceId,method);
   }
   //Keywords():按教材名称搜索，搜索后在教材列表处显示搜索结果
   function Keywords() {
       var formId=document.getElementById('keywords');
       var url="index.php";
       var replaceId='table_body';
       var method='post';
       var controller='search';
       var action='keywords';
       sendData(formId,url,controller,action,replaceId,method);
   }
   //submitNewForm():提交新增表单，替换首页的教材列表模块
   function submitNewForm() {
       var formId=document.getElementById('newForm');
       var url="index.php";
       var replaceId='table_body';
       var method='post';
       var controller='form';
       var action='submitNewForm';
       sendData(formId,url,controller,action,replaceId,method);
       hide();
   }
   //discardBook():点击基本信息处的停用，弹出确认窗口，确认后，替换详情页的教材基本信息模块
   function discardBook() {
       if (confirm('确认停用该本教材？')){
           var formId=document.getElementById('bookID');
           var url="index.php";
           var replaceId='bookInfo';
           var method='post';
           var controller='form';
           var action='discardBook';
           sendData(formId,url,controller,action,replaceId,method);
       }
   }
   //discardAttachment(id):点击附件列表处的停用，弹出确认窗口，确认后，替换详情页的附件信息模块
   function discardAttachment(id) {
       if (confirm('确认停用该附件？')){
           var xhr=new XMLHttpRequest();
           xhr.onreadystatechange=function () {
               if (xhr.readyState==4 && xhr.status==200){
                   document.getElementById('attachs').innerHTML=xhr.responseText;
               }
           };
           xhr.open('get','index.php?controller=form&action=discardAttachment&attach='+id,true);
           xhr.send();
       }
   }
   //showUpdateForm():显示改版表单
   function showUpdateForm() {
       var formId=document.getElementById('bookID');
       var url="index.php";
       var replaceId='form_div';
       var method='post';
       var controller='form';
       var action='showUpdate';
       sendData(formId,url,controller,action,replaceId,method);
       show();
   }
   //showNew():显示新增表单
   function showNew() {
       show();
       var xhr=new XMLHttpRequest();
       xhr.onreadystatechange=function () {
           if (xhr.readyState==4 && xhr.status==200){
               document.getElementById('form_div').innerHTML=xhr.responseText;
           }
       };
       xhr.open('get','index.php?controller=form&action=showNew',true);
       xhr.send();
   }
   //showAttach():改版表单中，点击‘从资料库中选择’，显示该本教材的所有附件,参数教材id
   function showAttach(id) {
       document.getElementById('select_attachments').style.display='block';
       var xhr=new XMLHttpRequest();
       xhr.onreadystatechange=function () {
           if (xhr.readyState==4 && xhr.status==200){
               document.getElementById('select_attachments').innerHTML=xhr.responseText;
           }
       };
       xhr.open('get','index.php?controller=form&action=selectAttachment&book='+id,true);
       xhr.send();
   }
   //submitUpdateForm():提交改版表单
   function submitUpdateForm() {
       var formId=document.getElementById('updateForm');
       var url="index.php";
       var replaceId='versionInfo';
       var method='post';
       var controller='form';
       var action='submitUpdate';
       sendData(formId,url,controller,action,replaceId,method);
       hide();
   }
   //upload():显示上传附件表单
   function upload() {
       var formId=document.getElementById('upload');
       var url="index.php";
       var replaceId='form_div';
       var method='post';
       var controller='form';
       var action='showUpload';
       sendData(formId,url,controller,action,replaceId,method);
       show();
   }
   //submitUploadForm():提交上传附件的表单
   function submitUploadForm() {
       var formId=document.getElementById('uploadForm');
       var url="index.php";
       var replaceId='attachs';
       var method='post';
       var controller='form';
       var action='submitUpload';
       sendData(formId,url,controller,action,replaceId,method);
       hide();
   }
   //clickVersion():点击版本号，显示不同的版本详情，传参：版本号id
   function clickVersion(id) {
       var xhr=new XMLHttpRequest();
       xhr.onreadystatechange=function () {
           if (xhr.readyState==4 && xhr.status==200){
               document.getElementById('specificInfo').innerHTML=xhr.responseText;
           }
       };
       xhr.open('get','index.php?controller=showversioninfo&action=showinfo&v='+id,true);
       xhr.send();
   }