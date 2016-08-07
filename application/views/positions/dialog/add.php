<form id="fm-positions" method="post" novalidate>

    <input type="hidden" name="pos_id" value="<?php echo ($pos_id) ? $pos_id : 0; ?>" />

    <div id="cc" class="easyui-layout" fit="true" style="height:450px;">
        <div data-options="region:'center',title:'Positions'" style="padding:5px;">
            <div class="fitem">
                <label>Position Name:</label>
                <input name="pos_name" class="easyui-textbox" required="true" align="right" value="<?php echo isset($positions->pos_name) ? $positions->pos_name : ""; ?>">
            </div>
        </div>
    </div>

</form>
<style>
    .positions .fitem label { width: 110px; }
</style>