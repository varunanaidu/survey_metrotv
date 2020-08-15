$(document).ready(function() {

    var resp_id = $('#resp_id').val();

    $.ajax({
        url : base_url + 'site/check_transaction',
        type : 'POST',
        dataType : 'JSON',
        data : {'resp_id' : resp_id},
        success : function (data) {
            for (var i = 0; i < data.length; i++) {
                var name = 'input[name='+data[i].quest_id+']';
                var name2 = 'textarea[name="'+data[i].quest_id+'"]';
                var el = $(name2);
                $(name).each(function () {
                    if (this.value == data[i].answer) {
                        this.setAttribute('checked', 'checked');
                    }
                });
                if (data[i].quest_id == 10) {
                    $('textarea[name="reason_10"]').val(data[i].reason);
                    $('#reasonContainer').show();
                }
                if (data[i].quest_id == 11) {
                    $('textarea[name="reason_11"]').val(data[i].reason);
                    $('#reasonContainer').show();
                }
                if (data[i].quest_id == 12) {
                    $('textarea[name="reason_12"]').val(data[i].reason);
                    $('#reasonContainer').show();
                }
                if (data[i].quest_id == 13) {
                    $('textarea[name="reason_13"]').val(data[i].reason);
                    $('#reasonContainer').show();
                }
                if (data[i].quest_id == 88) {
                    $('textarea[name="reason_88"]').val(data[i].reason);
                    $('#reasonContainer').show();
                }
            }
        }
    });
});

$(function(){

    var form = $('#wizard');

    form.validate({
        errorPlacement: function errorPlacement(error, element) { element.after(error); },
        rules: {
            resp_name   : "required",
            resp_email  : "required",
            resp_ph     : "required",
            range_age   : "required",
            profession  : "required",
            resp_address: "required",
            resp_gender : "required",
            edu         : "required",
            expense     : "required",
            province    : "required",
            reason_10   : "required",
            reason_11   : "required",
            reason_12   : "required",
            reason_13   : "required",
            reason_88   : "required",
        },
        messages : {
            resp_name   : 'Kolom wajib diisi.',
            resp_email  : "Kolom wajib diisi.",
            resp_ph     : "Kolom wajib diisi.",
            range_age   : "Pilih salah satu.",
            profession  : "Pilih salah satu.",
            resp_address: "Kolom wajib diisi.",
            resp_gender : "Pilih salah satu.",
            edu         : "Pilih salah satu.",
            expense     : "Pilih salah satu.",
            province    : "Pilih salah satu.",
            reason_10   : "Pilih salah satu dan Alasan wajib diisi",
            reason_11   : "Pilih salah satu dan Alasan wajib diisi",
            reason_12   : "Pilih salah satu dan Alasan wajib diisi",
            reason_13   : "Pilih salah satu dan Alasan wajib diisi",
            reason_88   : "Pilih salah satu dan Alasan wajib diisi",
        }
    });

    form.steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        labels: {
            finish: "Selesai",
            next: "Selanjutnya",
            previous: "Sebelumnya"
        },
        onStepChanging : function (e, currentIndex, newIndex) {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinished : function () {
            form.submit();
        }
    });

    form.on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url : base_url + 'site/inputed',
            dataType : 'JSON',
            type : 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data : formData,
            beforeSend : function () {
                $('.loading').show();
            },
            success : function (data) {
                if (data.type == 'done') {
                    location.href = base_url + 'site/thanks';
                }
            }
        });
    });

    $('.wizard > .steps li a').click(function(){
        $(this).parent().addClass('checked');
        $(this).parent().prevAll().addClass('checked');
        $(this).parent().nextAll().removeClass('checked');
    });

})