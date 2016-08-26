<form id="fm-stocks" method="post" novalidate>

    <input type="hidden" name="stock_id" value="<?php echo isset($stock->stock_id) ? $stock->stock_id : 0; ?>" />

    <div id="cc" class="easyui-layout" fit="true" style="height:450px;">
        <div data-options="region:'center',title:'Stock'" style="padding:5px;">
            <div class="fitem">
                <label>Category:</label>
                <select class="easyui-combobox" editable="false" name="stock_cat_id" style="width:250px"
                        url="<?php echo site_url('categories/getCategoriesComboBox'); ?>/<?php echo isset($stock->stock_cat_id) ? $stock->stock_cat_id : ''; ?>"
                        method="get"
                        valueField="name"
                        prompt="Select Category"
                        textField="value"
                        required="true">
                </select>
            </div>
            <div class="fitem">
                <label>Stock Description:</label>
                <input name="stock_description" class="easyui-textbox" required="true" style="width:250px" align="right" value="<?php echo isset($stock->stock_description) ? $stock->stock_description : ""; ?>">
            </div>
        </div>
    </div>
</form>
<style>
    form#fm-stocks .fitem label { width: 122px; }
</style>