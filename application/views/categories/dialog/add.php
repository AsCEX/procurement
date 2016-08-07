<form id="fm-categories" method="post" novalidate>

    <input type="hidden" name="cat_id" value="<?php echo ($cat_id) ? $cat_id : 0; ?>" />

    <div id="cc" class="easyui-layout" fit="true" style="height:450px;">
        <div data-options="region:'center',title:'Category'" style="padding:5px;">
            <div class="fitem">
                <label>Code:</label>
                <input name="cat_code" class="easyui-textbox" required="true" align="right" value="<?php echo isset($category->cat_code) ? $category->cat_code : ""; ?>">
            </div>
            <div class="fitem">
                <label>Description:</label>
                <input name="cat_description" class="easyui-textbox" required="true" align="right" value="<?php echo isset($category->cat_description) ? $category->cat_description : ""; ?>">
            </div>
        </div>
    </div>

</form>