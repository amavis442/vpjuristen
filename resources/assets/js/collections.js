/**
 * Created by patrick on 5/28/17.
 */
$(document).ready(function() {
    $('#action_listaction_id').on('change', function () {

        var selected = $(this).find('option:selected');
        var extra = selected.data('content');

        var val = $(this).val();
        console.log(extra);
        if (extra == 'betaling ontvangen') {
            $('#collection').css('display', '');
        } else {
            $('#collection').css('display', 'none');
        }
    });

    // Init
    var selected = $('#action_listaction_id').find('option:selected');
    var extra = selected.data('content');
    if (extra == 'betaling ontvangen') {
        $('#collection').css('display', '');
    } else {
        $('#collection').css('display', 'none');
    }

});