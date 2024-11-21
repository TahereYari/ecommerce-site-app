$(document).ready(function() {
    function showEditLicenseFields(hasLicense, productId) {
        var moreFieldsDiv = $('#more-fields');
        moreFieldsDiv.empty(); // پاک کردن محتوای قبلی

        if (hasLicense) {
            // AJAX request or data retrieval to get license details
            $.ajax({
                url: '/admin/get-license-details', // مسیری که اطلاعات لایسنس‌ها را بر می‌گرداند
                method: 'GET',
                data: { productId: productId }, // شناسه محصول برای دریافت اطلاعات
                success: function(response) {
                    // برای هر لایسنس، یک فیلد اضافه کنید
                    response.licenses.forEach(function(license) {
                        var typeInput = $('<input>').attr({
                            type: 'text',
                            class: 'form-control',
                            name: 'type[]',
                            // placeholder: 'Type of Subscription',
                            value: license.type // مقدار نوع لایسنس
                        });

                        var priceInput = $('<input>').attr({
                            type: 'number',
                            class: 'form-control',
                            name: 'cost[]',
                            // placeholder: 'Price of Subscription',
                            value: license.cost // مقدار قیمت لایسنس
                        });

                        var typeFormGroup = $('<div>').addClass('form-group').append(typeInput);
                        var priceFormGroup = $('<div>').addClass('form-group').append(priceInput);

                        moreFieldsDiv.append(typeFormGroup).append(priceFormGroup);
                    });

                    // نمایش فیلدهای لایسنس
                    $('#product-license').prop('checked', true);
                    $('#license-fields').show();
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching license details: ' + error);
                }
            });
        }
    }

    // زمانی که دکمه Edit کلیک می‌شود
    $('.edit-product').click(function() {
        var productId = $(this).data('id'); // دریافت شناسه محصول از دیتا-آی‌دی دکمه
        var hasLicense = $(this).data('license-product') == 1; // بررسی وجود لایسنس

        // تنظیم مقادیر دیگر فیلدهای مدال
        $('#product-name').val($(this).data('product-name'));
        $('#product-price').val($(this).data('product-price'));
        $('#product-description').val($(this).data('description-product'));
        $('#product-free').prop('checked', $(this).data('free-product') == 1);
        // تنظیم مقادیر فایل‌ها و تصاویر و ویدیوها در صورت نیاز

        // نمایش فیلدهای لایسنس در صورت وجود
        showEditLicenseFields(hasLicense, productId);
    });

    // تنظیم دکمه لایسنس برای نمایش فیلدها
    $('#product-license').on('change', function() {
        if ($(this).is(':checked')) {
            $('#license-fields').show();
        } else {
            $('#license-fields').hide();
        }
    });
});
