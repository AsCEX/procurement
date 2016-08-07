<form id="fm-funds" method="post" novalidate>

    <input type="hidden" name="fund_id" value="<?php echo ($fund_id) ? $fund_id : 0; ?>" />

    <div id="cc" class="easyui-layout" fit="true" style="height:450px;">
        <div data-options="region:'center',title:'Funds'" style="padding:5px;">
            <div class="fitem">
                <label>Fund Name:</label>
                <input name="fund_name" class="easyui-textbox" required="true" align="right" value="<?php echo isset($funds->fund_name) ? $funds->fund_name : ""; ?>">
            </div>
        </div>
    </div>

</form>
<style>
    .source-funds .fitem label { width: 90px; }
</style>