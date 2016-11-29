<div class="page-header">
    <h3>Index Manage</h3>
</div>

<form class="form-inline" role="form">

    <div class="form-group">
        <p class="form-control-static">项目名 : </p>
    </div>
    <div class="form-group">
        <select class="form-control" id="project">
            <?php foreach ($projects as $v):?>
            <option value="<?=$v;?>"><?=$v;?></option>
            <?php endforeach;?>
        </select>
    </div>

    <div class="form-group">
        <p class="form-control-static">&nbsp;&nbsp;命令(默认) : </p>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="bin" placeholder="bin" value="<?=$bin;?>">
    </div>

    <p>

    <div class="form-group">
        <p class="form-control-static">数据库 : </p>
    </div>
    <div class="form-group">
        <select class="form-control" id="db">
            <?php foreach ($dbs as $k => $v):?>
            <option value="<?=$k;?>"><?=$v;?></option>
            <?php endforeach;?>
        </select>
    </div>

    <div class="form-group">
        <p class="form-control-static">&nbsp;&nbsp;数据表 : </p>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="table" placeholder="table (除清空之外必填)">
    </div>

    <hr/>

    <div class="row">
        <div class="col-xs-2">
            <button type="button" class="btn btn-info" id="build">生成</button>
        </div>
    </div>

    <hr/>

    <div class="row">
        <div class="col-xs-2">
            <button type="button" class="btn btn-info" id="rebuild">平滑重建</button>
        </div>
    </div>

    <hr/>

    <div class="row">
        <div class="col-xs-2">
            <button type="button" class="btn btn-info" id="cleanAndRebuild">清空并重建</button>
        </div>
    </div>

    <hr/>

    <div class="row">
        <div class="col-xs-2">
            <button type="button" class="btn btn-info" id="clean">清空</button>
        </div>
    </div>

</form>

<script>
$(function () {
'use strict'

$("#build").on('click', function() {
    var p = $("#project").val();
    var t = $("#table").val();
    var b = $("#bin").val();
    var db = $('#db').val();
    if (t.length == 0) return alert('没有填表名!');
    $.post('./build', {project:p, table:t, bin:b, db:db}, function(data) {
        alert(data);
    });
});

$("#rebuild").on('click', function() {
    var p = $("#project").val();
    var t = $("#table").val();
    var b = $("#bin").val();
    var db = $('#db').val();
    if (t.length == 0) return alert('没有填表名!');
    $.post('./rebuild', {project:p, table:t, bin:b, db:db}, function(data) {
        alert(data);
    });
});

$("#cleanAndRebuild").on('click', function() {
    var p = $("#project").val();
    var t = $("#table").val();
    var b = $("#bin").val();
    var db = $('#db').val();
    if (t.length == 0) return alert('没有填表名!');
    $.post('./cleanAndRebuild', {project:p, table:t, bin:b, db:db}, function(data) {
        alert(data);
    });
});

$("#clean").on('click', function() {
    var p = $("#project").val();
    var b = $("#bin").val();
    $.post('./clean', {project:p, bin:b}, function(data) {
        alert(data);
    });
});

});
</script>
