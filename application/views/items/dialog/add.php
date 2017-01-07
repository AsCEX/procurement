<form id="fm-items" method="post" novalidate>

    <input type="hidden" name="item_id" value="<?php echo isset($item->item_id) ? $item->item_id : 0; ?>" />

    <div id="cc" class="easyui-layout" fit="true" style="height:450px;">
        <div data-options="region:'center',title:'Item'" style="padding:5px;">
            <div class="fitem">
                <label>Category:</label>
                <select class="easyui-combobox" editable="false" name="item_stock_id" style="width:250px"
                        url="<?php echo site_url('stocks/getStocksComboBox'); ?>/<?php echo isset($item->item_stock_id) ? $item->item_stock_id : ''; ?>"
                        method="get"
                        valueField="name"
                        prompt="Select Stock"
                        textField="value"
                        required="true">
                </select>
            </div>
            <div class="fitem">
                <label>Stock Description:</label>
                <input name="item_description" class="easyui-textbox" required="true" style="width:250px" align="right" value="<?php echo isset($item->item_description) ? $item->item_description : ""; ?>">
            </div>
        </div>
    </div>
</form>
<style>
    form#fm-stocks .fitem label { width: 122px; }
</style>