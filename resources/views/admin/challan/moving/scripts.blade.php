<script>
    $(document).ready(function () {
        var counter = 1;

        $('#addrow').on('click', function () {
            counter++;
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><select name="new_item[]" class="select1 item-select">\n\
                        <option value="">Select Item</option>\n\
                        @foreach ($item as $val)\n\
                        <option value="{{ $val->id }}" data-details="{{ "Name: " . $val->name . ", Type: " . $val->type . ", Size: " . $val->size . ", Color: " . $val->color }}" data-mainunit-name="{{ $val->main_unit->name }}" data-subunit-name="{{ $val->sub_unit_name->name }}" data-subunit-related="{{ $val->unit_related_by->related_by }}" data-price="{{ $val->unit_price }}">{{ $val->name }}</option>\n\
                        @endforeach\n\
                    </select>\n\
                </td>';
            cols += '<td>\n\<textarea name="item_details[]" cols="60" rows="1" class="form-control form-control-sm item-details"></textarea>\n\
                    </td>';
            cols += '<td><div class="quantity"><div class="main_unit"><label class="main_unit_name"></label><input type="text" name="main_unit_qty[]" id="main_unit_qty" class="form-control form-control-sm main_unit_qty"></div><div class="sub_unit"><label class="sub_unit_name"></label><input type="text" name="sub_unit_qty[]" id="sub_unit_qty" class="form-control form-control-sm sub_unit_qty"><input type="hidden" class="related_by" value=""></div></div></td>';
            cols += '<td><input type="number" name="total_packages[]" id="total_packages" class="form-control form-control-sm total_packages"></td>';
            cols += '<td><textarea name="packaging_details[]" id="packaging_details" cols="60" rows="1" class="form-control form-control-sm packaging_details"></textarea></td>';
            cols += '<td><input type="text" name="rate[]" class="form-control form-control-sm rate"></td>';
            cols += '<td><input type="text" name="sub_total[]" class="form-control form-control-sm sub_total" readonly></td>';
            cols += '<td><button class="btn bg-gradient-danger deleteRow"><span class="fa fa-remove"></span></button></td>';
            newRow.append(cols);
            $('table.mytable').append(newRow);
            $(".select1").select2();
        });

        function empty_num_check(placeholder) {
            if (placeholder == null) {
                placeholder = 0;
            } else if (placeholder.trim() == "") {
                placeholder = 0;
            }
            return placeholder;
        }


        $(".mytable").on("change", '.item-select', function () {
            var selectedOption = $(this).find(':selected');
            var itemDetails = selectedOption.data('details');

            var unitName = selectedOption.data('mainunit-name');
            var subUnitName = selectedOption.data('subunit-name');
            var subUnitRelated = selectedOption.data('subunit-related');

            var price = selectedOption.data('price');

            // Update the rate field with the price of the selected item
            var rateField = $(this).closest('tr').find('.rate');
            rateField.val(price);

            // Update the item details textarea
            var itemDetailsField = $(this).closest('tr').find('.item-details');
            itemDetailsField.val(itemDetails);

            // Update the main_unit_qty field with the unit name
            var unitNameLabel = $(this).closest('tr').find('.main_unit_name');
            unitNameLabel.text('Unit: ' + unitName);

            // Update the related_by field with the subunit related value
            var itemRelatedByField = $(this).closest('tr').find('.related_by');
            itemRelatedByField.val(subUnitRelated);

            // Hide sub_unit_qty field if subUnitId is 'root'
            var subUnitQtyField = $(this).closest('tr').find('.sub_unit');
            if (subUnitName === '') {
                subUnitQtyField.hide();
                $(this).closest('tr').find('.main_unit').css('width', '100%');
            } else {
                subUnitQtyField.show();
                $(this).closest('tr').find('.main_unit').css('width', '48%');
                $(this).closest('tr').find('.sub_unit').css('width', '48%');
            }

            // Update the sub_unit_qty field with the sub-unit name
            var subUnitNameLabel = $(this).closest('tr').find('.sub_unit_name');
            subUnitNameLabel.text('Sub-Unit: ' + (subUnitName && subUnitName !== 'root' ? subUnitName : ''));
        });

        $(".mytable").on("change", 'input[class*="rate"], input[class*="main_unit_qty"], input[class*="sub_unit_qty"]', function (event) {
            calculateRow($(this).closest("tr"));
            calculateGrandTotal();
        });

        $(".mytable").on("click", "button.deleteRow", function (event) {
            $(this).closest("tr").remove();
            calculateGrandTotal();
        });

        function calculateRow(row) {
            var rate = +row.find('input[class*="rate"]').val();
            var main_unit_qty = +row.find('input[class*="main_unit_qty"]').val();
            var related_unit = +row.find('input[class*="related_by"]').val();
            var sub_unit_qty = +row.find('input[class*="sub_unit_qty"]').val() / related_unit || 0; // If sub_unit_qty is empty, default to 0
            row.find('input[class*="sub_total"]').val((rate * (main_unit_qty + sub_unit_qty)).toFixed(2));
        }

        function calculateGrandTotal() {
            var grandTotal = 0;
            $(".mytable").find('input[class*="sub_total"]').each(function () {
                grandTotal += +$(this).val();
            });

            $("#input_payable").val(grandTotal.toFixed(2));
            $("#text_payable").text(grandTotal.toFixed(0));
            $("#subtotal_").val(grandTotal.toFixed(2));
        }
    });

    //Side Menu Hidden
    // $('#main-wrapper').toggleClass("menu-toggle");
</script>