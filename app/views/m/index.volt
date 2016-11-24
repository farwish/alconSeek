<div class="page-header">
    <h3>Index Manage</h3>
</div>

<form class="form-inline" role="form">

    <div class="form-group">
        <p class="form-control-static">项目 : </p>
    </div>
    <div class="form-group">
        <select class="form-control" id="project">
            <?php foreach ($projects as $v):?>
            <option><?=$v;?></option>
            <?php endforeach;?>
        </select>
    </div>

    <div class="form-group">
        <p class="form-control-static">表名 : </p>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="table" placeholder="table name">
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

var p = $("#project").val();

$("#build").on('click', function() {
    var t = $("#table").val();
    if (t.length == 0) return alert('没有填表名!');
    $.post('./build', {project:p, table:t}, function(data) {
        alert(data);
    });
});

$("#rebuild").on('click', function() {
    var t = $("#table").val();
    if (t.length == 0) return alert('没有填表名!');
    $.post('./rebuild', {project:p, table:t}, function(data) {
        alert(data);
    });
});

$("#cleanAndRebuild").on('click', function() {
    var t = $("#table").val();
    if (t.length == 0) return alert('没有填表名!');
    $.post('./cleanAndRebuild', {project:p, table:t}, function(data) {
        alert(data);
    });
});

$("#clean").on('click', function() {
    var t = $("#table").val();
    if (t.length == 0) return alert('没有填表名!');
    $.post('./clean', {project:p, table:t}, function(data) {
        alert(data);
    });
});

});
</script>
