document.addEventListener("DOMContentLoaded", function () {
    // تعداد تصاویر موجود در پوشه
    const imageCount = 16; 

    // تولید عدد تصادفی بین 1 تا 16
    const randomNumber = Math.floor(Math.random() * imageCount) + 1; 

    // مسیر تصویر تصادفی
    const randomImage = `../images/photo_header/(${randomNumber}).jpg`;

    // اعمال تصویر تصادفی به پس‌زمینه‌ی المنت
    document.querySelector(".page-header__bg").style.backgroundImage = `url(${randomImage})`;
});
