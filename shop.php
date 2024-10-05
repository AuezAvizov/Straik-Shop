<?php

error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);
session_start();

include("includes/db.php");
include("includes/header.php");
include("functions.php");
include("includes/main.php");

?>

<main>
    <div class="nero">
        <div class="nero__heading">
            <span class="nero__bold">shop</span> AT AVE
        </div>
        <p class="nero__text">
        </p>
    </div>
</main>

<div id="content">
    <div class="container">
        <div class="col-md-12">
        </div>
        <div class="col-md-3">
            <?php include("includes/sidebar.php"); ?>
        </div>
        <div class="col-md-9">
            <?php getProducts(); ?>
        </div>
        <center>
            <ul class="pagination">
                <?php getPaginator(); ?>
            </ul>
        </center>
    </div>
</div>

<?php

include("includes/footer.php");

?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {

    $('.nav-toggle').click(function() {
        $(".panel-collapse, .collapse-data").slideToggle(700, function() {
            if ($(this).css('display') == 'none') {
                $(".hide-show").html('Показать');
            } else {
                $(".hide-show").html('Скрыть');
            }
        });
    });

    $(function() {
        $.fn.extend({
            filterTable: function() {
                return this.each(function() {
                    $(this).on('keyup', function() {
                        var $this = $(this),
                            search = $this.val().toLowerCase(),
                            target = $this.attr('data-filters'),
                            handle = $(target),
                            rows = handle.find('li a');
                        if (search == '') {
                            rows.show();
                        } else {
                            rows.each(function() {
                                var $this = $(this);
                                $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                            });
                        }
                    });
                });
            }
        });
        $('[data-action="filter"][id="dev-table-filter"]').filterTable();
    });

});
</script>

<script>
$(document).ready(function() {

    function getProducts() {
        var sPath = '';
        var aInputs = $('li').find('.get_manufacturer');
        var aKeys = Array();
        var iKey = 0;

        $.each(aInputs, function(key, oInput) {
            if (oInput.checked) {
                aKeys[iKey] = oInput.value;
            }
            iKey++;
        });

        if (aKeys.length > 0) {
            var sPath = '';
            for (var i = 0; i < aKeys.length; i++) {
                sPath = sPath + 'man[]=' + aKeys[i] + '&';
            }
        }

        var aInputs = $('li').find('.get_p_cat');
        var aKeys = Array();
        var iKey = 0;

        $.each(aInputs, function(key, oInput) {
            if (oInput.checked) {
                aKeys[iKey] = oInput.value;
            }
            iKey++;
        });

        if (aKeys.length > 0) {
            for (var i = 0; i < aKeys.length; i++) {
                sPath = sPath + 'p_cat[]=' + aKeys[i] + '&';
            }
        }

        var aInputs = $('li').find('.get_cat');
        var aKeys = Array();
        var iKey = 0;

        $.each(aInputs, function(key, oInput) {
            if (oInput.checked) {
                aKeys[iKey] = oInput.value;
            }
            iKey++;
        });

        if (aKeys.length > 0) {
            for (var i = 0; i < aKeys.length; i++) {
                sPath = sPath + 'cat[]=' + aKeys[i] + '&';
            }
        }

        $('#wait').html('<img src="images/load.gif">');

        $.ajax({
            url: "load.php",
            method: "POST",
            data: sPath + 'sAction=getProducts',
            success: function(data) {
                $('#Products').html('');
                $('#Products').html(data);
                $("#wait").empty();
            }
        });

        $.ajax({
            url: "load.php",
            method: "POST",
            data: sPath + 'sAction=getPaginator',
            success: function(data) {
                $('.pagination').html('');
                $('.pagination').html(data);
            }
        });
    }

    $('.get_manufacturer').click(function() {
        getProducts();
    });

    $('.get_p_cat').click(function() {
        getProducts();
    });

    $('.get_cat').click(function() {
        getProducts();
    });

});
</script>

</body>
</html>
