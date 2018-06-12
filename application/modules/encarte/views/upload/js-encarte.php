<!--begin::Page Vendors -->
<script src="<?php echo base_url('themes/cliente/assets') ?>/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->  
<!--begin::Page Snippets -->
<script src="<?php echo base_url('themes/cliente/assets') ?>/app/js/dashboard.js" type="text/javascript"></script>
<!--end::Page Snippets -->   
<!-- begin::Kendo UI -->
<link href="<?php echo base_url("themes/simple/plugins/knd.ui.17.r1") ?>/styles/kendo.common.min.css" rel="stylesheet">
<link href="<?php echo base_url("themes/simple/plugins/knd.ui.17.r1") ?>/styles/kendo.rtl.min.css" rel="stylesheet">
<link href="<?php echo base_url("themes/simple/plugins/knd.ui.17.r1") ?>/styles/kendo.default.min.css" rel="stylesheet">
<link href="<?php echo base_url("themes/simple/plugins/knd.ui.17.r1") ?>/styles/kendo.default.mobile.min.css" rel="stylesheet">
<script src="<?php echo base_url("themes/simple/plugins/knd.ui.17.r1") ?>/js/jszip.min.js"></script>
<script src="<?php echo base_url("themes/simple/plugins/knd.ui.17.r1") ?>/js/kendo.all.min.js"></script>
<script src="<?php echo base_url("themes/simple/plugins/knd.ui.17.r1") ?>/js/messages/kendo.messages.pt-BR.min.js"></script>
<script src="<?php echo base_url("themes/simple/plugins/knd.ui.17.r1") ?>/content/shared/js/console.js"></script>
<!-- end::Kendo UI -->
<script type="text/javascript">
<?php if (!is_null($lojas)) { ?>
        var myDataSource = new kendo.data.HierarchicalDataSource({
            data: <?php echo $lojas ?>
        });

        $("#multiselect").kendoMultiSelect({
            dataTextField: "text",
            dataValueField: "id"
        });

        $("#treeview").kendoTreeView({
            loadOnDemand: false,
            checkboxes: {
                checkChildren: true
            },
            dataSource: myDataSource,
            check: onCheck,
            expand: onExpand
        });
        function onCancelClick(e) {
            e.sender.close();
        }

        function onOkClick(e) {
            var checkedNodes = [];
            var treeView = $("#treeview").data("kendoTreeView");

            getCheckedNodes(treeView.dataSource.view(), checkedNodes);
            populateMultiSelect(checkedNodes);

            e.sender.close();
        }

        function onClose() {
            $("#openWindow").fadeIn();
        }

        function populateMultiSelect(checkedNodes) {
            var multiSelect = $("#multiselect").data("kendoMultiSelect");
            multiSelect.dataSource.data([]);

            var multiData = multiSelect.dataSource.data();
            if (checkedNodes.length > 0) {
                var array = multiSelect.value().slice();
                for (var i = 0; i < checkedNodes.length; i++) {
                    multiData.push({text: checkedNodes[i].text, id: checkedNodes[i].id});
                    array.push(checkedNodes[i].id.toString());
                }

                multiSelect.dataSource.data(multiData);
                multiSelect.dataSource.filter({});
                multiSelect.value(array);
            }
        }

        function checkUncheckAllNodes(nodes, checked) {
            for (var i = 0; i < nodes.length; i++) {
                nodes[i].set("checked", checked);

                if (nodes[i].hasChildren) {
                    checkUncheckAllNodes(nodes[i].children.view(), checked);
                }
            }
        }

        function chbAllOnChange() {
            var checkedNodes = [];
            var treeView = $("#treeview").data("kendoTreeView");
            var isAllChecked = $('#chbAll').prop("checked");

            checkUncheckAllNodes(treeView.dataSource.view(), isAllChecked)

            if (isAllChecked) {
                setMessage($('#treeview input[type="checkbox"]').length);
            } else {
                setMessage(0);
            }
        }

        function getCheckedNodes(nodes, checkedNodes) {
            var node;

            for (var i = 0; i < nodes.length; i++) {
                node = nodes[i];

                if (node.checked) {
                    checkedNodes.push({text: node.text, id: node.id});
                }

                if (node.hasChildren) {
                    getCheckedNodes(node.children.view(), checkedNodes);
                }
            }
        }
        
        // function that gathers IDs of checked nodes
        function checkedNodeIds(nodes, checkedNodes) {
            for (var i = 0; i < nodes.length; i++) {
                if (nodes[i].checked) {
                    checkedNodes.push(nodes[i].id);
                }

                if (nodes[i].hasChildren) {
                    checkedNodeIds(nodes[i].children.view(), checkedNodes);
                }
            }
        }

        function onCheck() {
            var checkedNodes = [],
                treeView = $("#treeview").data("kendoTreeView"),
                message;

            checkedNodeIds(treeView.dataSource.view(), checkedNodes);

            if (checkedNodes.length > 0) {
                message = checkedNodes.join(",");
            } else {
                message = "";
            }

            $("#lojas").val(message);
        }

        function onExpand(e) {
            if ($("#filterText").val() == "") {
                $(e.node).find("li").show();
            }
        }

        function setMessage(checkedNodes) {
            var message;

            if (checkedNodes > 0) {
                message = checkedNodes;
            } else {
                message = "0";
            }

            $("#result").html(message);
        }

        $("#filterText").keyup(function (e) {
            var filterText = $(this).val();

            if (filterText !== "") {
                $(".selectAll").css("visibility", "hidden");

                $("#treeview .k-group .k-group .k-in").closest("li").hide();
                $("#treeview .k-group").closest("li").hide();
                $("#treeview .k-in:contains(" + filterText + ")").each(function () {
                    $(this).parents("ul, li").each(function () {
                        var treeView = $("#treeview").data("kendoTreeView");
                        treeView.expand($(this).parents("li"));
                        $(this).show();
                    });
                });
                $("#treeview .k-group .k-in:contains(" + filterText + ")").each(function () {
                    $(this).parents("ul, li").each(function () {
                        $(this).show();
                    });
                });
            } else {
                $("#treeview .k-group").find("li").show();
                var nodes = $("#treeview > .k-group > li");

                $.each(nodes, function (i, val) {
                    if (nodes[i].getAttribute("data-expanded") == null) {
                        $(nodes[i]).find("li").hide();
                    }
                });

                $(".selectAll").css("visibility", "visible");
            }
        });
<?php } ?>
    $(document).ready(function () {
        console.log('<?php echo $lojas ?>');
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $('.categoria').selectize({
            allowEmptyOption: false,
            create: false,
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false
        });

        $('.regiao').selectize({
            allowEmptyOption: false,
            create: false,
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false
        });

        $('.estado').selectize({
            allowEmptyOption: false,
            create: false,
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false
        });

        $('.cidade').selectize({
            allowEmptyOption: false,
            create: false,
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false
        });

        $('.tags').selectize({
            delimiter: ',',
            plugins: ['remove_button'],
            persist: false,
            create: function (input) {
                return {
                    value: input,
                    text: input
                }
            }
        });

        addDatePicker('.calendario');

        function addDatePicker(sdt_data) {
            $(sdt_data).daterangepicker({
                'locale': {
                    'format': 'DD/MM/YYYY',
                    'daysOfWeek': [
                        'Dom',
                        'Seg',
                        'Ter',
                        'Qua',
                        'Qui',
                        'Sex',
                        'Sáb'
                    ],
                    'monthNames': [
                        'Janeiro',
                        'Fevereiro',
                        'Março',
                        'Abril',
                        'Maio',
                        'Junho',
                        'Julho',
                        'Agosto',
                        'Setembro',
                        'Outubro',
                        'Novembro',
                        'Dezembro'
                    ]
                },
                "drops": "down",
                singleDatePicker: true
            });
            $(sdt_data).inputmask("99/99/9999", {placeholder: "", clearMaskOnLostFocus: true});
        }
        $('.calendario').val('');
        <?php if (!is_null($lojas)) { ?>
            var multiSelect = $("#multiselect").data("kendoMultiSelect");
            multiSelect.readonly(true);
        <?php } ?>
    });

    function bs_input_file() {
        $(".input-file").before(
                function () {
                    if (!$(this).prev().hasClass('input-ghost')) {
                        var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
                        element.attr("name", $(this).attr("name"));
                        element.change(function () {
                            element.next(element).find('input').val((element.val()).split('\\').pop());
                        });
                        $(this).find("button.btn-choose").click(function () {
                            element.click();
                        });
                        $(this).find("button.btn-reset").click(function () {
                            location.reload();
                        });
                        $(this).find('input').css("cursor", "pointer");
                        $(this).find('input').mousedown(function () {
                            $(this).parents('.input-file').prev().click();
                            return false;
                        });
                        $('.enviar').attr('disabled', false);
                        return element;
                    }
                }
        );
    }
    $(function () {
        bs_input_file();
    });

    $(window).on('load', function () {
        $('body').removeClass('m-page--loading');
    });
</script>
<!-- end::Page Loader -->