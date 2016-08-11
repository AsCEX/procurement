
<script src="<?php echo site_url("assets/dist/js/form.bootstrap.js"); ?>"></script>
<script language="javascript">
    $(document).ready(function(){
        $('.numeric').numeric();
        $( document ).on( 'focus', ':input', function(){
            $( this ).attr( 'autocomplete', 'off' );
        });
    });
</script>
<style>
    .table>thead>tr>th {
        vertical-align: middle;
    }
</style>

    <form method="post" id="add-procurement-form" action="<?php echo site_url('purchased_request/saveItems'); ?>">


            <input type="hidden" name="pri_id" value="<?php echo $items['pri_id']; ?>" />
            <input type="hidden" name="pri_pr_id" value="<?php echo $pr_id; ?>" />
            <input type="hidden" name="pri_ppmp_id" value="<?php echo $items['pri_ppmp_id']; ?>" />
            <!--<input type="hidden" name="pri_qty" value="<?php /*echo $items['pri_qty']; */?>" />-->
            <!--<input type="hidden" name="pri_cost" value="<?php /*echo $items['pri_cost']; */?>" />-->

        <div class="form-group col-md-12">
            <label>Quantity</label>
            <input name="pri_qty" class="form-control" placeholder="0" value="<?php echo $items['pri_qty']; ?>" />
        </div>
        <div class="form-group col-md-12">
            <label>Cost</label>
            <input name="pri_cost" class="form-control" placeholder="0" value="<?php echo $items['pri_cost']; ?>" />
        </div>
        <div class="form-group col-md-12">
            <label>Item Description</label>
            <textarea name="pri_description" class="form-control" placeholder="Item Description here"><?php echo $items['pri_description']; ?></textarea>
        </div>
        <div class="clearfix"></div>


            <div class="repeater-default-values">
                <div data-repeater-list="pr_items">

                    <div data-repeater-item class="pr-items-repeater" style="display:none;">
                        <div class="form-group col-md-12">

                            <div class="panel panel-default">
                                <div class="panel-heading">Item Details
                                  <span data-repeater-delete class="pull-right" style="color: #bd1515;cursor:pointer;">
                                    <span class="glyphicon glyphicon-remove"></span>
                                  </span>
                                </div>
                                <div class="panel-body">

                                    <input type="hidden" name="prid_id" value="" />

                                    <div class="col-md-8">
                                        <div class="form-group col-md-12">
                                            <label>Name</label>
                                            <input type="text" class="form-control required" name="prid_title" value="" placeholder="Name" />
                                        </div>

                                        <div class="col-md-12">
                                            <label>Description</label>
                                            <textarea class="form-control" name="prid_description" placeholder="Description"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group col-md-12 pull-right">
                                            <label>Cost</label>
                                            <input type="text" class="form-control numeric" name="prid_cost" value="" placeholder="0"/>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br /><br />

                                    <div class="col-md-12">

                                        <div class="inner-repeater" >

                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th width="10%">Qty</th>
                                                    <th width="20%">Unit</th>
                                                    <th width="45%">Name</th>
                                                    <th width="20%">Cost</th>
                                                    <th width="5%"></th>
                                                </tr>
                                                </thead>
                                                <tbody data-repeater-list="item_details">
                                                    <tr data-repeater-item>
                                                        <td>
                                                            <input type="hidden" class="form-control" name="prs_id" value="" />
                                                            <input style="text-align:right;" type="text" name="prs_qty" value="" placeholder="0" class="form-control numeric required"/>
                                                        </td>
                                                        <td>
                                                            <select name="prs_unit" class="form-control required">
                                                                <option value="">Select Unit</option>
                                                                <?php foreach($units as $unit): ?>
                                                                    <option value="<?php echo $unit->unit_id; ?>"><?php echo $unit->unit_name; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </td>
                                                        <td><input type="text" name="prs_name" value="" placeholder="Name" class="form-control required"/></td>
                                                        <td><input style="text-align:right;" type="text" name="prs_cost" value="" placeholder="0" class="form-control required numeric"/></td>
                                                        <td>
                                                        <span data-repeater-delete class="pull-right" style="color: #bd1515;cursor:pointer;">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                      </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                              <span data-repeater-create class="btn btn-default btn-md">
                                                <span class="glyphicon glyphicon-plus"></span> Add Sub Specs
                                              </span>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="clearfix"></div>

                    </div>
                    <?php $pr_items = (isset($items['pr_items'])) ? $items['pr_items'] : array(); ?>
                    <?php foreach($pr_items as $item): ?>
                        <div data-repeater-item class="pr-items-repeater">
                            <div class="form-group col-md-12">
                                <input type="hidden" name="prid_id" value="<?php echo $item['prid_id']; ?>" />
                                <div class="panel panel-default">
                                    <div class="panel-heading">Item Details
                                      <span data-repeater-delete class="pull-right" style="color: #bd1515;cursor:pointer;">
                                        <span class="glyphicon glyphicon-remove"></span>
                                      </span>
                                    </div>
                                    <div class="panel-body">


                                        <div class="col-md-8">
                                            <div class="form-group col-md-12">
                                                <label>Name</label>
                                                <input type="text" class="form-control required" name="prid_title" value="<?php echo $item['prid_title']; ?>" placeholder="Name" />
                                            </div>

                                            <div class="col-md-12">
                                                <label>Description</label>
                                                <textarea class="form-control" name="prid_description" placeholder="Description"><?php echo $item['prid_description']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group col-md-12 pull-right">
                                                <label>Cost</label>
                                                <input type="text" class="form-control numeric" name="prid_cost" value="<?php echo $item['prid_cost']; ?>" placeholder="0"/>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <br /><br />

                                        <div class="col-md-12">

                                            <div class="inner-repeater" >

                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th width="10%">Qty</th>
                                                            <th width="20%">Unit</th>
                                                            <th width="45%">Name</th>
                                                            <th width="20%">Cost</th>
                                                            <th width="5%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody data-repeater-list="item_details">
                                                    <?php if(count($item['item_details']) == 0): ?>

                                                        <tr data-repeater-item>
                                                            <td>
                                                                <input type="hidden" class="form-control" name="prs_id" value="" />
                                                                <input style="text-align:right;" type="text" name="prs_qty" value="" placeholder="0" class="form-control numeric required"/>
                                                            </td>
                                                            <td>
                                                                <select name="prs_unit" class="form-control required">
                                                                    <option value="">Select Unit</option>
                                                                    <?php foreach($units as $unit): ?>
                                                                        <option value="<?php echo $unit->unit_id; ?>"><?php echo $unit->unit_name; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" name="prs_name" value="" placeholder="Name" class="form-control required"/></td>
                                                            <td><input style="text-align:right;" type="text" name="prs_cost" value="" placeholder="0" class="form-control required numeric"/></td>
                                                            <td>
                                                            <span data-repeater-delete class="pull-right" style="color: #bd1515;cursor:pointer;">
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                          </span>
                                                            </td>
                                                        </tr>

                                                    <?php endif; ?>
                                                        <?php foreach($item['item_details'] as $detail): ?>
                                                        <tr data-repeater-item>
                                                            <td>
                                                                <input type="hidden" class="form-control" name="prs_id" value="<?php echo $detail['prs_id']; ?>" />
                                                                <input style="text-align:right;" type="text" name="prs_qty" value="<?php echo $detail['prs_qty']; ?>" placeholder="0" class="form-control numeric required"/>
                                                            </td>
                                                            <td>
                                                                <select name="prs_unit" class="form-control required">
                                                                    <option value="">Select Unit</option>
                                                                    <?php foreach($units as $unit): ?>
                                                                    <option value="<?php echo $unit->unit_id; ?>" <?php echo ($detail['prs_unit'] == $unit->unit_id) ? "selected" : ""; ?> ><?php echo $unit->unit_name; ?></option>
                                                                <?php endforeach; ?>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" name="prs_name" value="<?php echo $detail['prs_name']; ?>" placeholder="Name" class="form-control required"/></td>
                                                            <td><input style="text-align:right;" type="text" name="prs_cost" value="<?php echo $detail['prs_cost']; ?>" placeholder="0" class="form-control required numeric"/></td>
                                                            <td>
                                                            <span data-repeater-delete class="pull-right" style="color: #bd1515;cursor:pointer;">
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                          </span>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>

                                                  <span data-repeater-create class="btn btn-default btn-md">
                                                    <span class="glyphicon glyphicon-plus"></span> Add Sub Specs
                                                  </span>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="clearfix"></div>

                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="col-md-12">
                  <span data-repeater-create class="btn btn-info btn-md">
                    <span class="glyphicon glyphicon-plus"></span> Add Item
                  </span>
                </div>
        </div>



        <div class="clearfix"></div>

        <input type="hidden" name="remain-url" value="true">
    </form>




<!-- DataTables -->
<script src="<?php echo site_url("assets/plugins/jquery-repeater/jquery.repeater.min.js"); ?>"></script>
<script>
    $(function() {

        $('.repeater-default-values').repeater({
            repeaters: [{
                selector: '.inner-repeater',
                show: function(){
                    $('.numeric').numeric();
                    $(this).slideDown('slow');
                }
            }],
            show: function(){
                $('.numeric').numeric();
                $(this).slideDown();
            }
        });

    });
</script>